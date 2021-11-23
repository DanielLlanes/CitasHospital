<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Staff\Service;
use App\Models\Staff\Specialty;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        $this->middleware('can:services.list')->only(['getServiceList', 'service']);
        $this->middleware('can:services.edit')->only(['edit','update']);
        $this->middleware('can:services.create')->only(['create','store']);
        $this->middleware('can:services.destroy')->only(['destroy']);
        $this->middleware('can:services.activate')->only(['activate']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service()
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $specialites = Specialty::whereHas(
            'role', function($q) use ($lang){
                $q->where("name", 'doctor');
                $q->orWhere("name", 'coordinator');
        })
        ->where('active', '=', '1')
        ->where('show', '=', '1')
        ->select('id', 'role_id', "name_$lang AS name")
        ->orderBy("name_$lang", 'ASC')
        ->get();

        return view('staff.service-manager.list', ["specialites" => $specialites]);
    }

    public function getServiceList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $service = Service::with([
                'specialties' => function($q) use ($lang){
                    $q->selectRaw("name_$lang specialty_name");
                },
                'brand' => function($q) use ($lang){
                    $q->selectRaw("id, brand, color");
                },
            ])
            ->selectRaw("id, service_$lang service, need_images, qty_images, active, description_$lang description, brand_id")
            ->get();
            return DataTables::of($service)
                ->addIndexColumn()
                ->addColumn('service', function($service){
                    return $service->service;
                })
                ->addColumn('brand', function($service){
                    return '<span style="font-weight: 500; color: '.$service->brand->color.'">'.$service->brand->brand.'</span>';
                })
                ->addColumn('need_images', function($service){
                    $need_images = '';
                    if ($service->need_images == 0) {
                        $need_images .= 'No';
                    } else {
                        $need_images .= 'Yes';
                    }
                    return $need_images;
                })
                ->addColumn('qty_images', function($service){
                    return $service->qty_images;
                })
                ->addColumn('description', function($service){
                    return $service->description;
                })
                ->addColumn('active', function($service){
                    $table_active = 'table-active';
                    $service_id = $service->id;
                    $cursor = "pointer";

                    if ($service->active == '1') {
                        $btn = '<span attr-id="'. $service_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $service_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.service-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'service', 'brand', 'need_images', 'qty_images', 'description', 'active', 'action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['input_specialties' => json_decode($request->input_specialties, true)]);
        $validator = Validator::make($request->all(), [
            'brand' => 'required|exists:brands,id',
            'service_en' => 'required|string|unique:services',
            'service_es' => 'required|string|unique:services',
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'need_images' => 'required|integer',
            'qty_images' => 'required_if:need_images,1',
            'input_specialties' => 'required|array',
            'input_specialties.*' => "required|distinct",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $service = new Service;
        $service->brand_id = $request->brand;
        $service->service_es = $request->service_es;
        $service->service_en = $request->service_en;
        $service->need_images = $request->need_images;
        $service->qty_images = $request->qty_images;
        //$service->staff_cadena = json_encode($request->input_specialties);
        $service->description_en = $request->description_en;
        $service->description_es = $request->description_es;

        if ($service->save()) {
            $staff = $request->input_specialties;
            $insert_staff = [];
            for ($i = 0; $i < count($staff); $i++) {
                $insert_staff[] = [
                    'specialty_id' => $staff[$i]['id'],
                    'order' => ($i+1)
                ];
            }
            $service->specialties()->sync($insert_staff);
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New service was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the service please try again!'),
                'reload' => false
            ]
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $service = Service::with([
            'specialties' => function($q) use ($lang){
                $q->selectRaw("specialties.id, name_$lang specialty_name");
            },
            'brand' => function($q) use ($lang){
                $q->selectRaw("id, brand");
            },
        ])
        ->find($request->id);

        if ($service) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $service,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'The selected brand doesn\'t exist in the database',
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $service = Service::find($request->id);

        if ($service) {
            $request->merge(['input_specialties' => json_decode($request->input_specialties, true)]);
            $validator = Validator::make($request->all(), [
                'brand' => 'required|exists:brands,id',
                'service_en' => 'required|string|unique:services,service_en,'.$request->id,
                'service_es' => 'required|string|unique:services,service_es,'.$request->id,
                'description_en' => 'required|string',
                'description_es' => 'required|string',
                'need_images' => 'required|integer',
                'qty_images' => 'required_if:need_images,1',
                'input_specialties' => 'required|array',
                'input_specialties.*' => "required|distinct",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $service->brand_id = $request->brand;
            $service->service_es = $request->service_es;
            $service->service_en = $request->service_en;
            $service->need_images = $request->need_images;
            $service->qty_images = $request->qty_images;
            //$service->staff_cadena = json_encode($request->input_specialties);
            $service->description_en = $request->description_en;
            $service->description_es = $request->description_es;

            if ($service->save()) {
                $staff = $request->input_specialties;
                $insert_staff = [];
                for ($i = 0; $i < count($staff); $i++) {
                    $insert_staff[] = [
                        'specialty_id' => $staff[$i]['id'],
                        'order' => ($i+1)
                    ];
                }
                $service->specialties()->sync($insert_staff);
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('New service was successfully created!'),
                        'reload' => true
                    ]
                );
            }
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn’t create the service please try again!'),
                    'reload' => false
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The selected service doesn\'t exist in the database'),
                'reload' => true
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $service = Service::find($request->id);
        if($service->exists()){
            $service->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Service successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Service you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $service = Service::find($request->id);
        if ($service) {
            if ($service->active == 1) {
                $service->active = false;
            } elseif ($service->active == 0) {
                $service->active = true;
            }
            $service->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The service status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected service doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}
