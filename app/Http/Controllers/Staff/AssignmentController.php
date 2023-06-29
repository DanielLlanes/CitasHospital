<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\AdditionalEmail;
use App\Models\Staff\Assignment;
use App\Models\Staff\Service;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use ReflectionClass;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Utils\Utils;
use Google\Service\CloudSourceRepositories\Repo;

class AssignmentController extends Controller
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
       $assignment_staff = getOthersEmails(1);
       return view('staff.assignment-manager.assinaments');
   }

   public function getAssignableList(Request $request)
   {
       if ($request->ajax()) {
           $lang = Auth::guard('staff')->user()->lang;
           $assig = Assignment::with(['staff', 'additionalEmails', 'service'])->get();

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
           ->addColumn('email', function ($assig) {
               $additionalEmails = $assig->additionalEmails;
               $id = $assig->code;
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
                   'id' => $id,
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
                   $isdefault= ($a['default']) ? '1':"0";
                   $generateUniqueString = password();
                   $uls .= '<input '. $isSelected .' data-default="' . $isdefault . '" class="form-check-input radioApss" data-id="' . $id .'" type="radio" name="emailRadios-' . $code . '" value="" id="defalultMail-' . $generateUniqueString . '">';
                   $uls .= '<label class="form-check-label" for="defalultMail-' . $generateUniqueString . '"> ' . $email .' </label><br>';
                } 
                   
               $uls .= '</div>';
               return $uls;
           })
           ->addColumn('acciones', function($assig) {
               $apps = $assig;
               return view('staff.assignment-manager.actions-assignaments', compact('apps'));
           })
           ->rawColumns(['DT_RowIndex', "staff", "servicio", "active", "email", "acciones"])
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

       $arr = [];

       $staff = Staff::find($request->staff_id);
       
       $exist = Assignment::where([ 'staff_id' => $request->staff_id, 'service_id' => $request->service_id])->exists();
       if (!$exist) {
           $assig = new Assignment;
           $assig->staff_id = $request->staff_id;
           $assig->service_id = $request->service_id;
           $assig->code = getCode();

           if ($assig->save()) {

               $is_selected = 0;
               foreach ($request->emails as $k => $email) {
                   if ($staff->email == $email['email']) {
                       if ($email['is_checked']) {
                          
                       }
                   } else {
                       $reflection = new ReflectionClass(Assignment::class);
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
       $assig = Assignment::find($request->id);
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

       $assig = Assignment::where('id', $request->id)->with('staff', 'service', 'additionalEmails')->first();
       
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
           'id' => 'required|integer|exists:assignments,id',
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
       //$exist = Assignment::where([['staff_id', $request->staff_id],['service_id', $request->service_id]])->first();
       $staff = Staff::find($request->staff_id);
       $assig = Assignment::with('additionalEmails')->find($request->id);
       $reflection = new ReflectionClass(Assignment::class);
       $namespace = $reflection->getNamespaceName() . '\\' . $reflection->getShortName();
       $arr = [];
       if ($assig) { 
           $assig->service_id = $request->service_id;
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
               'msg' => 'El usuario no esta asignado a este sevicio',
               'reload' => false,
               'success' => false
           ]);
       }
   }

   public function getEmailsAssignaments(Request $request)
   {
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

   public function setEmailsAssignaments(Request $request)
    {

        $getAssign = Assignment::with('additionalEmails')->where('code', $request->id)->first();
        $staff = Staff::find($getAssign->staff_id);

        $reflection = new ReflectionClass(Assignment::class);
        $namespace = $reflection->getNamespaceName() . '\\' . $reflection->getShortName();
        $arr = [];
        if($getAssign){
            $getAssign->additionalEmails()->delete();
            foreach ($request->emails as $email) {
                if ($staff->email == $email['email']) {
                    if ($email['is_checked'] == 1) {
                        continue;
                        return response()->json('entro');
                    }
                } else {
                    $isSelected = ($email['is_checked'] == 1 )? 1:0;
 
                    $other = new AdditionalEmail();
                    $other->email = strtolower($email['email']); 
                    $other->selected = $isSelected; 
                    $other->staff_id = $staff->staff_id; 
                    $other->service_id = $getAssign->service_id;
                    $other->additional_emailable_id = $getAssign->id;
                    $other->additional_emailable_type = $namespace;
                    $other->save();
                }
            }
            return response()->json([
                'icon' => 'success',
                'msg' => 'Asignado correctamente',
                'reload' => true,
                'success' => true
            ]);
            
        } else {
            return response()->json([
                'icon' => 'error',
                'msg' => 'El usuario no esta asignado a este sevicio',
                'reload' => false,
                'success' => false
            ]);
        }
    }

    public function deleteAssignaments(Request $request)
    {

        $exist = Assignment::where([ 'staff_id' => $request->staff_id, 'id' => $request->service_id])->with('additionalEmails')->first();

        if ($exist) {
            // Eliminar los registros asociados en la relación 'additionalEmails'
            $exist->additionalEmails()->delete();
        
            // Eliminar el registro principal
            $exist->delete();
        
            // Retorna una respuesta o realiza cualquier otra acción necesaria
            return response()->json([
                'title' => 'Registros eliminados exitosamente.',
                'icon' => 'success'
            ]);
        } else {
            // No se encontró el registro
            // Retorna una respuesta de error o realiza cualquier otra acción necesaria
            return response()->json([
                'title' => 'El registro no existe.',
                'icon' => 'error'
            ]);
        }
    }
}
