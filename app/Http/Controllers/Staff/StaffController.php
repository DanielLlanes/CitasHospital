<?php

namespace App\Http\Controllers\Staff;

use DataTables;
use App\Models\Staff\Staff;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Staff\Service;
use App\Models\Staff\Specialty;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewMemberOfStaff;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class StaffController extends Controller
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
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        if (!Auth::guard('staff')->user()->can('staff.list.admins') && !Auth::guard('staff')->user()->can('staff.list')) {
            abort(403, 'Unauthorized action.');
        }
        $can_list_admins = Auth::guard('staff')->user()->can('staff.list.admins');

        $staff = Staff::whereHas(
            'roles', function($query) use ($lang, $can_list_admins) {
                if ($can_list_admins) {
                    $query->where('show', true)
                    ->select(["id", "name_$lang AS Rname", 'name']);
                } else {
                    $query->where('show', true)
                    ->where('name', '!=', 'administrator')
                    ->select(["id", "name_$lang AS Rname"]);
                }

            }
        )
        ->where('show', true)
        ->with([
            'roles' => function($query) use ($lang) {
                $query->select(["id", "name_$lang AS Rname", "name"]);
            },
            'specialties' => function($query) use ($lang){
                $query->select(["specialties.id", "name_$lang AS Sname"]);
            }
        ])
        ->get();


        //return $staff;



        return view('staff.staff-manager.list');
    }

    public function getStaffList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);
            $can_list_admins = Auth::guard('staff')->user()->can('staff.list.admins');



            $staff = Staff::whereHas(
                'roles', function($query) use ($lang, $can_list_admins) {
                    if ($can_list_admins) {
                        $query->where('show', true)
                        ->select(["id", "name_$lang AS Rname", 'name']);
                    } else {
                        $query->where('show', true)
                        ->where('name', '!=', 'administrator')
                        ->select(["id", "name_$lang AS Rname"]);
                    }

                }
            )
            ->where('show', true)
            ->with([
                'roles' => function($query) use ($lang) {
                    $query->select(["id", "name_$lang AS Rname", "name"]);
                },
                'specialties' => function($query) use ($lang){
                    $query->select(["specialties.id", "name_$lang AS Sname"]);
                }
            ])
            ->get();

            return DataTables::of($staff)
                ->addIndexColumn()
                ->addColumn('picture', function($staff){
                    if (is_null($staff->avatar)) {
                       $avatar ='
                                <a href="'.asset("staffFiles/assets/img/user/user.jpg").'" data-effect="mfp-zoom-in" class="a">
                                    <img src="'.asset("staffFiles/assets/img/user/user.jpg").'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$staff->name.'"/>
                                </a>
                            ';
                    } else {
                        $avatar = '
                                    <a href="'.asset($staff->avatar).'" data-effect="mfp-zoom-in" class="a">
                                        <img src="'.asset($staff->avatar).'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$staff->name.'"/>
                                    </a>
                                ';
                    }
                    return $avatar;
                })
                ->addColumn('name', function($staff){
                    return $staff->name;
                })
                ->addColumn('department', function($staff){
                    foreach ($staff->roles as $rol){
                        return $rol->Rname;
                    }
                })
                ->addColumn('specialization', function($staff) use ($lang){
                    //return $staff->specialties[0]->Sname;
                    $specialties = "<ul style='list-style-type: none'>";
                    foreach ($staff->specialties as $specialty) {
                        $specialties .= "<li><span>$specialty->Sname</span></li>";
                    }
                    $specialties .= "</ul>";

                    return $specialties;
                })
                ->addColumn('color', function($staff){
                    return '<i class="fa fa-circle" style="color: '.$staff->color.'" aria-hidden="true"></i>';
                })
                ->addColumn('mobile', function($staff){
                    return $staff->cellphone;
                })
                ->addColumn('email', function($staff){
                    return $staff->email;
                })
                ->addColumn('active', function($staff){
                    $staff_activate = Auth::guard('staff')->user()->can('staff.activate');
                    $staff_activate_admins = Auth::guard('staff')->user()->can('staff.activate.admins');
                    $table_active = 'table-active';
                    $staff_id = $staff->id;
                    $cursor = 'pointer';

                    if (!$staff_activate_admins && !$staff_activate) {
                       $table_active = '';
                       $staff_id = '';
                       $cursor = 'not-allowed';
                    } elseif (!$staff_activate_admins && $staff_activate) {
                        if ($staff->roles[0]->name == 'administrator') {
                            $table_active = '';
                            $staff_id = '';
                            $cursor = 'not-allowed';
                        }
                    } elseif ($staff_activate_admins && !$staff_activate) {
                        if ($staff->roles[0]->name != 'administrator') {
                            $table_active = 'table-active';
                            $staff_id = $staff->id;
                            $cursor = 'pointer';
                        }
                    } elseif ($staff_activate_admins && $staff_activate) {
                        $table_active = 'table-active';
                        $staff_id = $staff->id;
                        $cursor = 'pointer';
                    }

                    if ($staff->active == '1') {
                        $btn = '<span attr-id="'. $staff_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $staff_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.staff-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'picture', 'name', 'department', 'specialization', 'color', 'mobile', 'email', 'active', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //return Auth::guard('staff')->user()->getPermissionNames();
        if (!Auth::guard('staff')->user()->can('staff.create.admins') && !Auth::guard('staff')->user()->can('staff.create')) {
            abort(403, 'Unauthorized action.');
        }

        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $staff_create = Auth::guard('staff')->user()->can('staff.create');
        $staff_create_permisions = Auth::guard('staff')->user()->can('staff.create.permisions');

        $staff_create_admins = Auth::guard('staff')->user()->can('staff.create.admins');
        $staff_create_permisions_admins = Auth::guard('staff')->user()->can('staff.create.permisions.admins');

        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $admin = "admins";


        if ($staff_create_permisions_admins && !$staff_create_permisions) {
            $admin = "admins";
            $permissions = Permission::select("id", "description_$lang AS description", "group_$lang AS groupP")
            ->where('name', 'like', '%' . $admin . '%')
            ->get();

            $groups = Permission::select("group_$lang AS group")
            ->where('name', 'like', '%' . $admin . '%')
            ->distinct()->get();
        } elseif (!$staff_create_permisions_admins && $staff_create_permisions) {
            $admin = "admins";
            $permissions = Permission::select("id", "description_$lang AS description", "group_$lang AS groupP")
            ->where('name', 'not like', '%' . $admin . '%')
            ->get();

            $groups = Permission::select("group_$lang AS group")
            ->where('name', 'not like', '%' . $admin . '%')
            ->distinct()->get();

        } elseif ($staff_create_permisions_admins && $staff_create_permisions) {
            $permissions = Permission::select("id", "description_$lang AS description", "group_$lang AS groupP")->get();

            $groups = Permission::select("group_$lang AS group")
            ->distinct()->get();

        } elseif (!$staff_create_permisions_admins && !$staff_create_permisions) {
            $permissions = Permission::select("id", "description_$lang AS description", "group_$lang AS groupP")->get();
            $groups = Permission::select("group_$lang AS group")
            ->distinct()->get();
        }


        if ($staff_create_admins && $staff_create) {
            $roles = Role::selectRaw("id, name_$lang AS name, assignable")
            ->where('show', '=', '1')
            ->get();
            $specialties = Specialty::selectRaw("id, name_$lang AS Sname, assignable")
            ->where('show', 1)
            ->get();
        } elseif ($staff_create_admins && !$staff_create) {
            $roles = Role::selectRaw("id, name_$lang AS name, assignable")
            ->where('show', '=', '1')
            ->where('name', '=', 'administrator')
            ->get();
            $specialties = Specialty::selectRaw("id, name_$lang AS Sname, assignable")
            ->where('show', 1)
            ->where('name', '=', 'administrator')
            ->get();
        } elseif (!$staff_create_admins && $staff_create) {
            $roles = Role::selectRaw("id, name_$lang AS name, assignable")
            ->where('show', '=', '1')
            ->where('name', '!=', 'administrator')
            ->get();
            $specialties = Specialty::selectRaw("id, name_$lang AS Sname, assignable")
            ->where('show', 1)
            ->where('name', '!=', 'administrator')
            ->get();
        }

        $services = Service::selectRaw("id, service_$lang AS service")->get();

        return view('staff.staff-manager.add', ['groups' => $groups, 'permissions'=> $permissions, 'roles' => $roles, 'specialties' => $specialties, "services" => $services ]);
    }

    public function getSpecialty(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $specialties = Specialty::select(["id", "name_$lang AS name", "assignable"])
        ->where('role_id', $request->id)->get();
        if (count($specialties) <= 0) {
            return response()->json
            (
                [
                    'icon' => 'error',
                    'msg' => Lang::get('No specialties with that name have been found!'),
                    'reload' => true,
                    'data' => ''
                ]
            );
        };

        return response()->json
        (
            [
                'icon' => 'success',
                'msg' => Lang::get('User status changed successfully!'),
                'reload' => false,
                'data' => $specialties
            ]
        );
    }

    public function getAssignation(Request $request)
    {
        //return $request;
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $specialty = Specialty::where
        (
            [
                "show" => true,
                "assignable" => true,
            ]
        )
        ->with
            (
                [
                    'services' => function($q) use ($lang){
                        $q->select("service_$lang as service");

                    }
                ]
            )
        ->where("id", $request->id)
        ->get();

        $collection = new Collection;

        foreach ($specialty as $key => $value) {
            foreach ($value->services as $key => $valueDos) {
                $collection->push((object)[
                    'service' => $valueDos->service,
                ]);
            }
        }

        return response()->json
        (
            [
                'icon' => 'success',
                'reload' => false,
                'data' => $collection->unique('service')
            ]
        );
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
        //
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $assingnamentCheck = [];
        //$assingnamentCheck = 0;

        if ($request->has('specialties')) {
            
            foreach ($request->specialties as $specialty) {
                $hasAssignable = Specialty::select('id', 'assignable')->where('id', $specialty)->first();
                //return $hasAssignable->assignable;
                if ($hasAssignable->assignable == 1) {
                     array_push($assingnamentCheck, $hasAssignable->assignable);
                }
            }
        }

        if (!Auth::guard('staff')->user()->can('staff.create.admins') && !Auth::guard('staff')->user()->can('staff.create')) {
            abort(403, 'Unauthorized action.');
        }
        $staff_create_admins = Auth::guard('staff')->user()->can('staff.create.admins');
        $staff_create_permisions_admins = Auth::guard('staff')->user()->can('staff.create.permisions.admins');
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $validated = $request->validate([
            'avatar' => 'sometimes|image',
            'name' => 'required|string|max:255',
            'language' => 'required|string|max:2',
            'username' => 'required|unique:staff',
            'phone' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'cellphone' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'email' => 'required|email|unique:staff',
            'role' => 'required|exists:roles,id',
            'color' =>  [
                'required',
                'unique:staff',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ],

            "specialties" => "required|array|min:1",
            "specialties.*"  => "required|distinct|exists:specialties,id",

            "assigned_to" =>
            [
                ($assingnamentCheck > 0) ? 'array':'',
                ($assingnamentCheck > 0) ? 'min:1':'',
            ],
            "assigned_to.*" =>
            [
                ($assingnamentCheck > 0) ? "string" : '',
                ($assingnamentCheck > 0) ? "distinct" : '',
                ($assingnamentCheck > 0) ? "exists:services,service_$lang" : '',
            ],
        ]);

        $avatar = "staffFiles/assets/img/user/user.jpg";
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $destinationPath = storage_path('app/public').'/staff/avatar';
            $img_name = time().uniqid(Str::random(30)).'.'.$avatar->getClientOriginalExtension();
            $img = Image::make($avatar->getRealPath());
            $width = 600;
            $height = 600;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '80');
            $avatar = "storage/staff/avatar/$img_name";
            $img->destroy();
        }

        $admin = "admins";
        $is_admin = role::findOrFail($request->role);
        //return($is_admin);

        if (!$staff_create_admins) {
            if ($is_admin->name == "administrator") {
                abort(403, 'Unauthorized action.');
                return;
            }
        }


        if (!$staff_create_permisions_admins) {
            if ($request->permissions > 0) {
                foreach ($request->permissions as $key => $value) {
                    $per = Permission::findOrFail($value);
                    $cadena_de_texto = $per->name;
                    $cadena_buscada   = 'admin';
                    $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
                    if ($posicion_coincidencia) {
                        abort(403, 'Unauthorized action.');
                        return;
                    }
                }
            }
        }

        $unHashPassword = Str::random(8);
        $staff = New Staff;
        $staff->name = $request->name;
        $staff->username = $request->username;
        $staff->cellphone = $request->cellphone;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->password = Hash::make($unHashPassword);
        $staff->lang = $request->language;
        $staff->avatar = $avatar;
        $staff->color = strtolower($request->color);
        $staff->specialty_id = $request->specialty;
        $staff->url = Str::slug($request->url, '-');

        $assignment = [];


        if ($request->has('assigned_to')){
            for ($i=0; $i < count($request->assigned_to); $i++) {
                $id_service = Service::select('id', "service_$lang As name")->where("service_$lang", $request->assigned_to[$i])->first();
                array_push($assignment, $id_service->id);
            }

        }
        if ($staff->save()) {
            if (count($assignment) > 0) {
                for ($i=0; $i < count($assignment); $i++) {
                    $assignTo[] = [
                        'service_id' => $assignment[$i],
                        'staff_id' => $staff->id,
                        'order' => ($i+1)
                    ];
                }
                $staff->assignToService()->sync($assignTo);
                $staff->specialties()->sync($request->specialties);
            }

            $dataMsg = array(
                'reciver' => $request->email,
                'reciverName' => $request->name,
                'password' => $unHashPassword,
                'username' => $request->username,
                'sender' => Auth::guard('staff')->user()->email,
                'senderName' => Auth::guard('staff')->user()->name,
                'lang' => $request->language
            );
            
            Mail::send(new WelcomeNewMemberOfStaff($dataMsg));


            $staff->syncRoles([$request->role]);
            app()->setLocale($lang);
            return redirect()->route('staff.staff.staff')->with(
                [
                    'sys-message' => '',
                    'icon' => 'success',
                    'msg' => Lang::get('User created successfully!')
                ]
            );
        }
        return redirect()->back()->with(
            [
                'sys-message' => '',
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the user please try again!')
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (!Auth::guard('staff')->user()->can('staff.edit.admins') && !Auth::guard('staff')->user()->can('staff.edit')) {
            abort(403, 'Unauthorized action.');
        }
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $staff_edit = Auth::guard('staff')->user()->can('staff.edit');
        $staff_edit_permisions = Auth::guard('staff')->user()->can('staff.edit.permisions');

        $staff_edit_admins = Auth::guard('staff')->user()->can('staff.edit.admins');
        $staff_edit_permisions_admins = Auth::guard('staff')->user()->can('staff.edit.permisions.admins');
        $admin = "admins";

        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $staff = Staff::where('show', true)
        ->with([
            'roles' => function($query) use ($lang) {
                $query->select(["id", "name_$lang AS Rname", "name"]);
            },
            'specialties' => function($query) use ($lang){
                $query->select(["specialties.id", "name_$lang AS Sname"]);
            },
            'assignToService' => function($query) use ($lang){
                $query->select(["services.id", "service_$lang AS atsName"]);
            },
        ])
        ->findOrFail($id);

        if ($staff->roles[0]->name == 'administrator') {
            if (!$staff_edit_admins) {
                abort(403, 'Unauthorized action.');
            }
        }


        if ($staff_edit_admins && $staff_edit) {
            $roles = Role::selectRaw("id, name_$lang AS name")
            ->where('show', '=', '1')
            ->get();
            $specialties = Specialty::selectRaw("id, name_$lang AS Sname, assignable")
            ->where('show', 1)
            ->get();
            
        } elseif ($staff_edit_admins && !$staff_edit) {
            $roles = Role::selectRaw("id, name_$lang AS name")
            ->where('show', '=', '1')
            ->where('name', '=', 'administrator')
            ->get();
            
            $specialties = Specialty::selectRaw("id, name_$lang AS Sname, assignable")
            ->where('show', 1)
            ->where('name', '=', 'administrator')
            ->get();
            
        } elseif (!$staff_edit_admins && $staff_edit) {
            $roles = Role::selectRaw("id, name_$lang AS name")
            ->where('show', '=', '1')
            ->where('name', '!=', 'administrator')
            ->get();
            $specialties = Specialty::selectRaw("id, name_$lang AS Sname, assignable")
            ->where('show', 1)
            ->where('name', '!=', 'administrator')
            ->get();
        }

        $services = Service::selectRaw("id, service_$lang AS service")->get();

        return view('staff.staff-manager.edit', ['staff' => $staff, 'roles' => $roles, 'specialties' => $specialties, "services" => $services]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request;
        if (!Auth::guard('staff')->user()->can('staff.edit.admins') && !Auth::guard('staff')->user()->can('staff.edit')) {
            abort(403, 'Unauthorized action.');
        }
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $staff_edit = Auth::guard('staff')->user()->can('staff.edit');
        $staff_edit_permisions = Auth::guard('staff')->user()->can('staff.edit.permisions');

        $staff_edit_admins = Auth::guard('staff')->user()->can('staff.edit.admins');
        $staff_edit_permisions_admins = Auth::guard('staff')->user()->can('staff.edit.permisions.admins');

        $staff = Staff::findOrFail($id);

        $assingnamentCheck = [];
        //$assingnamentCheck = 0;

        if ($request->has('specialties')) {
            
            foreach ($request->specialties as $specialty) {
                $hasAssignable = Specialty::select('id', 'assignable')->where('id', $specialty)->first();
                //return $hasAssignable->assignable;
                if ($hasAssignable->assignable == 1) {
                     array_push($assingnamentCheck, $hasAssignable->assignable);
                }
            }
        }


        $validated = $request->validate([
            'avatar' => 'sometimes|image',
            'name' => 'required|string|max:255',
            'language' => 'required|string|max:2',
            'username' => 'required|unique:staff,username,'.$staff->id,
            'phone' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'cellphone' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'email' => 'required|unique:staff,email,'.$staff->id,
            'role' => 'required|exists:roles,id',
            'color' =>  [
                'required',
                'unique:staff,color,'.$staff->id,
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ],
            "specialties" => "required|array|min:1",
            "specialties.*"  => "required|distinct|exists:specialties,id",

            "assigned_to" =>
            [
                ($assingnamentCheck > 0) ? 'array':'',
                ($assingnamentCheck > 0) ? 'min:1':'',
            ],
            "assigned_to.*" =>
            [
                ($assingnamentCheck > 0) ? "string" : '',
                ($assingnamentCheck > 0) ? "distinct" : '',
                ($assingnamentCheck > 0) ? "exists:services,service_$lang" : '',
            ],
        ]);

        $admin = "admins";

        $is_admin = role::findOrFail($request->role);

        if (!$staff_edit_admins) {
            if ($is_admin->name == "administrator") {
                abort(403, 'Unauthorized action.');

            }
        }

        $lastPhoto = $staff->avatar;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $destinationPath = storage_path('app/public').'/staff/avatar';
            $img_name = time().uniqid(Str::random(30)).'.'.$avatar->getClientOriginalExtension();
            $img = Image::make($avatar->getRealPath());
            $width = 600;
            $height = 600;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '80');
            $avatar = "storage/staff/avatar/$img_name";

            if ($lastPhoto != null || $lastPhoto != 'staffFiles/assets/img/user/user.jpg') {

                unlink(public_path($lastPhoto));
            }
            $img->destroy();
            $staff->avatar = $avatar;
        }

        $staff->name = $request->name;
        $staff->username = $request->username;
        $staff->cellphone = $request->cellphone;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->lang = $request->language;
        $staff->color = strtolower($request->color);
        $staff->specialty_id = $request->specialty;
        $staff->url = Str::slug($request->url, '-');

        $assignment = [];


        if ($request->has('assigned_to')){
            for ($i=0; $i < count($request->assigned_to); $i++) {
                $id_service = Service::select('id', "service_$lang As name")->where("service_$lang", $request->assigned_to[$i])->first();
                array_push($assignment, $id_service->id);
            }
        }

        if ($staff->save()) {
            $staff->assignToService()->detach();
            $staff->syncRoles([$request->role]);
            if (count($assignment) > 0) {
                for ($i=0; $i < count($assignment); $i++) {
                    $assignTo[] = [
                        'service_id' => $assignment[$i],
                        'staff_id' => $staff->id,
                        'order' => ($i+1)
                    ];
                }
                //$staff->assignToService()->remove();
                $staff->assignToService()->sync($assignTo);
                
            }
            $staff->specialties()->sync($request->specialties);
            return redirect()->route('staff.staff.staff')->with(
                [
                    'sys-message' => '',
                    'icon' => 'success',
                    'msg' => Lang::get('User edited successfully!')
                ]
            );
        }
        return redirect()->back()->with(
           [
               'sys-message' => '',
               'icon' => 'error',
               'msg' => Lang::get('The user you are trying to edit does\'t exist or was previously edited!')
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
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $staff = Staff::find($request->id);
        if($staff->exists()){
            $staff->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('User successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The User you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }
    public function activate(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $staff = Staff::with(['roles'])
        ->find($request->id);
        $staff_activate = Auth::guard('staff')->user()->can('staff.activate');
        $staff_activate_admins = Auth::guard('staff')->user()->can('staff.activate.admins');

        if ($staff) {
            if ($staff->active == 1) {
                $staff->active = false;
            } elseif ($staff->active == 0) {
                $staff->active = true;
            }
            $staff->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('User status is changed successfully!'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We could not find the selected user!'),
                    'reload' => false
                ]
            );
        }
    }
}
