<?php

namespace App\Http\Controllers\Staff;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        date_default_timezone_set('America/Tijuana');
    }
    public function index()
    {
        //return Role::where('show', 1)->get();
        
        return view('staff.appConfig.roles');
    }

    public function getRoles(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $roles = Role::where('show', 1)->get();
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('name', function($roles){
                    return '<span class="text-capitalize">'.ucfirst($roles->name).'</span>';
                })
                ->addColumn('name_es', function($roles){
                    return '<span class="text-capitalize">'.ucfirst($roles->name_es).'</span>';
                })
                ->addColumn('name_en', function($roles){
                    return '<span class="text-capitalize">'.ucfirst($roles->name_en).'</span>';
                })
                ->addColumn('guard', function($roles){
                    return '<span class="text-capitalize">'.ucfirst($roles->guard_name).'</span>';
                })
                ->addColumn('active', function($roles){
                    $table_active = 'table-active';
                    $roles_id = $roles->id;
                    $cursor = "pointer";

                    if ($roles->active == '1') {
                        $btn = '<span attr-id="'. $roles_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $roles_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.appConfig.actions-list')
                ->rawColumns(['DT_RowIndex','name', 'name_es', 'name_en','guard', 'active','action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'name_es' => 'required|string',
            'name_en' => 'required|string',
            
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $role = new Role;
        $role->name = $request->name;
        $role->name_en = $request->name_en;
        $role->name_es = $request->name_es;
        $role->guard_name = 'staff';

        if ($role->save()) {
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

    public function edit(Request $request)
    {
        $role = Role::find($request->id);


        if ($role) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $role,
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

    public function update(Request $request)
    {
    

        $role = Role::find($request->id);
        if ($role) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'name_es' => 'required|string',
                'name_en' => 'required|string',
                
              ]
            );
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $role->name = $request->name;
            $role->name_en = $request->name_en;
            $role->name_es = $request->name_es;
            $role->guard_name = 'staff';

            if ($role->save()) {
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


    public function getRolesPermissions(Request $request)
    {
        $permissions = Permission::select("id", "description_es AS description", "group_es AS groupP")->get();
        $groups = Permission::select("group_es AS group")->orderBy("group_es", 'ASC')
            ->distinct()->get();
        
        $role = Role::find($request->id);

        $rolePermissions = Role::findByName($role->name)->permissions;
        
        return response()->json(
            [
                "rolePermissions" => $rolePermissions,
                "permissions" => $permissions,
                "groups" => $groups,
                "id" => $request->id,
                "roleName" => $role->name,
            ]
        );
    }

    public function permissionsSet(Request $request)
    {
        
        $role  = Role::find($request->id);

        $list = json_decode($request->permissionsList);

        $role->syncPermissions($list);
        return response()->json(
            [
                'icon' => 'success',
                'msg' => Lang::get('Permisos actualizados correctamente'),
            ]
        );
    }


    public function activate(Request $request)
    {

        $role = Role::find($request->id);
        if ($role) {
            if ($role->active == 1) {
                $role->active = false;
            } elseif ($role->active == 0) {
                $role->active = true;
            }
            $role->save();
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
