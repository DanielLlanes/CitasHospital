<?php

namespace App\Http\Controllers\Staff;

use App\Events\DebateChatEvent;
use App\Http\Controllers\Controller;
use App\Jobs\Staff\Debate\DebateMessagesJob;
use App\Mail\AcceptedLetterEmail;
use App\Mail\AcceptedUnassignedEmail;
use App\Mail\AcceptedWithChangeOfProcedureEmail;
use App\Mail\DeclidedLetterEmail;
use App\Models\Site\Application;
use App\Models\Staff\Debate;
use App\Models\Staff\Package;
use App\Models\Staff\Patient;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
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
        // $this->middleware('can:CreateAdmins')->only(['create','store']);
        // $this->middleware('can:EditAdmins')->only(['edit','update']);
        // $this->middleware('can:DeleteAdmins')->only(['destroy']);
        // $this->middleware('can:ActivateAdmins')->only(['activarAdministradores']);
        $this->middleware('can:applications.show')->only(['show']);
        //$this->middleware('can:applications.show')->only(['show']);
        date_default_timezone_set('America/Tijuana');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = 'es';
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
                            $q->whereHas(
                                'specialties',
                                function ($q) {
                                    $q->where("name_en", "Coordination");
                                }
                            );
                        }
                    ]
                )
                    ->where('is_complete', true)
                    ->get();
            //return $apps;
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
                            $q->whereHas(
                                'specialties',
                                function ($q) {
                                    $q->where("name_en", "Coordination");
                                }
                            );
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
                                                $q->whereHas(
                                                    'specialties',
                                                    function ($q) {
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
                ->addColumn('precio', function ($apps) {

                    $price = ($apps->treatment->price != null ? '$ ' . $apps->treatment->price : "-----");
                    return '<span>' . $price . '</span>';
                })
                ->addColumn('status', function ($apps) {
                    return getStatus($apps->statusOne->status->name, $apps->statusOne->status->color);
                    return $apps->statusOne;
                })
                ->addColumn('partner', function ($apps) {
                    if (count($apps->partners)) {
                        return  '<span style="background-color: #ff6961;padding: 5px;border-radius: 0.3rem;">' . $apps->partners[0]->name . '</span>';
                    }
                    return '----';
                })
                ->addColumn('acciones', 'staff.application-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'codigo', 'paciente', 'marca', 'servicio', 'procedimiento', 'paquete', "coordinador", 'fecha', 'precio', 'partner', 'status', 'acciones'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

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
                                $q->select("brand", "id", "color");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id");
                                $q->with(
                                    [
                                        'specialties' => function ($q) use ($lang) {
                                            $q->select("specialties.id", "name_$lang AS specialty", "specialties.id");
                                        }
                                    ]
                                );
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
                'recommended' => function ($q) use ($lang) {
                    $q->select("procedure_$lang AS procedure", "id");
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

        // return $applications;

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

        return view(
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

        //return $patientApp;
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

        //$selectedStaffSpecialty = (Auth::guard('staff')->user()->lang == 'es' ? $order->name_en:$order->name_es);


        $setNewStaff[] = [
            'staff_id' => $newStaff->id,
            'ass_as' => $order->id,
            'code' => time() . uniqid(Str::random(30))
        ];

        Application::find($request->app)->assignments()->attach($setNewStaff);
        $saveStaff = $newStaff;
        $saveStaff->last_assignment = date("Y-m-d H:i:s");

        $response = [];

        // $app->statusOne()->create(
        //     [
        //         'status_id' => 5,
        //         'indications' => null,
        //         'recomendations' => null,
        //         'code' => getCode(),
        //     ]
        // );

        if ($saveStaff->save()) {
            $date = Carbon::now();
            $hours = $date->format('g:i A');
            //$response = [];
            $response['staff_id'] = $newStaff->id;
            $response['message'] = "A new application has been assigned to you";
            $response['application_id'] = $request->app;
            $response['timestamp'] = $this->datesLangTrait($date, 'en') . ", " . $hours;
            $response['timeDiff'] = $date->diffForHumans();
            $response['msgStrac'] = \Str::of("A new application has been assigned to you")->limit(20);
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
            ])
            ->find($request->app);
            $changeStatus = false;
            $setStatus = 1;
            if ($app->statusOne->status_id == 14) {
                if ( count($app->assignments) >= 3 ) {
                    $setStatus = 5;
                    $changeStatus = true;
                }
            } 
            if ($app->statusOne->status_id == 5) {
                if ( count($app->assignments) >= 3 ) {
                    $setStatus = 1;
                    $changeStatus = true;
                }
            }

            if ($changeStatus) {
                $app->statusOne()->create(
                    [
                        'status_id' => $setStatus,
                        'indications' => null,
                        'recomendations' => null,
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
        ]);
    }

    public function getNewStaff(Request $request)
    {
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
        //$debate->read = $request->read;
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
            $response['msgStrac'] = $slug = \Str::of($debate->message)->limit(50);

            $sender_id = Auth::guard("staff")->user()->id;
            DebateMessagesJob::dispatch(json_decode($request->debateMembers), $debate->id, $sender_id);
            return response()->json([
                'success' => true,
                'response' => $response,
            ]);
        }
    }

    public function getNewProcedure(Request $request)
    {
        $search = $request->search;

        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $app = $applications = Application::with(
            [
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang", "id");
                            },
                        ]
                    );
                },
            ]
        )
            ->find($request->app);

        $servcio = $app->treatment->service;
        $servcio_id = $app->treatment->id;

        if ($search == '') {
            $procedures = Procedure::whereHas(
                    "service",
                    function ($q) use ($servcio) {
                        $q->where('id', $servcio->id);
                    },
                )
                ->select('id', "procedure_$lang AS procedure", "has_package")
                ->limit(5)
                ->get();
        } else {
            $procedures = Procedure::whereHas(
                    "service",
                    function ($q) use ($servcio) {
                        $q->where('id', $servcio->id);
                    },
                )
                ->where("procedure_$lang", 'like', '%' . $search . '%')->limit(5)
                ->select('id', "procedure_$lang AS procedure", "has_package")
                ->limit(5)
                ->get();
        }

        return ($procedures);
    }
    public function setNewProcedure(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $app = Application::with(
            [

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
        ->findOrFail($request->app);

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
                        $status = Application::select('id')
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
                            ->find($request->app);

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
                            $status = Application::select('id')
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
                            ->find($request->app);

                            return response()->json([
                                'success' => true,
                                'name' => $request->name,
                                'id' => $request->id,
                                'has_package' => $app->treatment->procedure->has_package,
                                "icon" => "success",
                                "msg" => "La aplicación fue editada con exito",
                                "status" => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                            ]);
                    }
                } else {
                    $status = Application::select('id')
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
                            ->find($request->app);
                    return response()->json([
                        'success' => false,
                        'name' => $request->name,
                        'id' => $request->id,
                        'has_package' => $app->treatment->procedure->has_package,
                        "icon" => "error",
                        "msg" => "Debe seleccionar el procedimiento que recomienda el doctor",
                        'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
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
        $app = $applications = Application::with(
            [
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "procedure",
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang", "id");
                            },
                        ]
                    );
                },
            ]
        )
            ->find($request->app);

        $has_package = $app->treatment->procedure->has_package;

        if ($has_package == 1) {
            $packages = Package::where("active", 1)->select("id", "package_$lang AS package")->get();
            return $packages;
        }
    }

    public function setNewPackage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $app = Application::with(
            [
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "procedure",
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang", "id");
                            },
                            "package",
                        ]
                    );
                },
            ]
        )
        ->find($request->app);

        if ($app) {
            if ($app->treatment->procedure->has_package == 1) {
                $exist = Treatment::where("procedure_id", $app->treatment->procedure->id)
                    ->where('package_id', $request->id)
                    ->first();

                if ($exist) {
                    $app->treatment_id = $exist->id;
                    if ($app->save()) {
                        return response()->json([
                            'success' => true,
                            'name' => $request->name,
                            'id' => $request->id,
                            'has_package' => $app->treatment->procedure->has_package,
                            "icon" => "success",
                            "msg" => "La applicaión fue editada con exito"
                        ]);
                    }
                }
                return response()->json([
                    'success' => false,
                    'name' => $request->name,
                    'id' => $request->id,
                    'has_package' => $app->treatment->procedure->has_package,
                    "icon" => "error",
                    "msg" => "Debe crear primero el nuevo paquete antes de cambiarlo"
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
        ]);
    }

    public function setStatusAcepted(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $validator = Validator::make($request->all(), [
            'id' => 'string|required|exists:services,id',
            'app' => 'required|exists:applications,id',
            'medicalRecommendations' => 'required|string',
            'medicalIndications' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $app = Application::with(
            [
                'statusOne' => function ($q) use ($lang) {
                    $q->with([
                        'status' => function ($q) use ($lang) {
                            $q->select("name_$lang as name", 'id', 'color');
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
        ->find($request->app);

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
            $app->statusOne->delete($app->statusOne->id);
            if ($app->treatment->procedure->id != $request->id) {
                $app->recommended_id = $request->id;

                $oldTreat = Procedure::find($request->id);

                $app->statusOne()->create(
                    [
                        'status_id' => 13,
                        'indications' => $request->medicalIndications,
                        'recomendations' => $request->medicalRecommendations,
                        'code' => getCode(),
                    ]
                );

                if ($app->save()) {
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
                    $data = new Collection();
                    $data->push((object)[
                        'patient' => $app->patient->name,
                        'phone' => $app->patient->phone,
                        'mobile' => $app->patient->mobile,
                        'email' => $app->patient->email,
                        'coor' => $coor[0]->name,
                        'email' => $coor[0]->email,
                        'lang' => $coor[0]->lang,
                        'reccomended' => ($coor[0]->lang == 'es'? $app->treatment->procedure->procedure_en:$app->treatment->procedure->procedure_es ),
                        'old' =>  ($coor[0]->lang == 'es'? $oldTreat->procedure_es:$oldTreat->procedure_es ),
                        'doctor' => auth()->guard('staff')->user()->name,
                        'medicalRecommendations' => $request->medicalRecommendations,
                        'medicalIndications' => $request->medicalIndications,
                    ]);
                    Mail::send(new AcceptedWithChangeOfProcedureEmail($data[0]));
                    return response()->json([
                        'success' => true,
                        'data' => $app,
                        'name' => $request->name,
                        'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
                    ]);
                }
            }

            $statusx = '13';
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

            $app->statusOne()->create(
                [
                    'status_id' => $statusx,
                    'indications' => $request->medicalIndications,
                    'recomendations' => $request->medicalRecommendations,
                    'code' => time() . uniqid(Str::random(30)),
                ]
            );

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
            ]);

            
            Mail::send(new AcceptedLetterEmail($dataEmail[0]));

            return response()->json([
                'success' => true,
                'status' => getStatus($status->statusOne->status->name, $status->statusOne->status->color),
            ]);
        }
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

        $app = Application::with('patient')
            ->find($request->app);
        //return $app;
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



        $app = Application::select('id')
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
            ->find($request->app);
        $app->recommended_id = null;
        $app->save();

        return response()->json([
            'success' => true,
            'status' => getStatus($app->statusOne->status->name, $app->statusOne->status->color),
        ]);
    }
}
