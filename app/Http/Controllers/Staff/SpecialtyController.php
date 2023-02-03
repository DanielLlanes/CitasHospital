<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Staff\Specialty;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SpecialtyController extends Controller
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
    public function index()
    {
        $specialties = Specialty::with([
            'role' =>function($q) {
                $q->where('show', 1);
            }
        ])->where('show', 1)->get();
        $roles = Role::where('show', 1)->get();
       // return $specialties;
        return view('staff.appConfig.specialty', ["roles" => $roles]);
    }


    public function getSpecialties(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $specialties = Specialty::with('role')->where('show', 1)->get();
            return DataTables::of($specialties)
                ->addIndexColumn()
                ->addColumn('rol', function($specialties){
                    return '<span class="text-capitalize">'.ucfirst($specialties->role->name).'</span>';
                })
                ->addColumn('name_es', function($specialties){
                    return '<span class="text-capitalize">'.ucfirst($specialties->name_es).'</span>';
                })
                ->addColumn('name_en', function($specialties){
                    return '<span class="text-capitalize">'.ucfirst($specialties->name_en).'</span>';
                })
                ->addColumn('assignable', function($specialties){
                    return '<span class="text-capitalize">'.ucfirst($specialties->assignable).'</span>';
                })
                ->addColumn('manySpecialties', function($specialties){
                    return '<span class="text-capitalize">'.ucfirst($specialties->many_specialties).'</span>';
                })
                ->addColumn('active', function($specialties){
                    $table_active = 'table-active';
                    $specialties_id = $specialties->id;
                    $cursor = "pointer";

                    if ($specialties->active == '1') {
                        $btn = '<span attr-id="'. $specialties_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $specialties_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.appConfig.actions-list')
                ->rawColumns(['DT_RowIndex', 'rol','name_es', 'name_en','assignable', 'manySpecialties', 'active','action'])
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

        $validator = Validator::make($request->all(), [

            'name_es' => 'required|string',
            'name_en' => 'required|string',
            'assignable'  => 'required|boolean',
            'many_specialties'   => 'required|boolean',
            'role' => 'required|exists:roles,id'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $model = new Specialty();
        $model->name_en = $request->name_en;
        $model->name_es = $request->name_es;
        $model->many_specialties = $request->many_specialties;
        $model->assignable = $request->assignable;
        $model->role_id = $request->role;
        $model->code = getCode();

        if ($model->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New specialty was successfully created!'),
                    'reload' => true
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the specialty please try again!'),
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
        $model = Specialty::find($request->id);


        if ($model) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $model,
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
        $model = Specialty::find($request->id);
        if ($model) {
            $validator = Validator::make($request->all(), [
                'name_es' => 'required|string',
                'name_en' => 'required|string',
                'assignable'  => 'required|boolean',
                'many_specialties'   => 'required|boolean',
                'role' => 'required|exists:roles,id'
                
              ]
            );
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $model->name_en = $request->name_en;
            $model->name_es = $request->name_es;
            $model->many_specialties = $request->many_specialties;
            $model->assignable = $request->assignable;
            $model->role_id = $request->role;

            if ($model->save()) {
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('The Role was successfully edited!'),
                        'reload' => true
                    ]
                );
            }
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn\'t edit this bRole, please try again later'),
                    'reload' => false
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The selected role doesn\'t exist in the database'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {

        $model = Specialty::find($request->id);
        if ($model) {
            if ($model->active == 1) {
                $model->active = false;
            } elseif ($model->active == 0) {
                $model->active = true;
            }
            $model->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The Role status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected Role doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
