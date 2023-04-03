<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuotesRequest;
use App\Http\Requests\UpdateQuotesRequest;
use App\Models\Admin\Quotes;
use App\Models\Site\Application;
use App\Models\Staff\Quote;
use App\Models\Staff\Staff;
use App\Models\Staff\Suggestion;
use App\Traits\DatesLangTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class QuoteController extends Controller
{
    use DatesLangTrait;
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
        $quotes = Quote::with(
                [
                    'suggestions' => function ($q) use ($lang) {

                    },
                    'application' => function($q) use($lang) {
                        $q->with(
                            [
                                'assignments' => function ($q) use ($lang) {
                                    $q->whereHas(
                                        'specialties',
                                        function ($q) {
                                            $q->where("name_en", "Coordination");
                                        }
                                    );
                                },
                                'patient',
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
                            ]
                        );
                    },
                    'statusOne' => function ($q) use ($lang) {
                        $q->with([
                            'status' => function ($q) use ($lang) {
                                $q->select("name_$lang as name", 'id', 'color');
                            }
                        ])
                        ->select("*");
                    },
                ]
            )->get();
        //return $quotes;
        return view('staff.quotes-manager.quotes');
    }
    public function obtenerApps(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $apps = Application::whereHas('suggestions', function($query) {
                    $query->whereNotNull('sugerencia')
                    ->whereNull('quote_id');
                })
                ->with(
                    [
                        'suggestions' => function($q) {
                            $q->with('staff');
                        },
                        'statusOne' => function ($q) use ($lang) {
                            $q->with([
                                'status' => function ($q) use ($lang) {
                                    $q->select("name_$lang as name", 'id', 'color');
                                }
                            ])
                            ->select("*")->orderBy('created_at', 'desc')->first();
                        },
                        'assignments' => function ($q) use ($lang) {
                            $q->whereHas(
                                'specialties',
                                function ($q) {
                                    $q->where("name_en", "Coordination");
                                }
                            );
                        },
                        'patient',
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
                    ]
                )
            ->get();

            return DataTables::of($apps)
            ->addIndexColumn()
            ->addColumn('app', function ($apps) {
                return '<span>' . $apps->temp_code . '</span>';
            })
            ->addColumn('tratamiento', function ($apps) {
                return '<span style="color: ' . $apps->treatment->brand->color . '">' . $apps->treatment->procedure->procedure . '</span>';
            })
            ->addColumn('paciente', function ($apps) {
                return '<span>' . $apps->patient->name . '</span>';
            })
            ->addColumn('coordinador', function ($apps) {
                if (count($apps->assignments) < 1) {
                    return '<span>Not Assigned</span>';
                } else {
                    return '<span style="color: ' . $apps->assignments[0]->color . '">' . $apps->assignments[0]->name . '</span>';
                }
            })
            ->addColumn('doctorUno', function ($apps) {
                return '<span>' . $apps->suggestions[0]->staff->name. '</span>';
            })
            ->addColumn('doctorDos', function ($apps) {
                return '<span>' . $apps->treatment->procedure->procedure . '</span>';
            })
            ->addColumn('acciones', function($apps) {
                return view('staff.quotes-manager.actions-suggestions', compact('apps'));
            })
            ->rawColumns(['DT_RowIndex', "app", "paciente", "tratamiento", "coordinador", "doctorUno", "doctorDos", "acciones"])
            ->make(true);

        }    
    }
    public function obtenerSugerencias(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $apps = Application::whereHas('suggestions', function($query) {
                    $query->whereNotNull('sugerencia');
                })
                ->with(
                    [
                        'suggestions' => function($q) {
                            $q->with('staff');
                        },
                        'patient',
                    ]
                )
            ->find($request->id);

            return $apps;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datos' => 'required|array',
            'datos.*.name' => 'string|required',
            'datos.*.price' => 'required|numeric',
            'datos.*.drFee' => 'required|numeric',
            'datos.*.isFree' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $app = Application::with('suggestions', 'treatment')->find($request->app);

        $staff_id = $app->suggestions[0]->staff_id;
        // return response()->json($price );
        $countSugerencias = count($request->datos);

        $quote = new Quote;
        $price = 0;
        for ($i=0; $i < $countSugerencias; $i++) { 
            if ($request->datos[$i]['drFee'] == 1) {
                $price += (float)$request->datos[$i]['price'];
            }
        }
        $quote->price = $price;
        $quote->code = getCode();
        $quote->applications_id  = $request->app;
        $quote->cotizacion = time();
        $app->treatment->price = $price;
        $app->price = $price;
        $app->save();
        $quote->save();
        $app->suggestions()->ForceDelete();
        for ($i=0; $i < $countSugerencias; $i++) { 
            if (1 == 1) {
                $app->suggestions()->create([
                    'application_id' => $request->app,
                    'staff_id' => $staff_id ,
                    'sugerencia' => $request->datos[$i]['name'],
                    'unitario' => $request->datos[$i]['price'],
                    'dr_fee' => $request->datos[$i]['drFee'],
                    'is_free' => $request->datos[$i]['isFree'],
                    'quote_id' => $quote->id,
                    'code' => getCode(),
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        if ($request->ajax()) {
            $quotes = Quote::with(
                [
                    'suggestions' => function ($q) use ($lang) {

                    },
                    'application' => function($q) use($lang) {
                        $q->with(
                            [
                                'assignments' => function ($q) use ($lang) {
                                    $q->whereHas(
                                        'specialties',
                                        function ($q) {
                                            $q->where("name_en", "Coordination");
                                        }
                                    );
                                },
                                'patient',
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
                            ]
                        );
                    },
                    'statusOne' => function ($q) use ($lang) {
                        $q->with([
                            'status' => function ($q) use ($lang) {
                                $q->select("name_$lang as name", 'id', 'color');
                            }
                        ])
                        ->select("*");
                    },
                ]
            )->get();
            return DataTables::of($quotes)
            ->addIndexColumn()
            ->addColumn('cotizacion', function ($quotes) {
                return '<span>' . $quotes->cotizacion . '</span>';
            })
            ->addColumn('tratamiento', function ($quotes) {
               return '<span style="color: ' . $quotes->application->treatment->brand->color . '">' . $quotes->application->treatment->procedure->procedure . '</span>';
            })
            ->addColumn('paciente', function ($quotes) {
                return '<span>' . $quotes->application->patient->name . '</span>';
            })
            ->addColumn('coordinador', function ($quotes) {
                if (count($quotes->application->assignments) < 1) {
                    return '<span>Not Assigned</span>';
                } else {
                    return '<span style="color: ' . $quotes->application->assignments[0]->color . '">' . $quotes->application->assignments[0]->name . '</span>';
                }
            })
            ->addColumn('doctorUno', function ($quotes) {
                return '<span>' . $quotes->suggestions[0]->staff->name. '</span>';
            })
            ->addColumn('doctorDos', function ($quotes) {
                return '<span>' . getStatus($quotes->statusOne->status->name, $quotes->statusOne->status->color) . '</span>';
            })
            ->addColumn('price', function ($quotes) {
                return '<span>' . $quotes->price. '</span>';
            })
            ->addColumn('date', function($quotes) {
               return '<span>' . $this->datesLangTrait($quotes->created_at, Auth::guard('staff')->user()->lang) . '</span>';
            })
            ->addColumn('acciones', function($quotes) {
                return view('staff.quotes-manager.actions-quotes', compact('quotes'));
            })
            ->rawColumns(['DT_RowIndex', "cotizacion", "paciente", "tratamiento", "coordinador", "doctorUno", "doctorDos", 'price', 'date', "acciones"])
            ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        if ($request->ajax()) {
            $quote = Quote::with(
                [
                    'suggestions' => function ($q) use ($lang) {

                    },
                    'application' => function($q) use($lang) {
                        $q->with(
                            [
                                'assignments' => function ($q) use ($lang) {
                                    $q->whereHas(
                                        'specialties',
                                        function ($q) {
                                            $q->where("name_en", "Coordination");
                                        }
                                    );
                                },
                                'patient',
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
                            ]
                        );
                    },
                    'statusOne' => function ($q) use ($lang) {
                        $q->with([
                            'status' => function ($q) use ($lang) {
                                $q->select("name_$lang as name", 'id', 'color');
                            }
                        ])
                        ->select("*");
                    },
                ]
            )->find($request->id);
            
            return $quote;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuotesRequest  $request
     * @param  \App\Models\Admin\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return($request);
        $validator = Validator::make($request->all(), [
            'datos' => 'required|array',
            'datos.*.name' => 'string|required',
            'datos.*.price' => 'required|numeric',
            'datos.*.drFee' => 'required|numeric',
            'datos.*.isFree' => 'required|boolean',
            'datos.*.isDeleted' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $lang = Auth::guard('staff')->user()->lang;

        $cot = Quote::with
            (
                [
                    'suggestions' => function ($q) use ($lang) {

                    },
                    'application' => function($q) use($lang) {
                        $q->with(
                            [
                                'assignments' => function ($q) use ($lang) {
                                    $q->whereHas(
                                        'specialties',
                                        function ($q) {
                                            $q->where("name_en", "Coordination");
                                        }
                                    );
                                },
                                'patient',
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
                            ]
                        );
                    },
                    'statusOne' => function ($q) use ($lang) {
                        $q->with([
                            'status' => function ($q) use ($lang) {
                                $q->select("name_$lang as name", 'id', 'color');
                            }
                        ])
                        ->select("*");
                    },
                ]
        )->find($request->app);
        $countSugerencias = count($request->datos);
        $price = 0;
        foreach ($request->datos as $key => $dato) {
            if ($dato['isFree'] == 0) {
                if ($dato['isDeleted'] == 0) {
                    $price += (float)$dato['price'];
                }
            }
        };

        $app = Application::with
        (
            [
                'suggestions',
                'assignments' => function ($q) use ($lang) {
                    $q->whereHas(
                        'specialties',
                        function ($q) {
                            $q->where("name_en", "Coordination");
                        }
                    );
                },
                'patient',
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
            ]
        )
        ->find($cot->application->id);
        $cot->price = $price;
        $app->price = $price;
        $app->save();
        $cot->save();

        $staff_id = $cot->suggestions[0]->staff_id;

        $cot->suggestions()->ForceDelete();
        foreach ($request->datos as $key => $dato) {
            if ($dato['isDeleted'] == 0) {
                $app->suggestions()->create([
                    'application_id' => $app->id,
                    'staff_id' => $staff_id ,
                    'sugerencia' => strtoupper($dato['name']),
                    'unitario' => $dato['price'],
                    'dr_fee' => $dato['drFee'],
                    'is_free' => $dato['isFree'],
                    'quote_id' => $cot->id,
                    'code' => getCode(),
                ]);
            }
        }

        return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $app = Application::with('suggestions')->find($request->app);
        foreach ($app->suggestions as $key => $value) {
            if ($value->sugerencia == $request->id) {
                $sug = Suggestion::find($value->id);
                $sug->delete();
                return response()->json('ok');
            }
        }
    }

    public function destroyEdit(Request $request)
    {
        return $request;
        $app = Application::with('suggestions')->find($request->app);
        foreach ($app->suggestions as $key => $value) {
            if ($value->sugerencia == $request->id) {
                $sug = Suggestion::find($value->id);
                $sug->delete();
                return response()->json('ok');
            }
        }

        //enviar Correo
    }
}
