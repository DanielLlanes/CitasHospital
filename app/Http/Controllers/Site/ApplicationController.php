<?php

namespace App\Http\Controllers\Site;

use App\Models\Site\State;
use Illuminate\Support\Str;
use App\Models\Site\Country;
use Illuminate\Http\Request;
use App\Models\Staff\Patient;
use App\Models\Staff\Product;
use Image;
use App\Models\Site\Application;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $lang = app()->getLocale();
        $exists = Product::where('active', true)
        ->findOrFail($id);

        $countries = Country::where('active', 1)->orderBy('name', 'desc')->select("id", "name")->get();

        $product = Product::with
        (
            [
                'service' => function($query) use ($lang) {
                    $query->select('id', "active", "service_$lang as service", "need_images", "qty_images");
                 },
                'procedure' => function($query) use ($lang) {
                    $query->select('id', "active", "has_package", "service_id", "procedure_$lang as procedure");
                 },
                'package' => function($query) use ($lang) {
                    $query->select('id', "active", "package_$lang as package");
                 }
            ]
        )
        ->where('active', true)
        ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price")
        ->findOrFail($id);
        //Session::flush();

        if ($exists) {

            Session::put('product', $product);

            if(Session::has('form_session'))
            {
                $sessionData = Session::get('form_session');
                $patient = Patient::find($sessionData->patient_id);
                if ($sessionData->product_id == $id) {
                    return view
                    (
                        'site.apps.patient-data',
                        [
                            'sessionData' => $sessionData,
                            'patient' => $patient,
                            'product' => $product,
                            'countries' => $countries
                        ]
                    );
                } else {
                    return 'diferente';
                }
            }
            return view
            (
                'site.apps.patient-data',
                [
                    'product' => $product,
                    'countries' => $countries
                ]
            );
        }
    }

    public function createPatientData(Request $request)
    {
        //$request->session()->forget('form-data');
        $this->validate($request, [
            'email' => 'required|max:255|email',
        ]);

        $lang = app()->getLocale();

        $patient = Patient::where('email', $request->email)->first();


        if (!$patient) { //Sí el paciente no existe
            $this->validate($request, [
                'treatmentBefore' => 'required|boolean',
                'name' => 'required|string',
                'sex' => 'required|string|',
                'age' => 'required|numeric|between:18,99',
                'dob' => 'required|date',
                'phone' => ['unique:patients,phone', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'mobile' => ['required', 'different:phone', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'email' => 'required|max:255|email|unique:patients,email',
                'address' => 'required',
                'country_id' => 'required|integer',
                'state_id' => 'required|integer',
                'city' => 'required|string',
                'zip' => 'required|string',
                'ecn' => 'required|string',
                'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            ]);

            $unHashPassword = Str::random(8);
            $patient = new Patient;
            $patient->treatmentBefore = $request->treatmentBefore;
            $patient->name = $request->name;
            $patient->sex = $request->sex;
            $patient->age = $request->age;
            $patient->dob = $request->dob;
            $patient->phone = $request->phone;
            $patient->mobile = $request->mobile;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->country_id = $request->country_id;
            $patient->state_id = $request->state_id;
            $patient->city = $request->city;
            $patient->zip = $request->zip;
            $patient->ecn = $request->ecn;
            $patient->ecp = $request->ecp;
            $patient->lang = $lang;
            $patient->password = Hash::make($unHashPassword);

            if($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $destinationPath = public_path('/uploads/patient/');
                $img_name = time().'.'.$avatar->getClientOriginalExtension();
                $img = Image::make($avatar->getRealPath());
                $img->resize(300, 365, function ($constraint) {
                    $constraint->aspectRatio();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath,0777,true);
                $img->save($destinationPath.'/'.$img_name);
                $patient->photo = '/uploads/patient/'.$img_name;

            }
            $patient->save();
        }

        if(!Session::has('form_session'))
        {
            $app = new Application;
            $app->temp_code = Str::random(10);
            $app->patient_id = $patient->id;
            $app->product_id = Session::get('product')->id;

            $app->save();
            $app->generalData = 1;
            Session::put('form_session', $app);
        }

        return redirect()->route('createServicesData');
    }

    public function createServicesData(Request $request)
    {


        $lang = app()->getLocale();
        if (Session::has('form_session')) {

            $getData = Session::get('form_session');
            if ($getData->generalData == 1) {
                $app = Application::
                with('images', 'medications')
                ->find($getData->id);

                $product = Session::get('product');

                if (!$product->service->need_images) {
                    Session::forget('form_session');
                    $app->generalData = 1;
                    $app->ServicesData = 1;
                    Session::put('form_session', $app);
                    return view('site.apps.health-data', ['product' => $product, 'app' => $app]);
                }
                return view('site.apps.services-data', ['product' => $product, 'app' => $app]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function postServicesData(Request $request)
    {

        // return $request;
        // $this->validate($request, [
        //     'images' => 'required|array',
        //     'images.*' => 'image|mimes:jpg,jpeg,png'
        // ]);

        if (Session::has('form_session')) {
            $getData = Session::get('form_session');


            $app =  Application::
            with('images', 'medications')
            ->find($getData->id);
            $product = Session::get('product');
            $qty_images = $product->service->qty_images;
            return count($app->images);
            


            foreach ($request->file('images') as $file) {
                $image = $file;
                $destinationPath = storage_path('app/public').'/application/image';
                $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $width = 1200;
                $img->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

                $img->save($destinationPath."/".$img_name, '80');
                $image = "storage/application/image/$img_name";

                DB::table('image_applications')->insert(
                    [
                        'local_image' => $image,
                        'dropbox_image' => null,
                        'application_id' => $getData->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            }
            $app = Application::find($getData->id);

            Session::forget('form_session');
            $app->generalData = 1;
            $app->ServicesData = 1;
            Session::put('form_session', $app);

            $product = Session::get('product');

            return view('site.apps.health-data', ['product' => $product]);

        } else {
            abort(404);
        }

    }

    public function postHealthData(Request $request)
    {
        return $request;
        $this->validate($request, [
            "mesure_sistem"     => 'required',
            "max_weigh"         => 'required|numeric',
            "weight"            => 'required|numeric',
            "height"            => 'required|numeric',
            "imc"               => 'required|numeric',
            "take_medication"   => 'required|boolean',
            "mediacation_cadena" =>
            [
                ($request->take_medication== '1') ? 'array' : '',
                ($request->take_medication== '1') ? 'min:1' : '',

            ],
            "mediacation_cadena.medication_name" => 'required|string',
            "mediacation_cadena.medication_reason" => 'required|string',
            "mediacation_cadena.medication_dosage" => 'required|string',
            "mediacation_cadena.medication_frecuency" => 'required|string',

            "blood_thinners"    => 'required|boolean',
            "razon_blood_thinners" => 'required_if:blood_thinners,1',

            "acid_reflux"   => 'required|in:rarely,occasionally,frequently,no',
            "penicilin"     => 'required|boolean',
            "sulfa_drugs"   => 'required|boolean',
            "iodine"        => 'required|boolean',
            "tape"          => 'required|boolean',
            "latex"         => 'required|boolean',
            "aspirin"       => 'required|boolean',
            "other_allergy" => 'required|boolean'
        ]);
    }


    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->id)->get();

        return $states;
    }

    public function chekIfPatientExist(Request $request)
    {
        $patient = Patient::where('email', $request->email)
        ->with('state')
        ->first();

        if ($patient) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $patient
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'info' => ''
                ]
            );
        }
    }

    public function globalRouteDeleteSessionVar(Request $request)
    {
        if(Session::has('form_session'))
        {
            $form_app = Session::get('form_session');
            $apps = Application::
            where('id', '=', $form_app->id)
            ->with('images', 'medication')
            ->first();
            Session::forget('form_session');
            return response()->json(1);
        }
    }
}
