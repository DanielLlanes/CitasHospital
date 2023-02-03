<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
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
        return view('staff.appConfig.permissions');
    }

    public function getPermissions(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $permissions = Permission::where('show', 1)->get();
            return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn('name', function($permissions){
                    return '<span class="">'.$permissions->name.'</span>';
                })
                ->addColumn('group_es', function($permissions){
                    return '<span class="text-capitalize">'.ucfirst($permissions->group_es).'</span>';
                })
                ->addColumn('group_en', function($permissions){
                    return '<span class="text-capitalize">'.ucfirst($permissions->group_en).'</span>';
                })
                ->addColumn('description_es', function($permissions){
                    return '<span class="text-capitalize">'.ucfirst($permissions->description_es).'</span>';
                })
                ->addColumn('description_en', function($permissions){
                    return '<span class="text-capitalize">'.ucfirst($permissions->description_en).'</span>';
                })
                ->addColumn('guard', function($permissions){
                    return '<span class="text-capitalize">'.ucfirst($permissions->guard_name).'</span>';
                })
                ->addColumn('active', function($permissions){
                    $table_active = 'table-active';
                    $permissions_id = $permissions->id;
                    $cursor = "pointer";

                    if ($permissions->active == '1') {
                        $btn = '<span attr-id="'. $permissions_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $permissions_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.appConfig.actions-list')
                ->rawColumns(['DT_RowIndex','name', 'guard', 'group_es', 'group_en', 'description_es', 'description_en','active','action'])
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

        //return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
            'group_es' => 'required|string',
            'group_en' => 'required|string',
            'description_en' => 'required|string',
            'description_es' => 'required|string',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $permissions = new Permission();
        
        $permissions->name = strtolower($request->name);
        $permissions->group_es = $request->group_es;
        $permissions->group_en = $request->group_en;
        $permissions->description_en = $request->description_en;
        $permissions->description_es = $request->description_es;
        $permissions->guard_name = 'staff';
        $permissions->show = 1;

        if ($permissions->save()) {

            $permisionsAll = Permission::all();

            $dios = Role::where('name', 'dios')->first();
            $dios->givePermissionTo($permisionsAll);
            $permisionsOthers = Permission::where('show', 1)->get();

            $superAdmin = Role::where('name', 'super-administrator')->first();
            $admin = Role::where('name', 'administrator')->first();

            $superAdmin->givePermissionTo($permisionsOthers);
            $admin->givePermissionTo($permisionsOthers);
            
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New role was successfully created!'),
                    'reload' => true
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the role please try again!'),
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
    public function edit(Request  $request)
    {
        $permissions = Permission::find($request->id);


        if ($permissions) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $permissions,
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

        //return $request;
        $permissions = Permission::find($request->id);

        
        if ($permissions) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:roles,name'.$request->id,
                'group_es' => 'required|string',
                'group_en' => 'required|string',
                'description_en' => 'required|string',
                'description_es' => 'required|string',
              ]
            );
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }
    

            $permissions->name = strtolower($request->name);
            $permissions->group_es = $request->group_es;
            $permissions->group_en = $request->group_en;
            $permissions->description_en = $request->description_en;
            $permissions->description_es = $request->description_es;
            $permissions->guard_name = 'staff';
            $permissions->show = 1;

            if ($permissions->save()) {
                $permisionsAll = Permission::all();

                $dios = Role::where('name', 'dios')->first();
                $dios->givePermissionTo($permisionsAll);
                $permisionsOthers = Permission::where('show', 1)->get();

                $superAdmin = Role::where('name', 'super-administrator')->first();
                $admin = Role::where('name', 'administrator')->first();

                $superAdmin->givePermissionTo($permisionsOthers);
                $admin->givePermissionTo($permisionsOthers);
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('The permission was successfully edited!'),
                        'reload' => true
                    ]
                );
            }
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn\'t edit this permission, please try again later'),
                    'reload' => false
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The selected permission doesn\'t exist in the database'),
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
    public function destroy($id)
    {
        //
    }

    public function activate(Request $request)
    {

        $permissions = Permission::find($request->id);
        if ($permissions) {
            if ($permissions->active == 1) {
                $permissions->active = false;
            } elseif ($permissions->active == 0) {
                $permissions->active = true;
            }
            $permissions->save();
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

}
