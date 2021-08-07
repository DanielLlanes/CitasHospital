<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Staff\Package;
use App\Models\Staff\Service;
use App\Models\Staff\Procedure;
use App\Models\Staff\Specialty;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ProcedureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        date_default_timezone_set('America/Tijuana');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function procedure()
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $packages = Package::where('active', '=', '1')
        ->select('id', "package_$lang AS name")
        ->get();

        return view('staff.procedure-manager.list', ["packages" => $packages]);
    }

    public function getProcedureList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $procedures = Procedure::select("*", "procedure_$lang as procedure", "description_$lang as description")
            ->with(
                [
                    'service' => function($q) use ($lang){
                        $q->select("id", "brand_id", "service_$lang as service", "description_$lang as description")
                        ->with(
                            [
                                'brand' => function($q) use ($lang){
                                    $q->select("id", "brand", "color");
                                }
                            ]
                        );
                    },
                ]
            )
            ->get();
            return DataTables::of($procedures)
                ->addIndexColumn()
                ->addColumn('brand', function($procedures){
                    return '<span style="font-weight: 500; color: '.$procedures->service->brand->color.'">'.$procedures->service->brand->brand.'</span>';
                })
                ->addColumn('service', function($procedures){
                    return $procedures->service->service;
                })
                ->addColumn('procedure', function($procedures){
                    return $procedures->procedure;
                })
                ->addColumn('haspackage', function($procedures){
                    $has_package = "";
                    if ($procedures->has_package == 1) {
                        $has_package = "Yes";
                    } else {
                        $has_package = "No";
                    }
                    return $has_package;
                })
                ->addColumn('description', function($procedures){
                    return $procedures->description;
                })
                ->addColumn('active', function($procedures){
                    $table_active = 'table-active';
                    $procedure_id = $procedures->id;
                    $cursor = "pointer";

                    if ($procedures->active == '1') {
                        $btn = '<span attr-id="'. $procedure_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $procedure_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.procedure-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'brand', 'service', 'procedure', 'haspackage', 'description', 'active', 'action'])
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
        $request->merge(['input_packages' => json_decode($request->input_packages, true)]);
        $validator = Validator::make($request->all(), [
            'service' => 'required|exists:services,id',
            'procedure_en' => 'required|string|unique:procedures',
            'procedure_es' => 'required|string|unique:procedures',
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'has_package' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => $request,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $procedure = new Procedure;
        $procedure->service_id = $request->service;
        $procedure->procedure_en = $request->procedure_en;
        $procedure->procedure_es = $request->procedure_es;
        $procedure->price = $request->price;
        $procedure->has_package = $request->has_package;
        $procedure->description_en = $request->description_en;
        $procedure->description_es = $request->description_es;

        if ($procedure->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New procedure was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the procedure please try again!'),
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
        $procedure = Procedure::with(
            [
                'service' => function($q) use ($lang){
                    $q->select("id", "brand_id", "service_$lang as service", "description_$lang as description");
                }
            ]
        )
        ->find($request->id);


        if ($procedure) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $procedure,
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
        $procedure = Procedure::find($request->id);

        $validator = Validator::make($request->all(), [
            'service' => 'required|exists:services,id',
            'procedure_en' => 'required|string|unique:procedures,procedure_en,'.$request->id,
            'procedure_es' => 'required|string|unique:procedures,procedure_es,'.$request->id,
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'has_package' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => $request,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $procedure->service_id = $request->service;
        $procedure->procedure_en = $request->procedure_en;
        $procedure->procedure_es = $request->procedure_es;
        $procedure->price = $request->price;
        $procedure->has_package = $request->has_package;
        $procedure->description_en = $request->description_en;
        $procedure->description_es = $request->description_es;

        if ($procedure->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The procedure was successfully updated!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the procedure please try again!'),
                'reload' => false
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
        $procedure = Procedure::find($request->id);
        if($procedure->exists()){
            $procedure->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Procedure successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Procedure you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $procedire = Procedure::find($request->id);
        if ($procedire) {
            if ($procedire->active == 1) {
                $procedire->active = false;
            } elseif ($procedire->active == 0) {
                $procedire->active = true;
            }
            $procedire->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The procedure status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected procedure doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}
