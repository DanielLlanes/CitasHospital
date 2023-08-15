<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Models\Staff\Assignment;
use App\Models\Staff\Event;
use App\Models\Staff\Patient;
use App\Models\Staff\Payment;
use App\Models\Staff\Staff;
use App\Traits\DatesLangTrait;
use App\Traits\StatusAppsTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    use StatusAppsTrait,
        DatesLangTrait;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff');

        
        date_default_timezone_set('America/Tijuana');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return 'puta';
        $lang = 'en';
        $apps = Application::with(
            [
                'statusOne' => function($q)use($lang){
                    $q->with([
                        'status' => function($q)use($lang){
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*");
                },
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
        ->orderBy('id', 'desc')

        ->get();

      // return $apps;

        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $apps = Application::with(
            [
                'statusOne' => function($q)use($lang){
                    $q->with([
                        'status' => function($q)use($lang){
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ])
                    ->select("*");
                },
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
        ->orderBy('id', 'desc')
        ->take(5)
        ->get();

        $countNewersPatients = Patient::where('created_at', '>', now()->startOfMonth()->endOfDay())->count();
    
        $countAllPatients = Patient::count();
        if ($countNewersPatients > 0 && $countAllPatients > 0) {
            $incrementPatients = ceil((($countNewersPatients / $countAllPatients)) * 100);
        } else {
            $incrementPatients = 0;
        }


        $countNewersEvents = Event::where('created_at', '>', now()->startOfMonth()->endOfDay())->count();
        $countAllEvents = Event::count();
        if ($countNewersEvents > 0 && $countAllEvents > 0) {
            $incrementEvents = ceil((($countNewersEvents / $countAllEvents)) * 100);
        } else {
            $incrementEvents = 0;
        }


        $countNewersApps = Application::where('is_complete', 1)->where('created_at', '>', now()->startOfMonth()->endOfDay())->count();
        $countAllApps = Application::where('is_complete', 1)->count();
        if ($countNewersApps > 0 && $countAllApps > 0) {
            $incrementApps = ceil((($countNewersApps / $countAllApps)) * 100);
        } else {
            $incrementApps = 0;
        }


        $countNewersPayments = Payment::where('created_at', '>', now()->startOfMonth()->endOfDay())->sum('amount');
        $countAllPayments = Payment::sum('amount');
        if ($countNewersPayments > 0 && $countAllPayments > 0) {
            $incrementPayments = ceil((($countNewersPayments / $countAllPayments)) * 100);
        } else {
            $incrementPayments = 0;
        }


        return view('staff.dashboard',
            [
                'countNewersPatients'   => $countNewersPatients,
                'incrementPatients'     => $incrementPatients,

                'countNewersEvents'     => $countNewersEvents,
                'incrementEvents'       => $incrementEvents,

                'countNewersApps'       => $countNewersApps,
                'incrementApps'         => $incrementApps,

                'countNewersPayments'   => $countNewersPayments,
                'incrementPayments'     => $incrementPayments,
            ]
        );
    }

    public function dashboard()
    {
        $lang = app()->getLocale();
         return redirect()->route('staff.dashboard');
    }

    public function getCounters()
    {
        $countNewersPatients = Patient::where('created_at', '>', now()->startOfMonth()->endOfDay())->count();
        $countAllPatients = Patient::count();
        $incrementPatients = ceil((($countNewersPatients / $countAllPatients)) * 100);

        $countNewersEvents = Event::where('created_at', '>', now()->startOfMonth()->endOfDay())->count();
        $countAllEvents = Event::count();
        $incrementEvents = ceil((($countNewersEvents / $countAllEvents)) * 100);

        $countNewersApps = Application::where('is_complete', 1)->where('created_at', '>', now()->startOfMonth()->endOfDay())->count();
        $countAllApps = Application::where('is_complete', 1)->count();
        $incrementApps = ceil((($countNewersApps / $countAllApps)) * 100);

        $countNewersPayments = Payment::where('created_at', '>', now()->startOfMonth()->endOfDay())->sum('amount');
        $countAllPayments = Payment::sum('amount');
        $incrementPayments = ceil((($countNewersPayments / $countAllPayments)) * 100);

        return response()->json([
            'countNewersPatients'   => $countNewersPatients,
            'incrementPatients'     => $incrementPatients,

            'countNewersEvents'     => $countNewersEvents,
            'incrementEvents'       => $incrementEvents,

            'countNewersApps'       => $countNewersApps,
            'incrementApps'         => $incrementApps,

            'countNewersPayments'   => $countNewersPayments,
            'incrementPayments'     => $incrementPayments,

        ]);
    }
    public function getSocialMedia()
    {
        $labels = ['Google', 'Facebook', 'YouTube', 'Twiter', 'Forums', 'Instagram', 'Friend', 'Radio', 'Email', 'Other'];
        $backgroundColor = ['#0F9D58','#4267B2','#FF0000','#1DA1F2','#6e2c00','#833AB4','#641e16','#512e5f','#154360','#48c9b0'];
        $data = [];
                $data[0] = Application::where('about_us_google', true)->count();
                $data[1] = Application::where('about_us_facebook', true)->count();
                $data[2] = Application::where('about_us_youtube', true)->count();
                $data[3] = Application::where('about_us_twiter', true)->count();
                $data[4] = Application::where('about_us_forums', true)->count();
                $data[5] = Application::where('about_us_instagram', true)->count();
                $data[6] = Application::where('about_us_friend', true)->count();
                $data[7] = Application::where('about_us_radio', true)->count();
                $data[8] = Application::where('about_us_email', true)->count();
                $data[9] = Application::where('about_us_other', true)->count();
        $results = [
            "labels" => $labels,
             "datasets" => [
                [
                    "label" => 'Social Media',
                     "data" => $data,
                     "backgroundColor" => $backgroundColor,
                ],
            ],
        ];

    return response()->json($results);
    }
    public function lastFiveApps(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();
            // if (Auth::guard("staff")->user()->can('applications.all')) {
                $apps = Application::with(
                    [
                        'statusOne' => function($q)use($lang){
                            $q->with([
                                'status' => function($q)use($lang){
                                    $q->select("name_$lang as name", 'id', 'color');
                                }
                            ])
                            ->select("*");
                        },
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
                //->where('is_complete', true)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
            // }

            return DataTables::of($apps)
                ->addIndexColumn()
                ->addColumn('codigo', function($apps){
                    return '<span>'.$apps->temp_code.'</span>';
                })
                ->addColumn('paciente', function($apps){
                    return '<span>'.$apps->patient->name.'</span>';
                })
                ->addColumn('marca', function($apps){
                    if (!is_null($apps->treatment->brand)) {
                        return '<span style="color: '.$apps->treatment->brand->color.'">'.$apps->treatment->brand->brand.'</span>';
                    }
                    return "Not Available";
                })
                ->addColumn('servicio', function($apps){
                    //return $apps->treatment;
                    if (!is_null($apps->treatment->service)) {
                        return '<span>'.$apps->treatment->service->service.'</span>';
                    }
                    return "Not Available";
                })
                ->addColumn('procedimiento', function($apps){
                    if (!is_null($apps->treatment->procedure)) {
                        return '<span>'.$apps->treatment->procedure->procedure.'</span>';
                    }
                    return "Not Available";
                })
                ->addColumn('paquete', function($apps){
                    //return $apps->treatment;
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

                ->addColumn('status', function($apps){
                    $viewUrl = route('staff.applications.show', ["id" => $apps->id]);
                    return '<a href="'.$viewUrl.'">' . getStatus($apps->statusOne->status->name, $apps->statusOne->status->color) . '</a>';
                    return $apps->statusOne;
                })
                ->rawColumns(['codigo', 'paciente', 'marca', 'servicio', 'procedimiento', 'paquete', "coordinador", 'fecha',  'status'])
                ->make(true);
        }
    }
}
