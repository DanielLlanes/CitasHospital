<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Models\Staff\Payment;
use App\Models\Staff\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;


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
        app()->setLocale($lang);
        $paymentMethod = PaymentMethod::selectRaw("id, code, description_$lang AS description")
        ->where('active', 1)
        ->get();  

        $payments = Payment::with
        (
            [
                'paymentMethods' => function($q)use($lang)
                {
                    $q->selectRaw("id, description_$lang As description");
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

    public function getList(Request $request){
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            

            $payments = Payment::with
            (
                [
                    'imageOne',
                    'paymentMethods' => function($q)use($lang)
                    {
                        $q->selectRaw("id, description_$lang As description");
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
                // ->addColumn('number_of_payments', function($payments){
                //     return 'number_of_payments';
                // })
                ->addColumn('payment_method', function($payments){
                    return $payments->paymentMethods->description;
                })
                ->addColumn('date', function($payments){
                    return $payments->created_at->toFormattedDateString();;
                })
                ->addColumn('action', function($payments){
                    return 'actions here';
                })
                //->addColumn('action', 'staff.brand-manager.actions-list')
                ->rawColumns(['DT_RowIndex',  'image', 'patient', 'application', 'application_total', 'payment_amount', 'currency', 'payment_method', 'date', 'action'])
                ->make(true);
        }
    }

    public function patientsApps(Request $request){
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
    public function searchPatientWithApps(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'id' => 'required|integer|exists:applications,id',
            'code' => 'required|string|exists:applications,temp_code',
            'evidence' => 'mimes:jpeg,jpg,png,gif|required',
            'currency' => 'required|in:Dollar, Peso',
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



        $itsSame = Application::find($request->id);

        if($request->code != $itsSame->temp_code || $request->patId != $itsSame->patient_id )
        {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('An unknown problem occurred refresh the page and try again'),
                    'reload' => false
                ]
            );
        }
        $evidence = '';
        if ($request->hasFile('evidence')) {
            $evidence = $request->file('evidence');
            $destinationPath = storage_path('app/public').'/staff/evidence';
            $img_name = time().uniqid(Str::random(30)).'.'.$evidence->getClientOriginalExtension();
            $img = Image::make($evidence->getRealPath());
            $width = 1200;
            $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '80');
            $evidence = "storage/staff/evidence/$img_name";
        }
        $paymentMethod = PaymentMethod::where('code', $request->paymentMethod)->first();
        $payment = New Payment;

        $payment->amount = $request->amount;
        $payment->currency = $request->currency;
        $payment->application_id = $request->id;
        $payment->patient_id = $request->patId;
        $payment->payment_method_id = $paymentMethod->id;
        $payment->code = time().uniqid(Str::random(30));

        if ($payment->save()) {
            if ($evidence != '') {
                $payment->imageOne()->create(
                    ['image' => $evidence, 'code' => time().uniqid(Str::random(30))]
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
}
