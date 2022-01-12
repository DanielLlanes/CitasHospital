<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Treatment;
use Illuminate\Http\Request;
use App\Models\Staff\Service;
use App\Models\Staff\Procedure;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class TreatmentController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        $this->middleware('can:treatment.list')->only(['getPackageList', 'treatments']);
        $this->middleware('can:treatment.edit')->only(['edit','update']);
        $this->middleware('can:treatment.create')->only(['create','store']);
        $this->middleware('can:treatment.destroy')->only(['destroy']);
        $this->middleware('can:treatment.activate')->only(['activate']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function treatments()
    {
        $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);
        $treatment = Treatment::selectRaw("id, brand_id, service_id, procedure_id, package_id, price, description_$lang description")
        ->with
        (
            [
                'brand' => function($q) use ($lang){
                    $q->selectRaw("id, brand, color");
                },
                'service' => function($q) use ($lang){
                    $q->selectRaw("id, service_$lang service");
                },
                'procedure' => function($q) use ($lang){
                    $q->selectRaw("id, procedure_$lang procedur");
                },
                'package' => function($q) use ($lang){
                    $q->selectRaw("id, package_$lang package");
                },
            ]
        )
        ->get();

        //return $treatment;

        return view('staff.treatments-manager.list');
    }

    public function getTreatmentsList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $treatment = Treatment::with
            (
                [
                    'brand' => function($q) use ($lang){
                        $q->selectRaw("id, brand, color");
                    },
                    'service' => function($q) use ($lang){
                        $q->selectRaw("id, service_$lang service");
                    },
                    'procedure' => function($q) use ($lang){
                        $q->selectRaw("id, procedure_$lang procedur");
                    },
                    'package' => function($q) use ($lang){
                        $q->selectRaw("id, package_$lang package");
                    },
                ]
            )
            ->selectRaw("id, brand_id, service_id, procedure_id, package_id, price, active, description_$lang description")
            ->get();
            return DataTables::of($treatment)
                ->addIndexColumn()
                ->addColumn('brand', function($treatment){
                    return '<span style="font-size: .7vw; font-weight: 800; color: '.$treatment->brand->color.'">'.strtoupper($treatment->brand->brand).'</span>';
                })
                ->addColumn('service', function($treatment){
                    return $treatment->service->service;
                })
                ->addColumn('procedure', function($treatment){
                    return $treatment->procedure->procedur;
                })
                ->addColumn('package', function($treatment){
                    if (!is_null($treatment->package_id)) {
                        return $treatment->package->package;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('price', function($treatment){
                    if (is_null($treatment->price) || $treatment->price == '') {
                        return 'Por cotizar';
                    } else {
                        return "$ $treatment->price";
                    }
                })
                ->addColumn('description', function($treatment){
                    return $treatment->description;
                })
                ->addColumn('active', function($treatment){
                    $table_active = 'table-active';
                    $products_id = $treatment->id;
                    $cursor = "pointer";

                    if ($treatment->active == '1') {
                        $btn = '<span attr-id="'. $products_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $products_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.treatments-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'brand', 'service', 'procedure', 'package', 'price', 'description', 'active', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $exist = Treatment::where("procedure_id", $request->procedure)
        ->where('package_id', $request->package)
        ->first();
        if ($exist) {
            return response()->json(
                [
                    'exist' => $exist,
                    'icon' => 'error',
                    'msg' => Lang::get('This procedure already exist!'),
                    'reload' => false
                ]
            );
        }

        $has_package = Procedure::selectRaw("has_package")
        ->find($request->procedure);
        $request->request->add(['has_package' => $has_package->has_package]);

        $validator = Validator::make($request->all(), [
            'service' => 'required|integer|exists:services,id',
            'procedure' => 'required|integer|exists:procedures,id',
            'package' =>
            [
                'bail',
                'required_if:has_package,0',
                'nullable',
                ($request->has_package == '1') ? 'exists:packages,id' : '',
            ],
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'price' => 'sometimes|numeric'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $group = Procedure::find($request->procedure);

        $getBrand = Service::select('brand_id')
        ->find($request->service);


        $treatment = new Treatment;
        $treatment->brand_id = $getBrand->brand_id;
        $treatment->service_id = $request->service;
        $treatment->procedure_id = $request->procedure;
        $treatment->package_id = ($request->has_package == '1') ? $request->package : null;
        $treatment->price = $request->price;
        $treatment->group_es = $group->procedure_es;
        $treatment->group_en = $group->procedure_en;
        $treatment->description_en = $request->description_en;
        $treatment->description_es = $request->description_es;

        if ($treatment->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New Treatment was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the Treatment please try again!'),
                'reload' => false
            ]
        );

    }

    public function edit(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $treatment = Treatment::with
            (
                [
                    'brand' => function($q) use ($lang){
                        $q->selectRaw("id, brand, color");
                    },
                    'service' => function($q) use ($lang){
                        $q->selectRaw("id, service_$lang service");
                    },
                    'procedure' => function($q) use ($lang){
                        $q->selectRaw("id, procedure_$lang procedur");
                    },
                    'package' => function($q) use ($lang){
                        $q->selectRaw("id, package_$lang package");
                    },
                ]
            )
            ->selectRaw("*")
            ->find($request->id);


        if ($treatment) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $treatment,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'The selected Treatment doesn\'t exist in the database',
            ]
        );
    }

    public function update(Request $request)
    {

        $exist = Treatment::where("procedure_id", $request->procedure)
        ->where('package_id', $request->package)
        ->where('id', '<>', $request->id)
        ->first();

        if ($exist) {
            return response()->json(
                [
                    'exist' => $exist,
                    'icon' => 'error',
                    'msg' => Lang::get('This procedure already exist!'),
                    'reload' => false
                ]
            );
        }
        $has_package = Procedure::selectRaw("has_package")
        ->find($request->procedure);
        $request->request->add(['has_package' => $has_package->has_package]);

        $validator = Validator::make($request->all(), [
            'service' => 'required|integer|exists:services,id',
            'procedure' => 'required|integer|exists:procedures,id',
            'package' =>
            [
                'bail',
                'required_if:has_package,0',
                'nullable',
                ($request->has_package == '1') ? 'exists:packages,id' : '',
            ],
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'price' => 'sometimes|numeric'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $group = Procedure::find($request->procedure);

        $getBrand = Service::select('brand_id')
        ->find($request->service);

        $treatment = Treatment::find($request->id);
        $treatment->brand_id = $getBrand->brand_id;
        $treatment->service_id = $request->service;
        $treatment->procedure_id = $request->procedure;
        $treatment->package_id = ($request->has_package == '1') ? $request->package : null;
        $treatment->price = $request->price;
        $treatment->group_es = $group->procedure_es;
        $treatment->group_en = $group->procedure_en;
        $treatment->description_en = $request->description_en;
        $treatment->description_es = $request->description_es;

        if ($treatment->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The Treatment was successfully edited!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t edit this Treatment please try again!'),
                'reload' => false
            ]
        );
    }

    public function destroy(Request $request)
    {
        $treatment = Treatment::find($request->id);
        if($treatment->exists()){
            $treatment->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Treatment successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Treatment you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $treatment = Treatment::find($request->id);
        if ($treatment) {
            if ($treatment->active == 1) {
                $treatment->active = false;
            } elseif ($treatment->active == 0) {
                $treatment->active = true;
            }
            $treatment->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The Treatment status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected Treatment doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}
