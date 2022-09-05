<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Traits\DatesLangTrait;
use App\Traits\StatusAppsTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class DashController extends Controller
{
    use StatusAppsTrait,
        DatesLangTrait;
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:partners');
        // $this->middleware('can:services.list')->only(['getServiceList', 'service']);
        // $this->middleware('can:services.edit')->only(['edit','update']);
        // $this->middleware('can:services.create')->only(['create','store']);
        // $this->middleware('can:services.destroy')->only(['destroy']);
        // $this->middleware('can:services.activate')->only(['activate']);
    }
   public function index()
   {
        $userID = auth()->guard('partners')->user()->id;
        $lang = 'es';

       return view('partners.dashboard');
   }
   public function getList(Request $request)
    {
        $userID =  auth()->guard('partners')->user()->id;
        $lang = 'es';
        if ($request->ajax()) {
            $apps = Application::whereHas(
                'partners', function($q) use($userID){
                    $q->where('partners.id', $userID);
                }
            )
            ->with([
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
            ])
            ->get();

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
                    return '<span>' . $this->datesLangTrait($apps->created_at, 'es') . '</span>';
                })
                ->addColumn('precio', function ($apps) {

                    $price = ($apps->treatment->price != null ? '$ ' . $apps->treatment->price : "-----");
                    return '<span>' . $price . '</span>';
                })
                ->addColumn('status', function ($apps) {
                    return getStatus($apps->statusOne->status->name, $apps->statusOne->status->color);
                    return $apps->statusOne;
                })
                ->addColumn('complete', function($apps) {
                    return ($apps->is_complete == '1' ? "terminada":"no terminada");
                })
                ->rawColumns(['DT_RowIndex', 'codigo', 'paciente', 'marca', 'servicio', 'procedimiento', 'paquete', "coordinador", 'fecha', 'status', 'complete'])
                ->make(true);

        }
    }
}
