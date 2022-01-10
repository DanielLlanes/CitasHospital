<?php

namespace App\Http\Controllers\Staff;

use App\Events\DebateChatEvent;
use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Models\Staff\Debate;
use App\Models\Staff\Patient;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use App\Models\Staff\Treatment;
use App\Traits\DatesLangTrait;
use App\Traits\StatusAppsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AppController extends Controller
{
    use StatusAppsTrait,
        DatesLangTrait;

    public function __construct()
    {
        $this->middleware('auth:staff');
        // $this->middleware('can:ListAdmins')->only(['getAdmins', 'index']);
        // $this->middleware('can:CreateAdmins')->only(['create','store']);
        // $this->middleware('can:EditAdmins')->only(['edit','update']);
        // $this->middleware('can:DeleteAdmins')->only(['destroy']);
        // $this->middleware('can:ActivateAdmins')->only(['activarAdministradores']);
        // $this->middleware('can:ShowAdmins')->only(['show']);
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
        $services = [];
        $userService = Staff::with('assignToService')->select("id")->find(Auth::guard('staff')->user()->id);
        foreach ($userService->assignToService  as $value) {array_push($services, $value->id);}
        
        $applications = Treatment::whereHas(
            "service", function($q)use($services){
                $q->whereIn("id", $services);
            }
        )
        ->with(
            [
                "applications" => function($q)use($lang)
                {
                    $q->where('is_complete', true)
                    ->with(
                        [
                            'patient' => function($q){
                                $q->select('name', 'id');
                            },
                            'treatment' => function($q) use($lang) {
                                $q->with(
                                    [
                                        "brand" => function($q){
                                            $q->select("brand", "id", "color");
                                        },
                                        "service" => function($q) use($lang) {
                                            $q->select("service_$lang AS service", "id");
                                        },
                                        "procedure" => function($q) use($lang) {
                                            $q->select("procedure_$lang AS procedure", "id");
                                        },
                                        "package" => function($q) use($lang) {
                                            $q->select("package_$lang AS package", "id");
                                        },
                                    ]
                                );
                            },
                            'assignments' => function($q) use($lang) {
                                $q->whereHas(
                                    'specialties', function($q){
                                        $q->where("name_en", "Coordination");
                                    }
                                );
                            }
                        ]
                    );
                }
            ]
        )
        ->get();

        $collection = new Collection();
    
        for ($i = 0; $i < count($applications); $i++) {
            for ($j = 0; $j < count($applications[$i]->applications); $j++) {
                $collection->push(
                    $applications[$i]->applications[$j],
                );
            }
        }
        //return $collection[0]->temp_code;
        return view
        (
            'staff.application-manager.list'
        );
    }

    public function getList(Request $request)
    {

        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);
            if (Auth::guard("staff")->user()->hasAnyRole(['dios', 'super-administrator', 'administrator', 'nurse', 'driver', 'coordinator'])) {
                $apps = Application::with(
                    [
                        'patient' => function($q){
                            $q->select('name', 'id');
                        },
                        'treatment' => function($q) use($lang) {
                            $q->with(
                                [
                                    "brand" => function($q){
                                        $q->select("brand", "id", "color");
                                    },
                                    "service" => function($q) use($lang) {
                                        $q->select("service_$lang AS service", "id");
                                    },
                                    "procedure" => function($q) use($lang) {
                                        $q->select("procedure_$lang AS procedure", "id");
                                    },
                                    "package" => function($q) use($lang) {
                                        $q->select("package_$lang AS package", "id");
                                    },
                                ]
                            );
                        },
                        'assignments' => function($q) use($lang) {
                            $q->whereHas(
                                'specialties', function($q){
                                    $q->where("name_en", "Coordination");
                                }
                            );
                        }
                    ]
                )
                ->where('is_complete', true)
                ->get();
            }

            
            if (Auth::guard("staff")->user()->hasAnyRole(['doctor'])) {
                $services = [];
                $userService = Staff::with('assignToService')->select("id")->find(Auth::guard('staff')->user()->id);
                foreach ($userService->assignToService  as $value) {array_push($services, $value->id);}
                
                $applications = Treatment::whereHas(
                    "service", function($q)use($services){
                        $q->whereIn("id", $services);
                    }
                )
                ->with(
                    [
                        "applications" => function($q)use($lang)
                        {
                            $q->where('is_complete', true)
                            ->with(
                                [
                                    'patient' => function($q){
                                        $q->select('name', 'id');
                                    },
                                    'treatment' => function($q) use($lang) {
                                        $q->with(
                                            [
                                                "brand" => function($q){
                                                    $q->select("brand", "id", "color");
                                                },
                                                "service" => function($q) use($lang) {
                                                    $q->select("service_$lang AS service", "id");
                                                },
                                                "procedure" => function($q) use($lang) {
                                                    $q->select("procedure_$lang AS procedure", "id");
                                                },
                                                "package" => function($q) use($lang) {
                                                    $q->select("package_$lang AS package", "id");
                                                },
                                            ]
                                        );
                                    },
                                    'assignments' => function($q) use($lang) {
                                        $q->whereHas(
                                            'specialties', function($q){
                                                $q->where("name_en", "Coordination");
                                            }
                                        );
                                    }
                                ]
                            );
                        }
                    ]
                )
                ->get();

                $apps = new Collection();
                
                for ($i = 0; $i < count($applications); $i++) {
                    for ($j = 0; $j < count($applications[$i]->applications); $j++) {
                        $apps->push(
                            $applications[$i]->applications[$j],
                        );
                    }
                }
            }


            return DataTables::of($apps)
                ->addIndexColumn()
                ->addColumn('codigo', function($apps){
                    return '<span>'.$apps->temp_code.'</span>';
                })
                ->addColumn('paciente', function($apps){
                    return '<span>'.$apps->patient->name.'</span>';
                })
                ->addColumn('marca', function($apps){
                    return '<span style="color: '.$apps->treatment->brand->color.'">'.$apps->treatment->brand->brand.'</span>';
                })
                ->addColumn('servicio', function($apps){
                    return '<span>'.$apps->treatment->service->service.'</span>';
                })
                ->addColumn('procedimiento', function($apps){
                    return '<span>'.$apps->treatment->procedure->procedure.'</span>';
                })
                ->addColumn('paquete', function($apps){
                    if (!is_null($apps->treatment->package)) {
                        return '<span>'.$apps->treatment->package->package.'</span>';
                    } else {
                        return '<span> ---- </span>';
                    }

                })
                ->addColumn('coordinador', function($apps){
                    if (count($apps->assignments) < 1) {
                        return '<span>Not Assigned</span>';
                    } else {
                        return '<span style="color: '.$apps->assignments[0]->color.'">'.$apps->assignments[0]->name.'</span>';
                    }

                })
                ->addColumn('fecha', function($apps){
                    return '<span>'. $this->datesLangTrait($apps->created_at, Auth::guard('staff')->user()->lang). '</span>';
                })
                ->addColumn('precio', function($apps){
                    return '<span>$ '.$apps->treatment->price.'</span>';
                })
                ->addColumn('status', function($apps){
                    return $this->statusAppTrait($apps->status);
                })
                ->addColumn('acciones', 'staff.application-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'codigo', 'paciente', 'marca', 'servicio', 'procedimiento', 'paquete', "coordinador", 'fecha', 'precio',  'status', 'acciones'])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        $applications = Application::with(
            [

                'patient' => function($q){
                    $q->with(['country', 'state']);
                },
                'treatment' => function($q) use($lang) {
                    $q->with(
                        [
                            "brand" => function($q){
                                $q->select("brand", "id", "color");
                            },
                            "service" => function($q) use($lang) {
                                $q->select("service_$lang AS service", "id");
                                $q->with(
                                    [
                                        'specialties' => function($q) use($lang) {
                                            $q->select("name_$lang AS specialty", "specialties.id");
                                        }
                                    ]
                                );
                            },
                            "procedure" => function($q) use($lang) {
                                $q->select("procedure_$lang AS procedure", "id");
                            },
                            "package" => function($q) use($lang) {
                                $q->select("package_$lang AS package", "id");
                            },
                        ]
                    );
                },
                'assignments' => function($q)use($lang){
                    $q->with(
                        [
                            'specialties' => function($q)use($lang){
                                $q->select("*", "name_$lang AS name");
                            },
                        ]
                    );
                },
                'medications',
                'surgeries',
                'illnessess',
                'exercices',
                'hormones',
                'images',
                'birthcontrol',
                'debates' => function($q){
                    $q->with(['staff_debate']);
                }

            ]
        )
        ->findOrFail($id);
        //return($applications);
        $treatment = $applications->treatment;
        $cordinators = Staff::whereHas // no se requiere
        (
            'specialties', function($q)
            {
               $q->where('specialties.id', 10);
            },
        )
        ->whereHas
        (
            'assignToService', function($q) use($treatment)
            {
                $q->where("services.id", $treatment->service->id);
            }  
        )
        ->orderBy('last_assignment', 'ASC')
        ->with
        (
            [
                'specialties',
                'assignToService' 
            ]
        )
        ->get();  // no se requiere


        $debateSpecialties =  $applications->treatment->service->specialties;
        $debateDoctors = new Collection();
        $debateMembers = new Collection();
        

        foreach ($debateSpecialties as $value) {
            $assignment = Staff::whereHas
            (
                
                'specialties', function($q)use($value, $lang)
                {
                   $q->where('specialties.id', $value->id);
                },
            )
            ->whereHas
            (
                'assignToService', function($q) use($treatment)
                {
                    $q->where("services.id", $treatment->service->id);
                }  
            )
            ->with
            (
                [
                    'specialties' => function($q)use($lang, $value)
                    {
                        $q->select("name_$lang AS Sname", 'specialties.id')
                        ->where('specialties.id', $value->id);
                    },
                    'assignToService' => function($q)use($lang, $treatment)
                    {
                        $q->select("service_$lang AS Sname", 'services.id')
                        ->where("services.id", $treatment->service->id);
                    },
                    "roles"
                ]
            )
            ->select("id","name", "email", "avatar")
            ->get();

            //return ($assignment );

            $debateDoctors->push((object)[
                'members' => $assignment,
            ]);
        }

        for ($i = 0; $i <count($debateDoctors) ; $i++) {
            foreach ($debateDoctors[$i]->members as $key => $value) {
                if ($value->specialties[0]->id != 10) {
                    $debateMembers->push((object)[
                        'member_name' => $value->name,
                        'member_id' => $value->id,
                        'member_specialty' => $value->specialties[0]->Sname,
                        'member_service' => $value->assignToService[0]->Sname,
                        'member_role' => $value->roles[0]->name,
                        'member_avatar' => asset($value->avatar),
                    ]);
                }
                
            }
        }

        
        if (Auth::guard("staff")->user()->hasAnyRole(['dios', 'super-administrator', 'administrator'])) {
            $debateMembers->push((object)[
                'member_name' => Auth::guard("staff")->user()->name,
                'member_id' => Auth::guard("staff")->user()->id,
                'member_specialty' => null,
                'member_service' => null,
                'member_role' => Auth::guard("staff")->user()->roles[0]->name,
                'member_avatar' => asset(Auth::guard('staff')->user()->avatar),
            ]);
        }

//return($applications);
        return view
        (
            'staff.application-manager.app-details',
            [
                'appInfo' => $applications,
                "debateMembers" => $debateMembers, // no se requiere
            ]
        );
    }

    public function patientApss(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $patientApp = Application::with(
            [
                'patient' => function($q) {
                    $q->with(['country', 'state']);
                },
                'treatment' => function($q) use($lang) {
                    $q->with(
                        [
                            "brand" => function($q){
                                $q->select("brand", "id", "color");
                            },
                            "service" => function($q) use($lang) {
                                $q->select("service_$lang AS service", "id");
                            },
                            "procedure" => function($q) use($lang) {
                                $q->select("procedure_$lang AS procedure", "id");
                            },
                            "package" => function($q) use($lang) {
                                $q->select("package_$lang AS package", "id");
                            },
                        ]
                    );
                },
                'assignments' => function($q) use($lang) {
                    $q->whereHas(
                        'specialty', function($q){
                            $q->where("name_en", "Coordination");
                        }
                    );
                }
            ]
        )
        ->where('patient_id', $request->id)
        ->get();

        //return $patientApp;
        if ($request->ajax()) {

            return DataTables::of($patientApp)
                ->addIndexColumn()
                ->addColumn('brand', function($patientApp){
                    return '<span style="color: '.$patientApp->treatment->brand->color.'">'.$patientApp->treatment->brand->brand.'</span>';
                })
                ->addColumn('service', function($patientApp){
                    return '<span >'.$patientApp->treatment->service->service.'</span>';
                })
                ->addColumn('procedure', function($patientApp){
                    return '<span>'.$patientApp->treatment->procedure->procedure.'</span>';
                })
                ->addColumn('package', function($patientApp){
                    if (!is_null($patientApp->treatment->package)) {
                        return '<span>'.$patientApp->treatment->package->package.'</span>';
                    } else {
                        return '<span> ---- </span>';
                    }
                })
                ->addColumn('coordinator', function($patientApp){
                    if (count($patientApp->assignments) < 1) {
                        return '<span>Not Assigned</span>';
                    } else {
                        return '<span style="color: '.$patientApp->assignments[0]->color.'">'.$patientApp->assignments[0]->name.'</span>';
                    }
                })
                ->addColumn('date', function($patientApp){
                    return '<span>'.$patientApp->created_at->toDayDateTimeString().'</span>';
                })
                ->addColumn('code', function($patientApp){
                    return '<span>'.$patientApp->temp_code.'</span>';
                })
                ->addColumn('status', function($patientApp){
                    return '<span class="label label-sm label-danger">'.ucwords($patientApp->status).'</span>';
                })
                ->rawColumns(['DT_RowIndex', 'code', 'brand', 'service', 'procedure', 'package', "coordinator", 'date', 'status'])
                ->make(true);
        }
    }

    public function setNewStaff(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang); 

        $oldStaff = !is_null($request->oldName);

        //return response()->json($oldStaff);
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|exists:staff,name',
            'id' => 'string|required|exists:staff,id',
            'app' => 'required|exists:applications,id',
            'specialty' => 'required|exists:specialties,name_'.$lang,
            'oldName' => [
                ($oldStaff) ? 'exists:staff,name': null
            ],
        ]);
        $specialty = $request->specialty;
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        if ($oldStaff) {
            $oldStaff = $newStaff = Staff::where('name', $request->oldName)->first();
            Application::find($request->app)->assignments()->detach($oldStaff->id);
        }

        $newStaff = Staff::where('name', $request->name)->first();

        //Application::find($request->app)->assignments()->detach($idOldStaff);

        $order = Specialty::where("name_$lang", $specialty)->first();

        $setNewStaff[] = [
            'staff_id'=>$newStaff->id, 
            'ass_as' => $order->id
        ];
        Application::find($request->app)->assignments()->attach($setNewStaff);

        return response()->json($newStaff);
    }

    public function getNewStaff(Request $request)
    {
        $search = $request->search;
        $specialty = $request->specialty;

        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        

        $app = $applications = Application::with(
            [
                'treatment' => function($q) use($lang) {
                    $q->with(
                        [
                            "service" => function($q) use($lang) {
                                $q->select("service_$lang AS service", "id");
                                $q->with(
                                    [
                                        'specialties' => function($q) use($lang) {
                                            $q->select("name_$lang AS specialty", "specialties.id");
                                        }
                                    ]
                                );
                            },
                        ]
                    );
                },
            ]
        )
        ->findOrFail($request->app);

        $treatment = $applications->treatment;

        if($search == ''){
            $staff = Staff::orderby('name','asc')->select('id','name')->limit(5)
            ->whereHas
            (
                'specialties', function($q)use($lang, $specialty)
                {
                   $q->where("specialties.name_$lang", $specialty);
                },
            )
            ->whereHas
            (
                'assignToService', function($q) use($treatment)
                {
                    $q->where("services.id", $treatment->service->id);
                }  
            )
            ->get();
        }else{
            $staff = Staff::orderby('name','asc')->select('id','name')
            ->where('name', 'like', '%' .$search . '%')->limit(5)
            ->whereHas
            (
                'specialties', function($q)use($lang, $specialty)
                {
                   $q->where("specialties.name_$lang", $specialty);
                },
            )
            ->whereHas
            (
                'assignToService', function($q) use($treatment)
                {
                    $q->where("services.id", $treatment->service->id);
                }  
            )
            ->get();
        }

        return($staff);
    }

    public function sendDebateMessage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang); 
        $validator = Validator::make($request->all(), [
                'message' => 'required|string',
                'debate' => 'required|integer|exists:applications,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        //$members = json_decode($request->members);
        $date = Carbon::now();
        $hours = $date->format('g:i A');
        $debate = new Debate();
        $debate->staff_id = Auth::guard('staff')->user()->id;
        $debate->application_id = $request->debate;
        $debate->message = $request->message;
        $debate->created_at = $date->toDateTimeString();
        $debate->updated_at = $date->toDateTimeString();

        if ($debate->save()) {
            $response = [];
            $staff = Staff::select("id", "name", "avatar")->find($debate->staff_id);
            $response['user_id'] = $staff;
            $response['message'] = $debate->message;
            $response['debate_id'] = $debate->application_id;
            $response['timestamp'] = $this->datesLangTrait($date, Auth::guard('staff')->user()->lang) . ", " .$hours;

            return response()->json([
                'success' => true,
                'response' => $response,
            ]);
        }
    }
}
