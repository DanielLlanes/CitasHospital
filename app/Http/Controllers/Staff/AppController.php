<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Staff\Patient;
use App\Models\Site\Application;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
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
                            'specialty', function($q){
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
                ->addColumn('patient', function($applications){
                    return '<span style="font-weight: 500;">'.$applications->patient->name.'</span>';
                })
                ->addColumn('brand', function($applications){
                    return '<span style="font-weight: 500; color: '.$applications->treatment->brand->color.'">'.$applications->treatment->brand->brand.'</span>';
                })
                ->addColumn('service', function($applications){
                    return '<span style="font-weight: 500;">'.$applications->treatment->service->service.'</span>';
                })
                ->addColumn('procedure', function($applications){
                    return '<span style="font-weight: 500;">'.$applications->treatment->procedure->procedure.'</span>';
                })
                ->addColumn('package', function($applications){
                    if (!is_null($applications->treatment->package)) {
                        return '<span style="font-weight: 500;">'.$applications->treatment->package->package.'</span>';
                    } else {
                        return '<span style="font-weight: 500;"> ---- </span>';
                    }

                })
                ->addColumn('coordinator', function($applications){
                    if (count($applications->assignments) < 1) {
                        return '<span style="font-weight: 500;">Not Assigned</span>';
                    } else {
                        return '<span style="font-weight: 500; color: '.$applications->assignments[0]->color.'">'.$applications->assignments[0]->name.'</span>';
                    }

                })
                ->addColumn('date', function($applications){
                    return '<span style="font-weight: 500;">'.$applications->created_at->toDayDateTimeString().'</span>';
                })
                ->addColumn('price', function($applications){
                    return '<span style="font-weight: 500;">$ '.$applications->treatment->price.'</span>';
                })
                ->addColumn('status', function($applications){
                    return '<span style="font-weight: 500;" class="label label-sm label-warning">'.ucwords($applications->status).'</span>';
                })
                ->addColumn('action', 'staff.application-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'patient', 'brand', 'service', 'procedure', 'package', "coordinator", 'date', 'price',  'status', 'action'])
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
                            'specialty' => function($q)use($lang){
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
        //return $applications;
        return view
            (
                'staff.application-manager.app-details',
                [
                    'appInfo' => $applications,
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
                    return '<span style="font-weight: 500; color: '.$patientApp->treatment->brand->color.'">'.$patientApp->treatment->brand->brand.'</span>';
                })
                ->addColumn('service', function($patientApp){
                    return '<span style="font-weight: 500;">'.$patientApp->treatment->service->service.'</span>';
                })
                ->addColumn('procedure', function($patientApp){
                    return '<span style="font-weight: 500;">'.$patientApp->treatment->procedure->procedure.'</span>';
                })
                ->addColumn('package', function($patientApp){
                    if (!is_null($patientApp->treatment->package)) {
                        return '<span style="font-weight: 500;">'.$patientApp->treatment->package->package.'</span>';
                    } else {
                        return '<span style="font-weight: 500;"> ---- </span>';
                    }
                })
                ->addColumn('coordinator', function($patientApp){
                    if (count($patientApp->assignments) < 1) {
                        return '<span style="font-weight: 500;">Not Assigned</span>';
                    } else {
                        return '<span style="font-weight: 500; color: '.$patientApp->assignments[0]->color.'">'.$patientApp->assignments[0]->name.'</span>';
                    }

                })
                ->addColumn('date', function($patientApp){
                    return '<span style="font-weight: 500;">'.$patientApp->created_at->toDayDateTimeString().'</span>';
                })
                ->addColumn('status', function($patientApp){
                    return '<span style="font-weight: 500;">'.ucwords($patientApp->status).'</span>';
                })
                ->rawColumns(['DT_RowIndex', 'brand', 'service', 'procedure', 'package', "coordinator", 'date', 'status'])
                ->make(true);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
