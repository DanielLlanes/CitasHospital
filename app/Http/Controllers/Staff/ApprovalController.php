<?php

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\Controller;
use App\Models\Staff\AdditionalEmail;
use App\Models\Staff\Approval;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use ReflectionClass;
use Yajra\DataTables\DataTables;

class ApprovalController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        // $this->middleware('can:brand.list')->only(['getBrandList', 'brand']);
        // $this->middleware('can:brand.edit')->only(['edit','update']);
        // $this->middleware('can:brand.create')->only(['create','store']);
        // $this->middleware('can:brand.destroy')->only(['destroy']);
        // $this->middleware('can:brand.activate')->only(['activate']);
    }

    public function index()
    {
        $assig = Approval::with(['staff', 'additionalEmails', 'service'])->get();
        foreach($assig as $a) {
            $additionalEmails = $a->additionalEmails;
            $hasSelected = false;

            foreach($additionalEmails as $email) {
                if ($email['selected'] == true) {
                    $hasSelected = true;
                    break;
                }
            }

            $additionalEmails->push([
                'id' => null,
                'staff_id' => $a->staff_id,
                'email' => $a->staff->email,
                'selected' => $hasSelected ? 0 : 1,
                'created_at' => null,
                'updated_at' => null,
                'default' => true,
            ]);
        }

        return view('staff.approvals-manager.approvals');
    }

    public function getAssignableList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $assig = Approval::with(['staff', 'additionalEmails', 'service'])->get();
            
            return DataTables::of($assig)
            ->addIndexColumn()
            ->addColumn('staff', function ($assig) {

                return '<span>' . $assig->staff->name . '</span>';
            })
            ->addColumn('servicio', function ($assig) {
                $lang = Auth::guard('staff')->user()->lang;
                $service = ($lang = 'es') ? $assig->service->service_es:$assig->service->service_en;
                return '<span>' . $service  . '</span>';
                
            })
            ->addColumn('active', function ($assig) {
                    $table_active = 'table-active';
                    $assig_id = $assig->id;
                    $cursor = "pointer";

                    if ($assig->active == '1') {
                        $btn = '<span attr-id="'. $assig_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $assig_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
            })
            ->addColumn('can', function ($assig) {
                    $can = ($assig->approvals == 0) ? '':"checked";

                    return '<input otro="'.$assig->approvals.'" class="canApproval" data-id="' . $assig->id . '" type="checkbox" ' . $can . '>';
            })
            ->addColumn('email', function ($assig) {
                   
                $additionalEmails = $assig->additionalEmails;
                $hasSelected = false;
                $code = $assig->staff->id."-".$assig->service->id;
                $uls = '<div class="form-check">';
                foreach($additionalEmails as $email) {
                    if ($email['selected'] == true) {
                        $hasSelected = true;
                        break;
                    }
                }
                $additionalEmails->push([
                    'id' => null,
                    'staff_id' => $assig->staff_id,
                    'email' => $assig->staff->email,
                    'selected' => $hasSelected ? 0 : 1,
                    'created_at' => null,
                    'updated_at' => null,
                    'default' => true,
                ]);  

                foreach ($additionalEmails as $a) {
                    $email = $a['email'];
                    $isSelected = ($a['selected']) ? 'checked':"";
                    $generateUniqueString = password();
                    $uls .= '<input '. $isSelected .'  class="form-check-input" type="radio" name="emailRadios-' . $code . '" value="" id="defalultMail-' . $generateUniqueString . '">';
                    $uls .= '<label class="form-check-label" for="defalultMail-' . $generateUniqueString . '"> ' . $email .'. </label><br>';
                 } 
                    
                $uls .= '</div>';
                return $uls;
            })
            ->addColumn('acciones', function($assig) {
                $apps = $assig;
                return view('staff.mail-manager.actions-assignaments', compact('apps'));
            })
            ->rawColumns(['DT_RowIndex', "staff", "servicio", "can", "active", "email", "acciones"])
            ->make(true);
        }
    }

    public function autocompleteStaff(Request $request)
    {
        $staff = Staff::where
            (
                [
                    ["name",'like', "%".$request->search."%"],
                    ['active', 1],
                    ['show', "=", 1]
                ]
            )
            ->get();
        return $staff;
    }

    public function autocompleteService(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $service = Service::where
            (
                [
                    ["service_$lang",'like', "%".$request->search."%"],
                    ['active', 1],
                ]
            )
            ->selectRaw("*, service_$lang as name, id")
            ->get();
        return $service;
    }

    public function storeAssignaments(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'staff_id' => 'required|integer|exists:staff,id',
            'service_id' => 'required|integer|exists:services,id',
            'approval' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        
        $exist = Approval::where('staff_id', $request->staff_id)
                ->where('service_id', $request->service_id)
                ->exists();
        $staff = Staff::find($request->staff_id);        
        if (!$exist) {
            $assig = new Approval;
            $assig->staff_id = $request->staff_id;
            $assig->service_id = $request->service_id;
            $assig->service_id = $request->service_id;
            $assig->approvals = $request->approval;
            $assig->code = getCode();

            if ($assig->save()) {

                $is_selected = 0;
                foreach ($request->emails as $k => $email) {
                    if ($staff->email == $email['email']) {
                        if ($email['is_checked']) {
                           
                        }
                    } else {
                        $reflection = new ReflectionClass(Approval::class);
                        $namespace = $reflection->getNamespaceName() . '\\' . $reflection->getShortName();
                        $isSelected = ($email['is_checked'] == 1 )? 1:0;
                        $other = new AdditionalEmail();
                        $other->staff_id = $request->staff_id; 
                        $other->email = strtolower($email['email']); 
                        $other->selected = $isSelected; 
                        $other->service_id = $request->service_id;
                        $other->additional_emailable_id = $assig->id;
                        $other->additional_emailable_type = $namespace;
                        $other->save();         
                    }     
                }
                return response()->json([
                    'icon' => 'success',
                    'msg' => 'Agregado correctamente',
                    'reload' => true,
                    'success' => true
                ]);
            }
        } else {
            return response()->json([
                'icon' => 'error',
                'msg' => 'El usuario ya esta asignado a este sevicio',
                'reload' => false,
                'success' => false
            ]);
        }
    }

    public function activarAsignaciones(Request $request)
    {
        $assig = Approval::find($request->id);
        if ($assig) {
            if ($assig->active == 1) {
                $assig->active = false;
            } elseif ($assig->active == 0) {
                $assig->active = true;
            }
            $assig->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The brand doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }

    public function editerAsignaciones(Request $request)
    {
        $assig = Approval::with('staff', 'service', 'additionalEmails')->find($request->id);
        $lang = Auth::guard('staff')->user()->lang;
        if ($assig) {
            $additionalEmails = $assig->additionalEmails;
            $hasSelected = false;
            foreach($additionalEmails as $email) {
                if ($email['selected'] == true) {
                    $hasSelected = true;
                    break;
                }
            }
            $additionalEmails->push([
                'id' => null,
                'staff_id' => $assig->staff->id,
                'email' => $assig->staff->email,
                'selected' => $hasSelected ? 0 : 1,
                'created_at' => null,
                'updated_at' => null,
                'default' => true,
            ]);
            
            return response()->json(
                [
                    'success' => true,
                    'icon' => 'success',
                    'msg' => Lang::get('The status changed successfully'),
                    'reload' => true,
                    'data' => $assig,
                    'service' => ($lang = 'es') ? $assig->service->service_es:$assig->service->service_en,
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('This doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }

    public function updateAssignaments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required|integer|exists:staff,id',
            'service_id' => 'required|integer|exists:services,id',
            'approval' => 'required|boolean',
            'emails' => 'required|array',
            'emails.*.email' => 'required|email|distinct',
            'emails.*.is_default' => 'required|boolean',
            'emails.*.is_checked' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $staff = Staff::find($request->staff_id);
        $assig = Approval::with('additionalEmails')->find($request->id);

        $reflection = new ReflectionClass(Approval::class);
        $namespace = $reflection->getNamespaceName() . '\\' . $reflection->getShortName();
        if ($assig) { 
            $assig->service_id = $request->service_id;
            $assig->approvals = $request->service_id;
            $assig->save();
            $assig->additionalEmails()->delete();
            foreach ($request->emails as $email) {
                if ($staff->email == $email['email']) {
                    if ($email['is_checked'] == 1) {
                        continue;
                    }
                } else {
                    $isSelected = ($email['is_checked'] == 1 )? 1:0;

                    $other = new AdditionalEmail();
                    $other->email = strtolower($email['email']); 
                    $other->selected = $isSelected; 
                    $other->staff_id = $request->staff_id; 
                    $other->service_id = $request->service_id;
                    $other->additional_emailable_id = $assig->id;
                    $other->additional_emailable_type = $namespace;
                    $other->save();
                }
            }
            return response()->json([
                'icon' => 'success',
                'msg' => 'Agregado correctamente',
                'reload' => true,
                'success' => true
            ]);
        } else {
            return response()->json([
                'icon' => 'error',
                'msg' => 'El usuario ya esta asignado a este sevicio',
                'reload' => false,
                'success' => false
            ]);
        }
    }

    public function approvalAssignaments(Request $request)
    {
        $appr = Approval::find($request->id);

        $appr->approvals = $request->approval;

        if ($appr->save()) {
            return response()->json([
                'icon' => 'success',
                'msg' => 'Agregado correctamente',
                'reload' => true,
                'success' => true
            ]);
        }
    }
    public function getEmailsApprovals(Request $request)
    {
        //$emails = Assignment::with(['staff', 'additionalEmails', 'service'])->get();
        $staff = Staff::with('asignaciones.additionalEmails')->where('id', $request->id)->firstOrFail();

        $asignaciones = $staff->asignaciones;
        
        $hasSelected = false;
        $code = $staff->id;
        if (!is_null($asignaciones)) {
            $additionalEmails = $staff->asignaciones->additionalEmails;
            foreach($additionalEmails as $email) {
                if ($email['selected'] == true) {
                    $hasSelected = true;
                    break;
                }
            }
            $additionalEmails->push([
                'id' => null,
                'staff_id' => $staff->id,
                'email' => $staff->email,
                'selected' => $hasSelected ? 0 : 1,
                'created_at' => null,
                'updated_at' => null,
                'default' => true,
            ]);  
        } else {
            $asignaciones = [
                    'additional_emails' => [
                        [
                            'id' => null,
                            'staff_id' => $staff->id,
                            'email' => $staff->email,
                            'selected' => $hasSelected ? 0 : 1,
                            'created_at' => null,
                            'updated_at' => null,
                            'default' => true,
                        ]
                ]
            ];
            unset($staff->asignaciones);
            $staff->asignaciones = $asignaciones;
        }
        return $staff;
    }
}
