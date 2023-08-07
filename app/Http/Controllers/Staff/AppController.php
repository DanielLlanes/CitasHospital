<?php

namespace App\Http\Controllers\Staff;

use App\Events\DebateChatEvent;
use App\Http\Controllers\Controller;
use App\Jobs\Staff\Debate\DebateMessagesJob;
use App\Mail\AcceptedLetterEmail;
use App\Mail\AcceptedUnassignedEmail;
use App\Mail\AcceptedWithChangeOfProcedureEmail;
use App\Mail\AcceptedWithsuggestionsMail;
use App\Mail\DeclidedLetterEmail;
use App\Models\Site\Application;
use App\Models\Staff\Approval;
use App\Models\Staff\Debate;
use App\Models\Staff\Package;
use App\Models\Staff\Patient;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use App\Models\Staff\Status;
use App\Models\Staff\Treatment;
use App\Traits\DatesLangTrait;
use App\Traits\StatusAppsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AppController extends Controller
{
    use StatusAppsTrait,
    DatesLangTrait;

    public function __construct()
    {
        $this->middleware('auth:staff');
        $this->middleware('can:applications.list')->only(['getAdmins', 'index']);
        $this->middleware('can:applications.show')->only(['show']);
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
        $apps = Application::with(
            [
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*");
                },
                'patient' => function ($q) {
                    $q->select('name', 'id');
                },
                'partners' => function($q){
                    $q->select('*');
                },
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "brand" => function ($q) {
                                $q->select("brand", "id", "color");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id");
                            },
                            "procedure" => function ($q) use ($lang) {
                                $q->select("procedure_$lang AS procedure", "id");
                            },
                            "package" => function ($q) use ($lang) {
                                $q->select("package_$lang AS package", "id");
                            },
                        ]
                    );
                },
                'assignments' => function ($q) use ($lang) {
                    $q->wherePivot('ass_as', 10);
                }
            ]
        )
        ->where('is_complete', true)
        ->get();

        
        // foreach ($apps as $key => $app) {
        //     $app->price = (!is_null($app->treatment->price)) ? $app->treatment->price:$app->price;
        // }

        return view(
            'staff.application-manager.list'
        );
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();
            if (Auth::guard("staff")->user()->can('applications.all')) {
                $apps = Application::with(
                    [
                        'statusOne' => function ($q) use ($lang) {
                            $q->with([
                                'status' => function ($q) use ($lang) {
                                    $q->select("name_$lang as name", 'id', 'color');
                                }
                            ])
                            ->select("*");
                        },
                        'patient' => function ($q) {
                            $q->select('name', 'id');
                        },
                        'partners' => function($q){
                            $q->select('*');
                        },
                        'treatment' => function ($q) use ($lang) {
                            $q->with(
                                [
                                    "brand" => function ($q) {
                                        $q->select("brand", "id", "color");
                                    },
                                    "service" => function ($q) use ($lang) {
                                        $q->select("service_$lang AS service", "id");
                                    },
                                    "procedure" => function ($q) use ($lang) {
                                        $q->select("procedure_$lang AS procedure", "id");
                                    },
                                    "package" => function ($q) use ($lang) {
                                        $q->select("package_$lang AS package", "id");
                                    },
                                ]
                            );
                        },
                        'assignments' => function ($q) use ($lang) {
                            $q->wherePivot('ass_as', 10);
                        }
                    ]
                )
                ->where('is_complete', true)
                ->get();
            }

            if (!Auth::guard("staff")->user()->can('applications.all')) {
                $services = [];
                $userService = Staff::with('assignToService')->select("id")->find(Auth::guard('staff')->user()->id);
                foreach ($userService->assignToService  as $value) {
                    array_push($services, $value->id);
                }

                $applications = Treatment::whereHas(
                    "service",
                    function ($q) use ($services) {
                        $q->whereIn("id", $services);
                    }
                )
                ->with(
                    [
                        "applications" => function ($q) use ($lang) {
                            $q->where('is_complete', true)
                            ->with(
                                [
                                    'statusOne' => function ($q) use ($lang) {
                                        $q->with([
                                            'status' => function ($q) use ($lang) {
                                                $q->select("name_$lang as name", 'id', 'color');
                                            }
                                        ])
                                        ->select("*");
                                    },
                                    'patient' => function ($q) {
                                        $q->select('name', 'id');
                                    },
                                    'partners' => function($q){
                                        $q->select('*');
                                    },
                                    'treatment' => function ($q) use ($lang) {
                                        $q->with(
                                            [
                                                "brand" => function ($q) {
                                                    $q->select("brand", "id", "color");
                                                },
                                                "service" => function ($q) use ($lang) {
                                                    $q->select("service_$lang AS service", "id");
                                                },
                                                "procedure" => function ($q) use ($lang) {
                                                    $q->select("procedure_$lang AS procedure", "id");
                                                },
                                                "package" => function ($q) use ($lang) {
                                                    $q->select("package_$lang AS package", "id");
                                                },
                                            ]
                                        );
                                    },
                                    'assignments' => function ($q) use ($lang) {
                                        
                                        $q->wherePivot('ass_as', 10);
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
            ->addColumn('codigo', function ($apps) {
                return '<span>' . $apps->temp_code . '</span>';
            })
            ->addColumn('paciente', function ($apps) {
                return '<span>' . $apps->patient->name . '</span>';
            })
            ->addColumn('marca', function ($apps) {
                return '<span style="color: ' . $apps->treatment->brand->color . '">' . $apps->treatment->brand->brand . '</span>';
            })
            ->addColumn('servicio', function ($apps) {
                return '<span>' . $apps->treatment->service->service . '</span>';
            })
            ->addColumn('procedimiento', function ($apps) {
                return '<span>' . $apps->treatment->procedure->procedure . '</span>';
            })
            ->addColumn('paquete', function ($apps) {
                if (!is_null($apps->treatment->package)) {
                    return '<span>' . $apps->treatment->package->package . '</span>';
                } else {
                    return '<span> ---- </span>';
                }
            })
            ->addColumn('coordinador', function ($apps) {
                if (count($apps->assignments) < 1) {
                    return '<span>Not Assigned</span>';
                } else {
                    return '<span style="color: ' . $apps->assignments[0]->color . '">' . $apps->assignments[0]->name . '</span>';
                }
            })
            ->addColumn('fecha', function ($apps) {
                return '<span>' . $this->datesLangTrait($apps->created_at, Auth::guard('staff')->user()->lang) . '</span>';
            })
            ->addColumn('precio_inicial', function ($apps) {

               // $price = ($apps->treatment->price != null ? '$ ' . $apps->treatment->price : "-----");
                return '<span>' . $apps->price . '</span>';
            })
            ->addColumn('precio', function ($apps) {

                $price = ($apps->price != null ? '$ ' . $apps->price : "-----");
                return '<span>' . $price . '</span>';
            })
            ->addColumn('status', function ($apps) {
                //return getStatus($apps->statusOne->status->name, $apps->statusOne->status->color);
                $viewUrl = route('staff.applications.show', ["id" => $apps->id]);
                return '<a href="'.$viewUrl.'">' . getStatus($apps->statusOne->status->name, $apps->statusOne->status->color) . '</a>';
                return $apps->statusOne;
            })
            ->addColumn('partner', function ($apps) {
                if (count($apps->partners)) {
                    return  '<span style="background-color: #ff6961;padding: 5px;border-radius: 0.3rem;">' . $apps->partners[0]->name . '</span>';
                }
                return '----';
            })
            ->addColumn('acciones', function($apps) {
                return view('staff.application-manager.actions-list', compact('apps'));
            })
            ->rawColumns(['DT_RowIndex', 'codigo', 'paciente', 'marca', 'servicio', 'procedimiento', 'paquete', "coordinador", 'fecha', 'partner', 'status', 'acciones'])
            ->make(true);
        }
    }
    public function show($id)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $locale = app()->getLocale();

        $applications = Application::with(
            [
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*")->orderBy('created_at', 'desc')->first();
                },
                'patient' => function ($q) {
                    $q->with(['country', 'state']);
                },
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "brand" => function ($q) {
                                $q->select("brand", "id", "color", "code");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id", "code");
                                $q->with(
                                    [
                                        'specialties' => function ($q) use ($lang) {
                                            $q->select("specialties.id", "name_$lang AS specialty", "specialties.id", "code");
                                        }
                                    ]
                                );
                            },
                            "procedure" => function ($q) use ($lang) {
                                $q->select("procedure_$lang AS procedure", "id", "has_package", "code");
                            },
                            "package" => function ($q) use ($lang) {
                                $q->select("package_$lang AS package", "id", "code");
                            },
                        ]
                    );
                },
                'assignments' => function ($q) use ($lang) {
                    $q->with(
                        [
                            'specialties' => function ($q) use ($lang) {
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
                'imageMany',
                'birthcontrol',
                'suggestions',
                'recommended' => function ($q) use ($lang) {
                    $q->select("procedure_$lang AS procedure", "id", "code");
                },
                'debates' => function ($q) {
                    $q->with(
                        [
                            'staffDebate' => function ($q) {
                                $q->with('imageOne');
                            }
                        ]
                    );
                }

            ]
        )
        ->findOrFail($id);

        $hasRecommended = null;


        if (! is_null($applications->recommended_id)) {
            $hasRecommended = true;
        }
        $packs = new Collection;


        if (! is_null($hasRecommended)) {
            if ($applications->treatment->procedure->has_package == 1) {
                $tr = Treatment::where('procedure_id', $applications->recommended_id)
                ->with([
                    'package' => function($q) use ($lang) {
                        $q->select('id', "package_$lang AS package");
                    }
                ])
                ->get();

                for ($i=0; $i < count($tr); $i++) { 
                    $packs[] = [
                        'id' => $tr[$i]->package->id,
                        'package' => $tr[$i]->package->package,
                    ];
                }
            }
        }

        $existe = false;

        if ($applications->treatment->procedure->has_package == 1) {
            $existe = Treatment::where("procedure_id", $applications->recommended_id)
            ->where('package_id', $applications->treatment->package->id)
            ->first();
        } else {
            $existe = true;
        }


        $StaffAss = Staff::with('assignToSpecialty', 'imageOne')->find(Auth::guard('staff')->user()->id);

        $can = false;
        for ($i = 0; $i < count($StaffAss->assignToSpecialty); $i++) {
            for ($j = 0; $j < count($applications->treatment->service->specialties); $j++) {
                if ($applications->treatment->service->specialties[$j]->id == $StaffAss->assignToSpecialty[$i]->id) {
                    $can = true;
                    break;
                }
            }
        }

        if (Auth::guard("staff")->user()->hasAnyRole(['dios', 'super-administrator', 'administrator', 'nurse', 'driver', 'coordinator'])) {
            $can = true;
        }

        if (!$can) {
            abort(403);
        }

        $treatment = $applications->treatment;

        $cordinators = Staff::whereHas // no se requiere
        (
            'specialties',
            function ($q) {
                $q->where('specialties.id', 10);
            },
        )
        ->whereHas(
            'assignToService',
            function ($q) use ($treatment) {
                $q->where("services.id", $treatment->service->id);
            }
        )
        ->orderBy('last_assignment', 'ASC')
        ->with(
            [
                'specialties',
                'assignToService',
                'imageOne'
            ]
        )
        ->get();  // no se requiere


        $debateSpecialties =  $applications->treatment->service->specialties;
        $debateDoctors = new Collection();
        $debateMembers = new Collection();


        foreach ($debateSpecialties as $value) {
            $assignment = Staff::whereHas(

                'specialties',
                function ($q) use ($value, $lang) {
                    $q->where('specialties.id', $value->id);
                },
            )
            ->whereHas(
                'assignToService',
                function ($q) use ($treatment) {
                    $q->where("services.id", $treatment->service->id);
                }
            )
            ->with(
                [
                    'specialties' => function ($q) use ($lang, $value) {
                        $q->select("name_$lang AS Sname", 'specialties.id')
                        ->where('specialties.id', $value->id);
                    },
                    'assignToService' => function ($q) use ($lang, $treatment) {
                        $q->select("service_$lang AS Sname", 'services.id')
                        ->where("services.id", $treatment->service->id);
                    },
                    "roles",
                    'imageOne'
                ]
            )
            ->select("id", "name", "email")
            ->get();

            //return ($assignment );

            $debateDoctors->push((object)[
                'members' => $assignment,
            ]);
        }

        for ($i = 0; $i < count($debateDoctors); $i++) {
            foreach ($debateDoctors[$i]->members as $key => $value) {
                if ($value->specialties[0]->id != 10) {
                    $debateMembers->push((object)[
                        'member_name' => $value->name,
                        'member_id' => $value->id,
                        'member_specialty' => $value->specialties[0]->Sname,
                        'member_service' => $value->assignToService[0]->Sname,
                        'member_role' => $value->roles[0]->name,
                        'member_avatar' => asset(getAvatar($value)),
                        'memeber_show' => true,
                    ]);
                }
            }
        }

        $members = Staff::with('imageOne')->role(['administrator', 'super-administrator', 'dios'])->get();


        foreach ($members as $member) {
            $debateMembers->push((object)[
                'member_name' => $member->name,
                'member_id' => $member->id,
                'member_specialty' => null,
                'member_service' => null,
                'member_role' => $member->roles[0]->name,
                'member_avatar' => asset(getAvatar($member)),
                'memeber_show' => false,
            ]);
        }

        $getStatus = Status::All();

        $colStatus = new Collection();

        for ($i=0; $i < count($getStatus); $i++) { 
            if ($getStatus[$i]->id == 5 || $getStatus[$i]->id == 16) {
                $colStatus[] = [
                    'id' => $getStatus[$i]->id,
                    'name' => ($lang == 'en')? $getStatus[$i]->name_en:$getStatus[$i]->name_es,
                    'color' => $getStatus[$i]->color,
                    'code' => $getStatus[$i]->code,
                ];
            }
        };
        // $proceduresList = Procedure::where('service_id', $treatment->service->id)
        // ->where('active', 1)
        // ->selectRaw("*,procedure_$lang as name")
        // ->get();

        $proceduresList = sugerencias();
        

        $countSugerencias = count($applications->suggestions);
        $sugerencias = $applications->suggestions;
            //return $sugerencias;


        $suger = new Collection;
        for ($i=0; $i < $countSugerencias; $i++) { 
            $staff = Staff::where('id', $sugerencias[$i]->staff_id)->first();
            $getPro = Procedure::where('id', $sugerencias[$i]->procedure_id)
            ->select("procedure_$lang as procedure", 'service_id')
            ->first();
            if ($getPro) {
                $suger[] = [
                    'name' => $getPro->procedure,
                    'staff' => $staff->name,
                    'service_id' => $getPro,
                ];
            }
        }

        $aprobaciones = Approval::where('service_id', $applications->treatment->service->id)->where('staff_id', Auth::guard('staff')->user()->id)->first();
        $thisUserCanApproval= ($aprobaciones)? true:false;

        return view(
            'staff.application-manager.app-details',
            [
                'appInfo' => $applications,
                "debateMembers" => $debateMembers, // no se requiere
                "packsDsponibles" => $packs,
                "exist" => $existe,
                "statusOptions" => $colStatus,
                "proceduresList" => $proceduresList,
                "sugerencias" => $suger,
                "thisUserCanApproval" => $thisUserCanApproval,
            ]
        );
    }
    public function patientApss(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $patientApp = Application::with(
            [
                'patient' => function ($q) {
                    $q->with(['country', 'state']);
                },
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "brand" => function ($q) {
                                $q->select("brand", "id", "color");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id");
                            },
                            "procedure" => function ($q) use ($lang) {
                                $q->select("procedure_$lang AS procedure", "id");
                            },
                            "package" => function ($q) use ($lang) {
                                $q->select("package_$lang AS package", "id");
                            },
                        ]
                    );
                },
                'assignments' => function ($q) use ($lang) {
                    $q->whereHas(
                        'specialty',
                        function ($q) {
                            $q->where("name_en", "Coordination");
                        }
                    );
                }
            ]
        )
        ->where('patient_id', $request->id)
        ->get();

        if ($request->ajax()) {

            return DataTables::of($patientApp)
            ->addIndexColumn()
            ->addColumn('brand', function ($patientApp) {
                return '<span style="color: ' . $patientApp->treatment->brand->color . '">' . $patientApp->treatment->brand->brand . '</span>';
            })
            ->addColumn('service', function ($patientApp) {
                return '<span >' . $patientApp->treatment->service->service . '</span>';
            })
            ->addColumn('procedure', function ($patientApp) {
                return '<span>' . $patientApp->treatment->procedure->procedure . '</span>';
            })
            ->addColumn('package', function ($patientApp) {
                if (!is_null($patientApp->treatment->package)) {
                    return '<span>' . $patientApp->treatment->package->package . '</span>';
                } else {
                    return '<span> ---- </span>';
                }
            })
            ->addColumn('coordinator', function ($patientApp) {
                if (count($patientApp->assignments) < 1) {
                    return '<span>Not Assigned</span>';
                } else {
                    return '<span style="color: ' . $patientApp->assignments[0]->color . '">' . $patientApp->assignments[0]->name . '</span>';
                }
            })
            ->addColumn('date', function ($patientApp) {
                return '<span>' . $patientApp->created_at->toDayDateTimeString() . '</span>';
            })
            ->addColumn('code', function ($patientApp) {
                return '<span>' . $patientApp->temp_code . '</span>';
            })
            ->addColumn('status', function ($patientApp) {
                return '<span class="label label-sm label-danger">' . ucwords($patientApp->status) . '</span>';
            })
            ->rawColumns(['DT_RowIndex', 'code', 'brand', 'service', 'procedure', 'package', "coordinator", 'date', 'status'])
            ->make(true);
        }
    }
    public function setNewStaff(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $oldStaff = !is_null($request->oldName);

        //return response()->json($oldStaff);
        $request->merge(["specialty" => str_replace("_", " ", $request->specialty)]);
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|exists:staff,name',
            'id' => 'string|required|exists:staff,id',
            'app' => 'required|exists:applications,id',
            'specialty' => 'required|exists:specialties,name_' . $lang,
            'oldName' => [
                ($oldStaff) ? 'exists:staff,name' : null
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $specialty = $request->specialty;

        if ($oldStaff) {
            $oldStaff = Staff::where('name', $request->oldName)->first();
            Application::find($request->app)->assignments()->detach($oldStaff->id);
        }

        $newStaff = Staff::where('name', $request->name)->first();

        $order = Specialty::where("name_$lang", $specialty)->first();


        $setNewStaff[] = [
            'staff_id' => $newStaff->id,
            'ass_as' => $order->id,
            'code' => time() . uniqid(Str::random(30))
        ];

        Application::find($request->app)->assignments()->attach($setNewStaff);
        $saveStaff = $newStaff;
        $saveStaff->last_assignment = date("Y-m-d H:i:s");

        $response = [];

        if ($saveStaff->save()) {
            $date = Carbon::now();
            $hours = $date->format('g:i A');
            $response['staff_id'] = $newStaff->id;
            $response['message'] = "A new application has been assigned to you";
            $response['application_id'] = $request->app;
            $response['timestamp'] = $this->datesLangTrait($date, 'en') . ", " . $hours;
            $response['timeDiff'] = $date->diffForHumans();
            $response['msgStrac'] = Str::of("A new application has been assigned to you")->limit(20);
            $response['lang_en'] = $order->name_en;
            $response['lang_es'] = $order->name_es;
            $response['staff_name'] = $newStaff->name;

            $app =  Application::with([
                'assignments',
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*")->orderBy('created_at', 'desc')->first();
                },
                'treatment' => function($q) use ($lang) {
                    $q->with([
                        'service' => function($q) {
                            $q->with('specialties');
                        },
                    ]);
                },
            ])
            ->find($request->app);
            $changeStatus = false;


            $especialtiesNeeded = count($app->treatment->service->specialties);



            $setStatus = 1;
            if ($app->statusOne->status->id == 14) {
                if ( count($app->assignments) >= $especialtiesNeeded ) {
                    $setStatus = 5;
                    $changeStatus = true;
                }
            } 
            if ($app->statusOne->status_id == 9) {
                if ( count($app->assignments) >= $especialtiesNeeded ) {
                    $setStatus = 1;
                    $changeStatus = true;
                }
            }

            if ($changeStatus) {
                $app->statusOne->delete($app->statusOne->id);
                $app->statusOne()->create(
                    [
                        'status_id' => $setStatus,
                        'indications' => $app->statusOne->indications,
                        'recomendations' => $app->statusOne->recomendations,
                        'code' => getCode(),
                    ]
                );
            }

            $app->notification()->create([
                'staff_id' => $newStaff->id,
                'type' => 'New application',
                'message' => $response['message'],
                'code' => time() . uniqid(Str::random(30)),
            ]);
        }

        $status = Application::with(
            [
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*")->orderBy('created_at', 'desc')->first();
                },
            ]
        )
        ->find($request->app);

        return response()->json([
            'response' => $response,
            'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
            'indications' => $app->statusOne->indications,
            'recomendations' => $app->statusOne->recomendations,
            'success' => true,
            'status_id' => $status->id,
        ]);
    }
    public function getNewStaff(Request $request)
    {

        //return $request;
        $search = $request->search;
        $specialty = $request->specialty;

        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();



        $app = $applications = Application::with(
            [
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id");
                                $q->with(
                                    [
                                        'specialties' => function ($q) use ($lang) {
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



        $staff = Staff::orderby('name', 'asc')->select('id', 'name')->limit(5)
        ->whereHas(
            'specialties',
            function ($q) use ($lang, $specialty) {
                $q->where("specialties.name_$lang", $specialty);
            },
        )
        ->whereHas(
            'assignToService',
            function ($q) use ($treatment) {
                $q->where("services.id", $treatment->service->id);
            }
        )
        ->get();

        return $staff;

        if ($search == '') {
            $staff = Staff::orderby('name', 'asc')->select('id', 'name')->limit(5)
            ->whereHas(
                'specialties',
                function ($q) use ($lang, $specialty) {
                    $q->where("specialties.name_$lang", $specialty);
                },
            )
            ->whereHas(
                'assignToService',
                function ($q) use ($treatment) {
                    $q->where("services.id", $treatment->service->id);
                }
            )
            ->get();
        } else {
            $staff = Staff::orderby('name', 'asc')->select('id', 'name')
            ->where('name', 'like', '%' . $search . '%')->limit(5)
            ->whereHas(
                'specialties',
                function ($q) use ($lang, $specialty) {
                    $q->where("specialties.name_$lang", $specialty);
                },
            )
            ->whereHas(
                'assignToService',
                function ($q) use ($treatment) {
                    $q->where("services.id", $treatment->service->id);
                }
            )
            ->get();
        }
        return $staff;
        return ($staff);
    }
    public function sendDebateMessage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $validator = Validator::make(
            $request->all(),
            [
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

        $date = Carbon::now();
        $hours = $date->format('g:i A');
        $debate = new Debate();
        $debate->staff_id = Auth::guard('staff')->user()->id;
        $debate->application_id = $request->debate;
        $debate->message = $request->message;
        $debate->created_at = $date->toDateTimeString();
        $debate->updated_at = $date->toDateTimeString();
        $debate->code = time() . uniqid(Str::random(30));

        if ($debate->save()) {
            $response = [];
            $staff = Staff::select("id", "name")->with('imageOne')->find($debate->staff_id);
            $response['user_id'] = $staff;
            $response['message'] = $debate->message;
            $response['debate_id'] = $debate->application_id;
            $response['timestamp'] = $this->datesLangTrait($date, Auth::guard('staff')->user()->lang) . ", " . $hours;
            $response['timeDiff'] = $date->diffForHumans();
            $response['msgStrac'] = $slug = Str::of($debate->message)->limit(50);

            $sender_id = Auth::guard("staff")->user()->id;
            DebateMessagesJob::dispatch(json_decode($request->debateMembers), $debate->id, $sender_id);
            return response()->json([
                'success' => true,
                'response' => $response,
            ]);
        }
    }
    ///
    public function getNewProcedure(Request $request)
    {

        $search = $request->search;

        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $app = $this->getApplications($request->app);

        $servcio = $app->treatment->service;
        $servcio_id = $app->treatment->id;

        if ($search == '') {
            $procedures = Procedure::whereHas(
                "treatment",
                function ($q) use ($servcio) {
                    $q->where('service_id', $servcio->id);
                },
            )
            ->select('id', "procedure_$lang AS procedure", "has_package", 'code')
            ->limit(5)
            ->get();
        } else {
            $procedures = Procedure::whereHas(
                "treatment",
                function ($q) use ($servcio) {
                    $q->where('service_id', $servcio->id);
                },
            )
            ->where("procedure_$lang", 'like', '%' . $search . '%')
            ->select('id', "procedure_$lang AS procedure", "has_package", 'code')
            ->limit(5)
            ->get();
        }
        return ($procedures);
    }
    public function setNewProcedure(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $app = $this->getApplications($request->app);


        $coor = Staff::whereHas(
            'assignment',
            function ($q) use ($request) {
                $q->where('applications.id', $request->app);
            }
        )
        ->whereHas(
            'assignToSpecialty',
            function ($q) {
                $q->where('specialties.id', 10);
            }
        )
        ->get();

        $dataEmail = new Collection();
        if ($app) {
            $exist = Treatment::where("procedure_id", $request->id)
            ->where('package_id', $app->treatment->package->id)
            ->first();
            if ($exist) {
                if ($request->id == $app->recommended_id) {
                    $app->treatment_id = $exist->id;
                    $app->recommended_id = null;

                    if ($app->save()) {
                        $app->statusOne->delete($app->statusOne->id);
                        $app->statusOne()->create(
                            [
                                'status_id' => 5,
                                'indications' => $request->medicalIndications,
                                'recomendations' => $request->medicalRecommendations,
                                'code' => time() . uniqid(Str::random(30)),
                            ]
                        );
                        $status = $this->getStatus($request->app);

                        $ap = $status;

                        $this->setAppPriceAuto($ap, $exist);

                        $newProcedure = Application::with(
                            [
                                'treatment' => function ($q) {
                                    $q->with(
                                        [
                                            "procedure",
                                        ]
                                    );
                                },
                            ]
                        )
                        ->findOrFail($request->app);

                        $dataEmail->push((object)[
                            'patient' => $app->patient->name,
                            'email' => $app->patient->email,
                            'lang' => $app->patient->lang,
                            'brand' => $app->treatment->brand,
                            'service' => ($app->patient->lang == 'es') ? $app->treatment->service->service_es : $app->treatment->service->service_en,
                            'procedure' => ($app->patient->lang == 'es') ? $newProcedure->treatment->procedure->procedure_es : $newProcedure->treatment->procedure->procedure_en,
                            'package' => ($app->patient->lang == 'es') ? $app->treatment->package->package_es : $app->treatment->package->package_en,
                            'includes' => $app->treatment->contains,
                            "price" => $app->treatment->price,
                            "downPayment" => ((float) $app->treatment->price * .10),
                            'indications' => $request->medicalIndications,
                            'recomendations' => $request->medicalRecommendations,
                            'coordinator' => $coor[0],
                        ]);

                        Mail::send(new AcceptedLetterEmail($dataEmail[0]));

                        $status = $this->getStatus($request->app);

                        return response()->json([
                            'success' => true,
                            'name' => $request->name,
                            'id' => $request->id,
                            'has_package' => $app->treatment->procedure->has_package,
                            "icon" => "success",
                            "msg" => "La aplicación fue editada con exito",
                            "status" => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                            'indications' => $status->statusOne->status->medicalIndications,
                            'recomendations' => $status->statusOne->status->medicalRecommendations,
                            'reazon' => $status->statusOne->status->reazon,
                        ]);
                    }
                } else {
                    $status = $this->getStatus($request->app);
                    

                    return response()->json([
                        'success' => false,
                        'name' => $request->name,
                        'id' => $request->id,
                        'has_package' => $app->treatment->procedure->has_package,
                        "icon" => "error",
                        "msg" => "Debe seleccionar el procedimiento que recomienda el doctor",
                        'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                        'indications' => $status->statusOne->status->medicalIndications,
                        'recomendations' => $status->statusOne->status->medicalRecommendations,
                        'reazon' => $status->statusOne->status->reazon,
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'name' => $request->name,
                'id' => $request->id,
                'has_package' => $app->treatment->procedure->has_package,
                "icon" => "error",
                "msg" => "Debé crear primero el nuevo procedimiento antes de cambiarlo"
            ]);
        }

        return response()->json([
            'success' => true,
            'reload' => true,
        ]);
    }
    public function getNewPackage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $search = $request->search;

        $app = $this->getApplications($request->app);
        

        $has_package = $app->treatment->procedure->has_package;


        $tr = $this->getTreatments($app->treatment->procedure_id);




        $packs = new Collection;
        for ($i=0; $i < count($tr); $i++) { 
            $packs[] = [
                'id' => $tr[$i]->package->id,
                'package' => $tr[$i]->package->package,
            ];
        }


        if ($has_package == 1) {
            return($packs);
        }
    }
    public function setNewPackage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $app = $this->getApplications($request->app);


        $existe = false;

        if (! is_null($app->recommended_id)) {
            if ($app->treatment->procedure->has_package == 1) {
                $existe = Treatment::where("procedure_id", $app->recommended_id)
                ->where('package_id', $request->id)
                ->first();
            }
        }

        if ($app) {
            if ($app->treatment->procedure->has_package == 1) {
                $exist = Treatment::where("procedure_id", $app->treatment->procedure->id)
                ->where('package_id', $request->id)
                ->first();

                if ($exist) {
                    $app->treatment_id = $exist->id;

                    $this->setAppPriceAuto($app, $exist);

                    if ($app->save()) {
                        return response()->json([
                            'success' => true,
                            'name' => $request->name,
                            'id' => $request->id,
                            'has_package' => $app->treatment->procedure->has_package,
                            "icon" => "success",
                            "msg" => "La applicaión fue editada con exito",
                            'exist' => $existe,
                            'oldPackage' => $app->treatment->package,
                        ]);
                    }
                }
                return response()->json([
                    'success' => false,
                    'name' => $request->name,
                    'id' => $request->id,
                    'has_package' => $app->treatment->procedure->has_package,
                    "icon" => "error",
                    "msg" => "Debe crear primero el nuevo paquete antes de cambiarlo",
                    'oldPackage' => $app->treatment->package,
                ]);
            }
            return response()->json([
                'success' => false,
                'name' => $request->name,
                'id' => $request->id,
                'has_package' => $app->treatment->procedure->has_package,
                "icon" => "error",
                "msg" => "Este procediminto no lleva paquetes"
            ]);
        }
        return response()->json([
            'success' => true,
            'reload' => true,
            'exist' => $existe,
            'oldPackage' => $app->treatment->package
        ]);
    }
    public function setStatusAcepted(Request $request)
    {
        //return $request;
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            if ($request->has('sugerencias')) {
                $sugerencias = json_decode($request->sugerencias,true);
            }
            $request->merge(['sugerenciasArray' => $sugerencias]);


            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            ($request->medicalRecommendations == '<p><br></p>') ? $request->merge(['medicalRecommendations' => '']) : $request->medicalRecommendations;
            ($request->medicalIndications == '<p><br></p>') ? $request->merge(['medicalIndications' => '']) : $request->medicalIndications;


            $validator = Validator::make($request->all(), [
                'id' => 'string|required|exists:procedures,id',
                'app' => 'required|exists:applications,id',
                'medicalRecommendations' => 'required|string',
                'medicalIndications' => 'required|string',
                "sugerenciasArray" => [
                    ($request->action == 15) ? "required":null,
                    ($request->action == 15) ? "array":null,
                    ($request->action == 15) ? "min:1":null,
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $app = $this->getApplications($request->app);

            $coor = getCoordinator($request->app);

            $exist = false;
            if ($app->treatment->procedure->has_package == 1) {
                $exist = Treatment::where("procedure_id", $request->id)
                ->where('package_id', $app->treatment->package->id)
                ->first();
            } else {
                $exist = Treatment::where("procedure_id", $request->id)
                ->first();
            }

            $dataEmail = new Collection();


            if ($app) {
                if ($app->treatment->procedure->service_id == 2){
                    return $this->withSuggestions($app, $request, $coor, $exist);
                } else {
                    return $this->aceptedApp($app, $request, $coor, $exist);
                }
            }

            // if ($app) {
            //     switch ($request->action) {
            //         case '16':
            //         if($app->treatment->procedure->service_id == 2){

            //             return $this->withSuggestions($app, $request, $coor, $exist);
            //         }
            //         break;
            //         case '13':
            //         return $this->changeProcedureApp($app, $request, $coor, $exist);
            //         break;
            //         default:
            //         return $this->aceptedApp($app, $request, $coor, $exist);
            //         break;
            //     }
            // } 
        }
    }
    public Function aceptedApp($app, $request, $coor, $exist)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $statusx = 5;
        $dataEmail = new Collection();
        if (count($app->assignments) < 3) {
            $statusx = '14';

            if ($statusx == '14') {
                $dataE = new Collection();
                $dataE->push((object)[
                    'coor' => $coor[0]->name,
                    'email' => $coor[0]->email,
                    'lang' => $coor[0]->lang,
                    'doctor' => auth()->guard('staff')->user()->name,
                    'app' => env('APP_URL').'/staff/applications/view/'.$app->id,
                ]); 
                Mail::send(new AcceptedUnassignedEmail($dataE[0]));
            } 
        }
        $app->statusOne->delete($app->statusOne->id);
        $app->statusOne()->create(
            [
                'status_id' => $statusx,
                'indications' => $request->medicalIndications,
                'recomendations' => $request->medicalRecommendations,
                'code' => getCode(),
            ]
        );

        $status = $this->getStatus($request->app);
        $status->recommended_id = null;

        $pack = '';
        if (is_null( $app->treatment->package)) {
            $pack == '-----';
        } else {
            $pack = ($app->patient->lang == 'es') ? $app->treatment->package->package_es : $app->treatment->package->package_en;
        }


        $status->save();
        $dataEmail->push((object)[
            'patient' => $app->patient->name,
            'email' => $app->patient->email,
            'lang' => $app->patient->lang,
            'brand' => $app->treatment->brand,
            'service' => ($app->patient->lang == 'es') ? $app->treatment->service->service_es : $app->treatment->service->service_en,
            'procedure' => ($app->patient->lang == 'es') ? $app->treatment->procedure->procedure_es : $app->treatment->procedure->procedure_en,
            'package' => $pack,
            'includes' => $app->treatment->contains,
            "price" => $app->treatment->price,
            "downPayment" => ((float) $app->treatment->price * .10),
            'indications' => $request->medicalIndications,
            'recomendations' => $request->medicalRecommendations,
            'coordinator' => $coor[0],
            'sugerencias' => []
        ]);


        Mail::send(new AcceptedLetterEmail($dataEmail[0]));

        return response()->json([
            'success' => true,
            'este' => '-',
            'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
            'indications' => $request->medicalIndications,
            'recomendations' => $request->medicalRecommendations,
            'reazon' => $status->statusOne->status->reazon,
            'exist' => $exist,
        ]);
    }
    public function changeProcedureApp($app, $request, $coor, $exist)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        if ($app->treatment->procedure->id != $request->id) {
            $app->recommended_id = $request->id;
            $oldTreat = Procedure::find($request->id);
            $oldPacka = Package::find($app->treatment->package->id);
            $app->statusOne->delete($app->statusOne->id);
            $appStatus = $app->statusOne()->create(
                [
                    'status_id' => 13,
                    'indications' => $request->medicalIndications,
                    'recomendations' => $request->medicalRecommendations,
                    'code' => getCode(),
                ]
            );

            $status = $this->getStatus($request->app);

            if ($app->save()) {
                $status = $this->getStatus($request->app);

                $data = new Collection();
                $data->push((object)[ // data for email
                    'patient' => $app->patient->name,
                    'phone' => $app->patient->phone,
                    'mobile' => $app->patient->mobile,
                    'email' => $app->patient->email,
                    'coor' => $coor[0]->name,
                    'email' => $coor[0]->email,
                    'lang' => $coor[0]->lang,
                    'reccomended' => ($coor[0]->lang == 'es'? $app->treatment->procedure->procedure_es:$app->treatment->procedure->procedure_en ),
                    'old' =>  ($coor[0]->lang == 'es'? $oldTreat->procedure_es:$oldTreat->procedure_en ),
                    'oldPacka' =>  ($coor[0]->lang == 'es'? $oldPacka->package_es:$oldPacka->package_en ),
                    'doctor' => auth()->guard('staff')->user()->name,
                    'medicalRecommendations' => $request->medicalRecommendations,
                    'medicalIndications' => $request->medicalIndications,
                ]);

                $tr = $this->getTreatments($request->id); 
                $packs = new Collection;

                for ($i=0; $i < count($tr); $i++) { 
                    $packs[] = [
                        'id' => $tr[$i]->package->id,
                        'package' => $tr[$i]->package->package,
                    ];
                };
                Mail::send(new AcceptedWithChangeOfProcedureEmail($data[0]));


                return response()->json([
                    'success' => true,
                    'data' => $app,
                    'name' => $request->name,
                    'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                    'exist' => $exist,
                    'oldProce' => ($coor[0]->lang == 'es'? $oldTreat->procedure_es:$oldTreat->procedure_en ),
                    'oldPacka' =>  ($coor[0]->lang == 'es'? $oldPacka->package_es:$oldPacka->package_en ),
                    'packs' => $packs,
                    'indications' => $request->medicalIndications,
                    'recomendations' => $request->medicalRecommendations,
                    'reazon' => $status->statusOne->status->reazon,
                ]);
            }
        }
    }
    public function withSuggestions($app, $request, $coor, $exist)
    {

        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $admins = Staff::role('administrator')->get();
        $patient = 'hola';
        $toEmail = new Collection;
        
        $countSugerencias = count($request->sugerenciasArray);
        $sugerencias = $request->sugerenciasArray;
        
        

        $suger = new Collection;
        if (count($sugerencias) > 0 ) {
            $sugerencias = sugerencias($request->sugerenciasArray);

            for ($i=0; $i < $countSugerencias; $i++) { 
                if (1 == 1) {
                    $suger[] = [
                        'name' => $sugerencias[$i]->nombre,
                    ];
                    $app->suggestions()->create([
                        'application_id' => $request->app,
                        'staff_id' => Auth::guard('staff')->user()->id,
                        'sugerencia' => $sugerencias[$i]->nombre,
                        'code' => getCode(),
                    ]);
                }
            }
        }

        if (count($sugerencias) <= 0) {
            $suger[] = [
                'name' => 'Sin Sugerencias',
            ];
            $app->suggestions()->create([
                'application_id' => $request->app,
                'staff_id' => Auth::guard('staff')->user()->id,
                'sugerencia' => 'Sin Sugerencias',
                'code' => getCode(),
            ]);
        }

        foreach ($admins as $key => $value) {
            $toEmail->push((object)[
                'staff_name' => $value->name,
                'staff_email' => $value->email,
                'app_id' => $app->id,
                'sugerencias' => $suger,
                "patient" => $app->patient->name,
                'doctor' => auth()->guard('staff')->user()->name,
                'app' => env('APP_URL').'/staff/applications/view/'.$app->id,
                'procedimeiento' => $app->treatment->procedure->procedure,
                'lang' => $value->lang,
            ]);
        }

        $toEmail->push((object)[
            'staff_name' => $coor[0]->name,
            'staff_email' => $coor[0]->email,
            'doctor' => auth()->guard('staff')->user()->name,
            'app_id' => $app->id,
            'sugerencias' => $suger,
            'patient' => $app->patient->name,
            'doctor' => auth()->guard('staff')->user()->name,
            'app' => env('APP_URL').'/staff/applications/view/'.$app->id,
            'procedimeiento' => $app->treatment->procedure->procedure,
            'lang' => $coor[0]->lang,
        ]);

        $app->statusOne->delete($app->statusOne->id);
        $appStatus = $app->statusOne()->create(
            [
                'status_id' => 16,
                'indications' => $request->medicalIndications,
                'recomendations' => $request->medicalRecommendations,
                'code' => getCode(),
            ]
        );

        $status = $this->getStatus($request->app);

        foreach ($toEmail as $key => $data) {
            Mail::to($data->staff_email)
            ->send(
                new AcceptedWithsuggestionsMail($toEmail[$key])
            );
        }

        return response()->json([
            'success' => true,
            'datax' => $app,
            'name' => $request->name,
            'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
            'exist' => $exist,
            'indications' => $request->medicalIndications,
            'recomendations' => $request->medicalRecommendations,
            'reazon' => $status->statusOne->status->reazon,
            'sugerencia' => $suger,
            'doctor' => auth()->guard('staff')->user()->name,
            'packs' => null,
            'indications' => $request->medicalIndications,
            'recomendations' => $request->medicalRecommendations,
            'reazon' => $status->statusOne->status->reazon,
        ]);
    }
    public function setStatusDeclined(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $validator = Validator::make($request->all(), [
            'app' => 'required|exists:applications,id',
            'declinedReazon' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $app = Application::with('patient')->find($request->app);

        $app->statusOne->delete($app->statusOne->id);
        $app->statusOne()->create(
            [
                'status_id' => 3,
                'reason' => $request->declinedReazon,
                'code' => time() . uniqid(Str::random(30)),
            ]
        );

        $coor = Staff::whereHas(
            'assignment', function ($q) use ($app) {
                $q->where('applications.id', $app->id);
            })
        ->whereHas(
            'assignToSpecialty',
            function ($q) {
                $q->where('specialties.id', 10);
            }
        )
        ->get();

        $pack = '';
        if (is_null( $app->treatment->package)) {
            $pack == '-----';
        } else {
            $pack = ($app->patient->lang == 'es') ? $app->treatment->package->package_es : $app->treatment->package->package_en;
        }

        $dataEmail = new Collection();
        $dataEmail->push((object)[
            'patient' => $app->patient->name,
            'verga' => '$si',
            'email' => $app->patient->email,
            'lang' => $app->patient->lang,
            'brand' => $app->treatment->brand,
            'service' => ($app->patient->lang == 'es') ? $app->treatment->service->service_es : $app->treatment->service->service_en,
            'procedure' => ($app->patient->lang == 'es') ? $app->treatment->procedure->procedure_es : $app->treatment->procedure->procedure_en,
            'package' => $pack,
            'includes' => $app->treatment->contains,
            "price" => $app->treatment->price,
            "downPayment" => ((float) $app->treatment->price * .10),
            'indications' => $request->medicalIndications,
            'recomendations' => $request->medicalRecommendations,
            'coordinator' => $coor[0],
            'declinedReazon' => $request->declinedReazon,
        ]);

        Mail::send(new DeclidedLetterEmail($dataEmail[0]));



        $app = $this->getApplications($request->app);

        $app->recommended_id = null;
        $app->save();

        return response()->json([
            'success' => true,
            'status' => getStatus($app->statusOne->status->name, $app->statusOne->status->color),
            'indications' => $app->statusOne->status->medicalIndications,
            'recomendations' => $app->statusOne->status->medicalRecommendations,
            'reazon' => $app->statusOne->status->reazon,
        ]);
    }
    public function changeNewProcedure(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $app = $this->getApplications($request->app_id);


        $tr = $this->getTreatments($app->recommended_id);   

        $exist = false;

        if ($app->treatment->procedure->has_package == 1) {
            $exist = Treatment::where("procedure_id", $app->recommended_id)
            ->where('package_id', $app->treatment->package->id)
            ->first();
        } else {
            $exist = Treatment::where("procedure_id", $app->recommended_id)
            ->first();
        }

        if ($exist) {
            $app->treatment_id = $exist->id;
            $app->recommended_id = null;
            $app->price = $exist->price;
            if ($app->save()) {
                $getStatusData = $app->statusOne;
                $app->statusOne->delete($app->statusOne->id);

                $app->statusOne()->create(
                    [
                        'status_id' => 5,
                        'indications' => $getStatusData->medicalIndications,
                        'recomendations' => $getStatusData->medicalRecommendations,
                        'code' => time() . uniqid(Str::random(30)),
                    ]
                );
            }
            $status = $this->getApplications($request->app_id);

            return response()->json([
                'success' => true,
                'name' => $tr[0]->procedure->procedure,
                'id' => $tr[0]->procedure->id,
                'has_package' => ($app->treatment->procedure->has_package == 1)? $app->treatment->procedure->has_package:0,
                "icon" => "success",
                "msg" => "La aplicación fue editada con exito",
                "status" => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                'indications' => $app->statusOne->status->medicalIndications,
                'reazon' => $app->statusOne->status->reazon,
                'recomendations' => $app->statusOne->status->medicalRecommendations,
            ]);
        }  

        $packs = new Collection;

        for ($i=0; $i < count($tr); $i++) { 
            $packs[] = [
                'id' => $tr[$i]->package->id,
                'package' => $tr[$i]->package->package,
            ];
        }

        return response()->json([
            'success' => false,
            'complete' => false, 
            'name' => $app->treatment->procedure->procedure,
            'id' => $app->treatment->procedure->id,
            'has_package' => ($app->treatment->procedure->has_package == 1)? $app->treatment->procedure->has_package:0,
            'packs' => $packs,
            'treatment' => $tr,
            'indications' => $app->statusOne->status->medicalIndications,
            'reazon' => $app->statusOne->status->reazon,
            'recomendations' => $app->statusOne->status->medicalRecommendations,
        ]);
    }
    public function changeNewProcedureWithPackage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $app = $this->getApplications($request->app);

        $coor = Staff::whereHas(
            'assignment',
            function ($q) use ($request) {
                $q->where('applications.id', $request->app);
            }
        )
        ->whereHas(
            'assignToSpecialty',
            function ($q) {
                $q->where('specialties.id', 10);
            }
        )
        ->get();

        $tr = Treatment::where('code', $request->tr_cod)
        ->where('id', $request->tr_id)
        ->with([
            'package' => function($q) use ($lang) {
                $q->select('id', "package_$lang AS package");
            },
            'procedure' => function($q) use ($lang) {
                $q->select('id', "procedure_$lang AS procedure");
            },
            'service' => function($q) use($lang) {
                $q->with('specialties');
            },
        ])
        ->first(); 

        $needStaff = count($tr->service->specialties);

        $app->treatment_id = $tr->id;
        $app->recommended_id = null;

        
        if ($app->save()) {
            $getStatusData = $app->statusOne;
            $app->statusOne->delete($app->statusOne->id);
            $status = $this->getApplications($request->app_id);
            
            $statusx = 5;
            if (count($app->assignments) < $needStaff) {
                $statusx = '14';
                if ($statusx == '14') {
                    $dataE = new Collection();
                    $dataE->push((object)[
                        'coor' => $coor[0]->name,
                        'email' => $coor[0]->email,
                        'lang' => $coor[0]->lang,
                        'doctor' => auth()->guard('staff')->user()->name,
                        'app' => env('APP_URL').'/staff/applications/view/'.$app->id,
                    ]); 
                    Mail::send(new AcceptedUnassignedEmail($dataE[0]));
                } 
            }

            $app->statusOne->delete($app->statusOne->id);

            $app->statusOne()->create(
                [
                    'status_id' => $statusx,
                    'indications' => $app->statusOne->medicalIndications,
                    'recomendations' => $app->statusOne->medicalRecommendations,
                    'code' => time() . uniqid(Str::random(30)),
                ]
            );
            $status = $this->getStatus($request->app);

            $ap = $status;

            $this->setAppPriceAuto($ap, $tr);

            return response()->json([
                'success' => true,
                'procedure' => $tr->procedure->procedure,
                'procedure_id' => $tr->procedure->id,
                'package' => $tr->package->package,
                'package_id' => $tr->package->id,
                'has_package' => ($app->treatment->procedure->has_package == 1)? $app->treatment->procedure->has_package:0,
                "icon" => "success",
                "msg" => "La aplicación fue editada con exito",
                "status" => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                'indications' => $app->statusOne->medicalIndications,
                'recomendations' => $app->statusOne->medicalRecommendations,
                'reazon' => $app->statusOne->reazon,
            ]);   
        }
    }
    public function treatmentExist($data)
    {
        // code...
    }
    public function getApplications($id)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        return Application::with(
            [
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->selectRaw("*, name_$lang as name");
                        }
                    ])
                    ->select("*")->orderBy('created_at', 'desc')->first();
                },
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "brand" => function ($q) {
                                $q->select("brand", "id", "color", "acronym");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("*", "service_$lang AS service", "id");
                                $q->with(
                                    [
                                        'specialties' => function ($q) use ($lang) {
                                            $q->select("*", "specialties.id", "name_$lang AS specialty");
                                        }
                                    ]
                                );
                            },
                            "procedure" => function ($q) use ($lang) {
                                $q->select("*", "procedure_$lang AS procedure", "id", "has_package");
                            },
                            "package" => function ($q) use ($lang) {
                                $q->select("*", "package_$lang AS package", "id");
                            },
                            'contains',
                        ]
                    );
                },
                'patient',
                'assignments',
            ]
        )
        ->find($id);
    }
    public function getTreatments($id)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        return Treatment::where('procedure_id', $id)
        ->with([
            'package' => function($q) use ($lang) {
                $q->select('id', "package_$lang AS package");
            },
            'procedure' => function($q) use ($lang) {
                $q->select('id', "procedure_$lang AS procedure");
            },
        ])
        ->get();
    }
    public function getAppPrice(Request $request)
    {
        $app = Application::where([
            'id' => $request->id,
            'temp_code' => $request->tempcode,
            'code' => $request->code,
        ])->first();

        return $app;
    }
    public function setAppPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $app = Application::where([
            'id' => $request->id,
            'temp_code' => $request->tempcode,
            'code' => $request->code,
        ])->first();

        if ($app) {
            $app->price = $request->price;
            if ($app->save()) {
                return response()->json([
                    'success' => true,
                    'icon' => 'success',
                    'msg' => 'Precio establecido',
                ]);
            }
        }
    }
    public function setAppPriceAuto($ap, $tr)
    {
        if ($ap->price < $tr->price) {
            $ap->price = $tr->price;
            $ap->save();
        }
    }
    public function getStatus($app_id)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        return Application::select('id')
        ->with(
            [
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*")->orderBy('created_at', 'desc')->first();
                },
            ]
        )
        ->find($app_id);
    }
    public function setAceptesSuggestion(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $app = $this->getApplications($request->app);


        $status = $this->getStatus($request->app);
        $tr = Treatment::where('id', $app->treatment->id)
        ->with([
            'package' => function($q) use ($lang) {
                $q->select('id', "package_$lang AS package");
            },
            'procedure' => function($q) use ($lang) {
                $q->select('id', "procedure_$lang AS procedure");
            },
            'service' => function($q) use($lang) {
                $q->with('specialties');
            },
        ])
        ->first(); 

        $needStaff = count($tr->service->specialties);
        
        $statusx = 5;
        if (count($app->assignments) < $needStaff) {
            $statusx = '14'; 
        } 

        //return response()->json($status->statusOne->indications);
        $app->statusOne->delete($app->statusOne->id);
        $app->statusOne()->create(
            [
                'status_id' => $statusx,
                'indications' => $status->statusOne->indications,
                'recomendations' => $status->statusOne->recomendations,
                'code' => getCode(),
            ]
        );
        $status = $this->getStatus($request->app);
        return response()->json([
            'success' => true,
            'este' => '-',
            'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
            'indications' => $status->statusOne->indications,
            'recomendations' => $status->statusOne->recomendations,
            'reazon' => $status->statusOne->reazon,
            'icon' => 'succes',
            'msn' => 'editado con exito'
        ]);

    }
}
