<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Models\Staff\Patient;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use App\Traits\DatesLangTrait;
use App\Traits\StatusAppsTrait;
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

            $applications = Application::with(
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
            
            return DataTables::of($applications)
                ->addIndexColumn()
                ->addColumn('code', function($applications){
                    return '<span>'.$applications->temp_code.'</span>';
                })
                ->addColumn('patient', function($applications){
                    return '<span>'.$applications->patient->name.'</span>';
                })
                ->addColumn('brand', function($applications){
                    return '<span style="color: '.$applications->treatment->brand->color.'">'.$applications->treatment->brand->brand.'</span>';
                })
                ->addColumn('service', function($applications){
                    return '<span>'.$applications->treatment->service->service.'</span>';
                })
                ->addColumn('procedure', function($applications){
                    return '<span>'.$applications->treatment->procedure->procedure.'</span>';
                })
                ->addColumn('package', function($applications){
                    if (!is_null($applications->treatment->package)) {
                        return '<span>'.$applications->treatment->package->package.'</span>';
                    } else {
                        return '<span> ---- </span>';
                    }

                })
                ->addColumn('coordinator', function($applications){
                    if (count($applications->assignments) < 1) {
                        return '<span>Not Assigned</span>';
                    } else {
                        return '<span style="color: '.$applications->assignments[0]->color.'">'.$applications->assignments[0]->name.'</span>';
                    }

                })
                ->addColumn('date', function($applications){
                    return '<span>'. $this->datesLangTrait($applications->created_at, Auth::guard('staff')->user()->lang). '</span>';
                })
                ->addColumn('price', function($applications){
                    return '<span>$ '.$applications->treatment->price.'</span>';
                })
                ->addColumn('status', function($applications){
                    return $this->statusAppTrait($applications->status);
                })
                ->addColumn('action', 'staff.application-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'code', 'patient', 'brand', 'service', 'procedure', 'package', "coordinator", 'date', 'price',  'status', 'action'])
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

            ]
        )
        ->findOrFail($id);
        $treatment = $applications->treatment;
        $cordinators = Staff::whereHas
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
        ->get();
        return view
        (
            'staff.application-manager.app-details',
            [
                'appInfo' => $applications,
                "cordinators" => $cordinators
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
}
