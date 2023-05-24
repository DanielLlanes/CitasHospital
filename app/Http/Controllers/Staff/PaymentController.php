<?php

namespace App\Http\Controllers\Staff;

use PDF;
use App\Models\Staff\Role;
use App\Models\Staff\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Staff\Patient;
use App\Models\Staff\Payment;
use App\Models\Site\Application;
use Yajra\DataTables\DataTables;
use App\Models\Staff\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportantInformationPdf;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        date_default_timezone_set('America/Tijuana');

        $this->middleware('can:payments.list')->only(['getList', 'index']);
        $this->middleware('can:payments.create')->only(['store']);  
    }
    
    public function index()
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $paymentMethod = PaymentMethod::selectRaw("id, code, name_$lang AS name")
        ->where('active', 1)
        ->get();  

       ;

        $payments = Payment::with
        (
            [
                'staff',
                'paymentMethods' => function($q)use($lang)
                {
                    $q->selectRaw("id, name_$lang As name");
                },
                'patient' =>function($q)
                {
                    $q->selectRaw("id, name");
                },
                'application' => function($q)use($lang)
                {
                    $q->selectRaw("id, temp_code, treatment_id")
                    ->with
                    (
                        'treatment', function($q)
                        {
                            $q->selectRaw("id, price");
                        }
                    );
                }

            ]
        )
        ->get();      

        //return($payments);
        return view('staff.payment-manager.list', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            

            $payments = Payment::with
            (
                [   'staff',
                    'imageOne',
                    'paymentMethods' => function($q)use($lang)
                    {
                        $q->selectRaw("id, name_$lang As name");
                    },
                    'patient' =>function($q)
                    {
                        $q->selectRaw("id, name");
                    },
                    'application' => function($q)use($lang)
                    {
                        $q->selectRaw("id, temp_code, treatment_id")
                        ->with
                        (
                            'treatment', function($q)
                            {
                                $q->selectRaw("id, price");
                            }
                        );
                    }

                ]
            )
            ->get();   
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('image', function($payments){
                    if (is_null($payments->imageOne)) {
                        $images = "/staffFiles/assets/img/treatment/no-Image.png";
                    } else {
                        $images = $payments->imageOne->image;
                    }
                    $image ='
                            <a href="'.asset($images).'" data-effect="mfp-zoom-in" class="a">
                                <img src="'.asset($images).'" class="img-thumbnail" style="width:50px; height:50px" alt="treatment"/>
                            </a>
                        ';
                    return $image;
                })
                ->addColumn('patient', function($payments){
                    return '<span class"text-uppercase">'.$payments->patient->name.'</span>';;
                })
                ->addColumn('application', function($payments){
                    return $payments->application->temp_code;
                })
                ->addColumn('application_total', function($payments){
                    return $payments->application->treatment->price;
                })
                ->addColumn('payment_amount', function($payments){
                    return "$ ".$payments->amount;
                })
                ->addColumn('currency', function($payments){
                    return $payments->currency;
                })
                ->addColumn('staff', function($payments){
                    return $payments->staff->name;
                })
                ->addColumn('payment_method', function($payments){
                    return $payments->paymentMethods->name;
                })
                ->addColumn('date', function($payments){
                    return $payments->created_at->toFormattedDateString();;
                })
                ->addColumn('action', function($payments){
                    return 'actions here';
                })
                //->addColumn('action', 'staff.brand-manager.actions-list')
                ->rawColumns(['DT_RowIndex',  'image', 'patient', 'application', 'application_total', 'payment_amount', 'currency', 'payment_method', 'staff', 'date', 'action'])
                ->make(true);
        }
    }

    public function patientsApps(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $patientApp = Application::whereHas(
            'statusOne', function($q){
                $q->where('status_id', '!=', 3)
                  ->where('status_id', '!=', 9);
            }
        )
        ->with(
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
                        'specialties', function($q){
                            $q->where("name_en", "Coordination");
                        }
                    );
                }
            ]
        )
        ->where('patient_id', $request->id)
        ->get();

        return Response::json([
            'data' => $patientApp
        ]);
    }
    public function searchPatientAppDetails(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $apps = Application::where("id", $request->id)
        ->with(
            [
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
        ->find($request->id);
        return $apps;
    }
    public function searchPatientWithApps(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $search = Patient::where("name",'like', "%".$request->search."%")
        ->whereHas('applications', function($q){
            $q->where('is_complete', 1)
            ->whereHas(
                'statusOne', function($q){
                    $q->where('status_id', '!=', 3)
                    ->where('status_id', '!=', 9)
                    ->where('status_id', '!=', 1);
                }
            );
        })
        ->select('id', "name", 'email', 'phone')
        ->get();

     return $search;   
    }
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'id' => 'required|integer|exists:applications,id',
            'code' => 'required|string|exists:applications,temp_code',
            'evidence' => 'mimes:jpeg,jpg,png,gif|required',
            'currency' => 'required|in:Dollar,Peso',
            'patId' => 'required|integer|exists:patients,id',
            'paymentMethod' => 'required|string|exists:payment_methods,code'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $itsSame = Application::with('treatment')->find($request->id);
        $patient = Patient::find($request->patId);
        $coor = getCoordinator($request->id);

        $brand = Brand::find($itsSame->treatment->brand_id);
  
        if($request->code != $itsSame->temp_code || $request->patId != $itsSame->patient_id )
        {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('An unknown problem occurred refresh the page and try again'),
                    'reload' => false,
                    'isSame' => $itsSame
                ]
            );
        }
        $evidence = '';
        if ($request->hasFile('evidence')) {
            $evidence = $request->file('evidence');
            $destinationPath = storage_path('app/public').'/payment/evidence';
            $img_name = time().uniqid(Str::random(30)).'.'.$evidence->getClientOriginalExtension();
            $img = Image::make($evidence->getRealPath());
            $width = 1200;
            $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '80');
            $evidence = "storage/payment/evidence/$img_name";
        }
        $paymentMethod = PaymentMethod::where('code', $request->paymentMethod)->first();
        $payment = New Payment;

        $data = [
            'coordinator' => $coor[0],
            'app_id' => $itsSame->id,
            "patient" => $patient,
            "brand" => $brand,
        ];

        $pdf = PDF::loadView('staff.pdfs.staff.es.importantInfo', ["data" => $data]);
        $destinationPath = storage_path('app/public').'/pdfs';
        File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);
        $filePath = "{$destinationPath}/{$request->patId}-important-information.pdf";
        $pdf->save($filePath);

        $toEmail = new Collection;

        $toEmail->push((object)[
            'staff' => $coor[0],
            'app_id' => $itsSame->id,
            "patient" => $patient,
            "brand" => $brand,
            "subject" => 'Important Information',
            "filePath" => $filePath,
        ]);
        Mail::send(new ImportantInformationPdf($toEmail));
        $payment->amount = $request->amount;
        $payment->currency = $request->currency;
        $payment->application_id = $request->id;
        $payment->patient_id = $request->patId;
        $payment->payment_method_id = $paymentMethod->id;
        $payment->code = time().uniqid(Str::random(30));
        $payment->staff_id = Auth::guard('staff')->user()->id;
        unlink($filePath);
        if ($payment->save()) {
            if ($evidence != '') {
                $payment->imageOne()->create(
                    ['image' => $evidence, 'code' => getCode()]
                );
            }
            
            
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The payment was paid correctly!'),
                    'reload' => true
                ]
            );
        }      
    }
    public function generatePDF()
    {
        $data = [
            'title' => 'Ejemplo de PDF con Laravel-Dompdf',
            'content' => 'Contenido del PDF',
        ];

        $pdf = PDF::loadView('staff.pdfs.staff.es.importantInfo', $data);
        $pdf->setPaper('A4', "portrait");
        $pdf->setOptions(['isHtml5ParserEnabled' => true]);
        $destinationPath = storage_path('app/public').'/pdfs';
        File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);
        return $pdf->stream('ejemplo.pdf');
    }
    public function getAppsPayment(Request $request)
    {
        $pagos = $this->getAppsPaymentsCount($request->id, $request->patient);
        return $pagos;
    }
    private function getAppsPaymentsCount($id, $patient) {
        $pagos = Payment::where('patient_id', $patient)->where('application_id', $id)->get();
        $app = Application::find($id);
        $price = (float)$app->price;
        $suma = $pagos->pluck('amount')->sum();
        $numeroDePagos = count($pagos);
        $resta = $price - $suma;
        $estaPagado = ($suma < $price) ? 'No Pagado' : 'Pagado';
        $esElPrimerPago = $numeroDePagos == 0 ? true : false;
        return response()->json([
            'pagos' => $pagos,
            'price' => $price,
            'suma' => $suma,
            'numeroDePagos' => $numeroDePagos,
            'estaPagado' => $estaPagado,
            'esElPrimerPago' => $esElPrimerPago,
            'resta' => $resta,
        ]);
    }
}
