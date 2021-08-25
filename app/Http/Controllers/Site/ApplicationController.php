<?php

namespace App\Http\Controllers\Site;

use Image;
use App\Models\Site\State;
use Illuminate\Support\Str;
use App\Models\Site\Country;
use Illuminate\Http\Request;
use App\Models\Staff\Patient;
use App\Models\Staff\Product;
use App\Models\Site\Application;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Site\SurgeryApplication;
use Illuminate\Support\Facades\Session;
use App\Models\Site\IllnsessApplication;
use Illuminate\Support\Facades\Validator;
use App\Models\Site\MedicationApplication;
use Illuminate\Database\Eloquent\Collection;

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
                    Session::forget('form_session');
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
        $product = Session::get('product');

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

        if (!$product->service->need_images) {
            $getData = Session::get('form_session');
            $product = Session::get('product');
            $app = Application::with('images', 'medications')->find($getData->id);
            Session::forget('form_session');
            $app->ServicesData = 1;
            Session::put('form_session', $app);
            //return view('site.apps.health-data', ['product' => $product, 'app' => $app]);
            return redirect()->route('createHealthData');
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
            $getData = Session::get('form_session');
            $app = Application::with('images', 'medications')->find($getData->id);
            $product = Session::get('product');

            return view('site.apps.health-data', ['product' => $product, 'app' => $app]);

        } else {
            abort(404);
        }

    }

    public function createHealthData()
    {

        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            if ($getData->generalData == 1 || $getData->ServicesData == 1) {
                $product = Session::get('product');
                $app = Application::with('images', 'medications')->find($getData->id);
                return view('site.apps.health-data', ['product' => $product, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postHealthData(Request $request)
    {

        $medication_cadena = [];
        $collection = new Collection();

        if ($request->has('medication_name') || $request->has('medication_reason') || $request->has('medication_dosage') || $request->has('medication_frecuency')) {
            for ($i=0; $i < count($request->medication_name); $i++) {
                $medication_cadena[] = [
                    'medication_name' => $request->medication_name[$i],
                    'medication_reason' => $request->medication_reason[$i],
                    'medication_dosage' => $request->medication_dosage[$i],
                    'medication_frecuency' => $request->medication_frecuency[$i],
                ];

                $collection->push((object)[
                    'medication_name' => $request->medication_name[$i],
                    'medication_reason' => $request->medication_reason[$i],
                    'medication_dosage' => $request->medication_dosage[$i],
                    'medication_frecuency' => $request->medication_frecuency[$i],
                ]);

            }
        }

        $request->merge(["medication_cadena" => $medication_cadena]);
        $request->merge(["medicationCadena" => $collection]);

        $validator = Validator::make($request->all(), [
            "mesure_sistem"     => 'required',
            "max_weigh"         => 'required|numeric',
            "weight"            => 'required|numeric',
            "height"            => 'required|numeric',
            "imc"               => 'required|numeric',
            "take_medication"   => 'required|boolean',

            "medication_name" => ['required_if:take_medication,1','array'],
            "medication_name.*" => ['required_if:take_medication,1','string'],
            "medication_reason" => ['required_if:take_medication,1','array'],
            "medication_reason.*" => ['required_if:take_medication,1','string'],
            "medication_dosage" => ['required_if:take_medication,1','array'],
            "medication_dosage.*" => ['required_if:take_medication,1','string'],
            "medication_frecuency" => ['required_if:take_medication,1','array'],
            "medication_frecuency.*" => ['required_if:take_medication,1','string'],

            "blood_thinners"    => 'required|boolean',
            "razon_blood_thinners" => 'required_if:blood_thinners,1',

            "acid_reflux"   => 'required|in:rarely,occasionally,frequently,no',
            "penicilin"     => 'required|boolean',
            "sulfa_drugs"   => 'required|boolean',
            "iodine"        => 'required|boolean',
            "tape"          => 'required|boolean',
            "latex"         => 'required|boolean',
            "aspirin"       => 'required|boolean',
            "other_allergy" => 'sometimes|nullable|string'
        ]);

        if ($validator->fails()) {
            $request->merge(['medication_cadena' => json_encode($request->medication_cadena)]);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            $app =  Application::
            with('images', 'medications')
            ->find($getData->id);
            $product = Session::get('product');

            $app->mesure_sistem = $request->mesure_sistem;
            $app->weight = $request->max_weigh;
            $app->max_weigh = $request->weight;
            $app->height = $request->height;
            $app->imc = $request->imc;
            $app->if_take_medication = $request->take_medication;
            $app->if_take_blood_thinners = $request->blood_thinners;
            $app->razon_blood_thinners = $request->razon_blood_thinners;
            $app->acid_reflux = $request->acid_reflux;
            $app->penicilin = $request->penicilin;
            $app->drugs_sulfa = $request->sulfa_drugs;
            $app->iodine = $request->iodine;
            $app->tape = $request->tape;
            $app->latex = $request->latex;
            $app->aspirin = $request->aspirin;
            $app->other_allergy = null;
            $app->describe_other_allergy = $request->other_allergy;

            if ($app->save()) {
                $insert_medications = [];
                for ($i = 0; $i < count($medication_cadena); $i++) {
                    $insert_medications[] = [
                        'application_id' => $app->id,
                        'name' => $medication_cadena[$i]['medication_name'],
                        'reason' => $medication_cadena[$i]['medication_reason'],
                        'dosage' => $medication_cadena[$i]['medication_dosage'],
                        'frecuency' => $medication_cadena[$i]['medication_frecuency'],
                    ];
                }
                $app->medications()->delete();
                MedicationApplication::insert($insert_medications);

                Session::forget('form_session');
                $app->generalData = 1;
                $app->ServicesData = 1;
                $app->healthData = 1;
                Session::put('form_session', $app);
                $getData = Session::get('form_session');
                $app = Application::with('images', 'medications')->find($getData->id);
                $product = Session::get('product');

                return redirect()->route('createSurgicalData');

            }
        } else {
            abort(404);
        }
    }

    public function createSurgicalData()
    {
        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            if ($getData->generalData == 1 || $getData->ServicesData == 1) {
                $product = Session::get('product');
                $app = Application::with('images', 'medications')->find($getData->id);
                return view('site.apps.surgical-data', ['product' => $product, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postSurgicalData(Request $request)
    {
        $surgey_cadena = [];
        $collection = new Collection();

        if ($request->has('surgey_type') || $request->has('surgey_name') || $request->has('surgey_age') || $request->has('surgey_year') || $request->has('surgey_complications')) {
            for ($i=0; $i < count($request->surgey_type); $i++) {
                $surgey_cadena[] = [
                    'surgey_type' => $request->surgey_type[$i],
                    'surgey_name' => $request->surgey_name[$i],
                    'surgey_age' => $request->surgey_age[$i],
                    'surgey_year' => $request->surgey_year[$i],
                    'surgey_complications' => $request->surgey_complications[$i],
                ];

                $collection->push((object)[
                    'surgey_type' => $request->surgey_type[$i],
                    'surgey_name' => $request->surgey_name[$i],
                    'surgey_age' => $request->surgey_age[$i],
                    'surgey_year' => $request->surgey_year[$i],
                    'surgey_complications' => $request->surgey_complications[$i],
                ]);

            }
        }

        $request->merge(["surgey_cadena" => $surgey_cadena]);
        $request->merge(["surgeyCadena" => $collection]);



        $validator = Validator::make($request->all(), [
            "previus_surgery"   => 'required|boolean',

            "surgey_type" => ['required_if:take_medication,1','array'],
            "surgey_type.*" => ['required_if:take_medication,1','string'],
            "surgey_name" => ['required_if:take_medication,1','array'],
            "surgey_name.*" => ['required_if:take_medication,1','string'],
            "surgey_age" => ['required_if:take_medication,1','array'],
            "surgey_age.*" => ['required_if:take_medication,1','string'],
            "surgey_year" =>['required_if:take_medication,1','array'],
            "surgey_year.*" => ['required_if:take_medication,1','string'],
            "surgey_complications" =>['required_if:take_medication,1','array'],
            "surgey_complications.*" => ['required_if:take_medication,1','string']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            $app =  Application::
            with('images', 'medications')
            ->find($getData->id);
            $product = Session::get('product');

            $app->if_have_surgeries = $request->previus_surgery;

            if ($app->save()) {
                $insert_surgeries = [];
                for ($i = 0; $i < count($surgey_cadena); $i++) {
                    $insert_surgeries[] = [
                        'application_id' => $app->id,
                        'type' => $surgey_cadena[$i]['surgey_type'],
                        'name' => $surgey_cadena[$i]['surgey_name'],
                        'age' => $surgey_cadena[$i]['surgey_age'],
                        'year' => $surgey_cadena[$i]['surgey_year'],
                        'complications' => $surgey_cadena[$i]['surgey_complications'],
                    ];
                }
                $app->surgeries()->delete();
                SurgeryApplication::insert($insert_surgeries);

                Session::forget('form_session');
                $app->generalData = 1;
                $app->ServicesData = 1;
                $app->healthData = 1;
                $app->surgeyData = 1;
                Session::put('form_session', $app);

                return redirect()->route('createMedicalHistoryData');

            }
        } else {
            abort(404);
        }

    }

    public function createMedicalHistoryData()
    {
        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            if ($getData->generalData == 1 && $getData->ServicesData == 1 && $getData->surgeyData == 1) {
                $product = Session::get('product');
                $app = Application::with('images', 'medications')->find($getData->id);
                return view('site.apps.medical-history-data', ['product' => $product, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postMedicalHistoryData(Request $request)
    {
        //return $request;

        $illness_cadena = [];
        $collection = new Collection();

        if ($request->has('illness') || $request->has('diagnostic_date') || $request->has('treatment')) {
            for ($i=0; $i < count($request->illness); $i++) {
                $illness_cadena[] = [
                    'illness' => $request->illness[$i],
                    'diagnostic_date' => $request->diagnostic_date[$i],
                    'treatment' => $request->treatment[$i],
                ];

                $collection->push((object)[
                    'illness' => $request->illness[$i],
                    'diagnostic_date' => $request->diagnostic_date[$i],
                    'treatment' => $request->treatment[$i],
                ]);

            }
        }

        $request->merge(["illness_cadena" => $illness_cadena]);
        $request->merge(["illnessCadena" => $collection]);

        $validator = Validator::make($request->all(), [

            "addiction" => 'required|boolean',
            "which_one_adiction" => 'required_if:addiction,1','string',
            "high_lipid_levels" => 'required|boolean',
            "date_high_lipid_levels" => 'required_if:high_lipid_levels,1','date',
            "high_lipid_levels_treatment" => 'required_if:high_lipid_levels,1','string',
            "arthritis" => 'required|boolean',
            "date_arthritis" => 'required_if:arthritis,1','date',
            "arthritis_treatment" => 'required_if:arthritis,1','string',
            "cancer" => 'required|boolean',
            "date_cancer" => 'required_if:cancer,1','date',
            "cancer_treatment" => 'required_if:cancer,1','string',
            "cholesterol" => 'required|boolean',
            "date_cholesterol" => 'required_if:cholesterol,1','date',
            "cholesterol_treatment" => 'required_if:cholesterol,1','string',
            "triglycerides" => 'required|boolean',
            "date_triglycerides" => 'required_if:triglycerides,1','date',
            "triglycerides_treatment" => 'required_if:triglycerides,1','string',
            "stroke" => 'required|boolean',
            "date_stroke" => 'required_if:stroke,1','date',
            "stroke_treatment" => 'required_if:stroke,1','string',
            "diabetes" => 'required|boolean',
            "date_diabetes" => 'required_if:diabetes,1','date',
            "diabetes_treatment" => 'required_if:diabetes,1','string',
            "coronary_artery_disease" => 'required|boolean',
            "date_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
            "coronary_artery_disease_treatment" => 'required_if:coronary_artery_disease,1','string',
            "liver_disease" => 'required|boolean',
            "date_liver_disease" => 'required_if:liver_disease,1','date',
            "liver_disease_treatment" => 'required_if:liver_disease,1','string',
            "lugn_disease" => 'required|boolean',
            "date_lugn_disease" => 'required_if:lugn_disease,1','date',
            "lugn_disease_treatment" => 'required_if:lugn_disease,1','string',
            "renal_disease" => 'required|boolean',
            "date_renal_disease" => 'required_if:renal_disease,1','date',
            "renal_disease_treatment" => 'required_if:renal_disease,1','string',
            "thyroid_disease" => 'required|boolean',
            "date_thyroid_disease" => 'required_if:thyroid_disease,1','date',
            "thyroid_disease_treatment" => 'required_if:thyroid_disease,1','string',
            "hypertension" => 'required|boolean',
            "date_hypertension" => 'required_if:hypertension,1','string',
            "hypertension_treatment" => 'required_if:hypertension,1','string',
            "any_other_illnesses" => 'required|boolean',

            "illness" => ['required_if:any_other_illnesses,1','array'],
            "illness.*" => ['required_if:any_other_illnesses,1','string'],
            "diagnostic_date" => ['required_if:any_other_illnesses,1','array'],
            "diagnostic_date.*" => ['required_if:any_other_illnesses,1','date'],
            "treatment" => ['required_if:any_other_illnesses,1','array'],
            "treatment.*" => ['required_if:any_other_illnesses,1','string'],
            //"hola" => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            $app =  Application::
            with('images', 'medications')
            ->find($getData->id);
            $product = Session::get('product');

            $app->addiction = $request->addiction;
            $app->which_one_adiction = $request->which_one_adiction;
            $app->high_lipd_levels = $request->high_lipid_levels;
            $app->date_high_lipd_levels = $request->date_high_lipid_levels;
            $app->high_lipd_levels_treatment = $request->high_lipid_levels_treatment;
            $app->cancer = $request->cancer;
            $app->date_cancer = $request->date_cancer;
            $app->cancer_treatment = $request->cancer_treatment;
            $app->arthritis = $request->arthritis;
            $app->date_arthritis = $request->date_arthritis;
            $app->arthritis_treatment = $request->arthritis_treatment;
            $app->cholesterol = $request->cholesterol;
            $app->date_cholesterol = $request->date_cholesterol;
            $app->cholesterol_treatment = $request->cholesterol_treatment;
            $app->triglycerides = $request->triglycerides;
            $app->date_triglycerides = $request->date_triglycerides;
            $app->triglycerides_treatment = $request->triglycerides_treatment;
            $app->disease_stroke = $request->stroke;
            $app->date_disease_stroke = $request->date_stroke;
            $app->disease_stroke_treatment = $request->stroke_treatment;
            $app->diabetes = $request->diabetes;
            $app->date_diabetes = $request->date_diabetes;
            $app->diabetes_treatment = $request->diabetes_treatment;
            $app->coronary_artery_disease = $request->coronary_artery_disease;
            $app->date_coronary_artery_disease = $request->date_coronary_artery_disease;
            $app->coronary_artery_disease_treatment = $request->coronary_artery_disease_treatment;
            $app->disease_liver = $request->liver_disease;
            $app->date_disease_liver = $request->date_liver_disease;
            $app->disease_liver_treatment = $request->liver_disease_treatment;
            $app->disease_lung = $request->lugn_disease;
            $app->date_disease_lung = $request->date_lugn_disease;
            $app->disease_lung_treatment = $request->lugn_disease_treatment;
            $app->disease_renal = $request->renal_disease;
            $app->date_disease_renal = $request->date_renal_disease;
            $app->disease_renal_treatment = $request->renal_disease_treatment;
            $app->disease_thyroid = $request->thyroid_disease;
            $app->date_disease_thyroid = $request->date_thyroid_disease;
            $app->disease_thyroid_treatment = $request->thyroid_disease_treatment;
            $app->ypertension = $request->hypertension;
            $app->hypertension = $request->date_hypertension;
            $app->hypertension_treatment = $request->hypertension_treatment;
            $app->disease_other = $request->any_other_illnesses;


            if ($app->save()) {
                $insert_surgeries = [];
                for ($i = 0; $i < count($illness_cadena); $i++) {
                    $insert_illnesses[] = [
                        'application_id' => $app->id,
                        'illness' => $illness_cadena[$i]['illness'],
                        'diagnostic_date' => $illness_cadena[$i]['diagnostic_date'],
                        'treatment' => $illness_cadena[$i]['treatment'],
                    ];
                }
                $app->illnessess()->delete();
                IllnsessApplication::insert($insert_illnesses);

                Session::forget('form_session');
                $app->generalData = 1;
                $app->ServicesData = 1;
                $app->healthData = 1;
                $app->surgeyData = 1;
                $app->medicalHistoryData = 1;
                Session::put('form_session', $app);

                return redirect()->route('createGeneralHealthData');

            }
        } else {
            abort(404);
        }
    }

    public function createGeneralHealthData()
    {
        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            if ($getData->generalData == 1 && $getData->ServicesData == 1 && $getData->surgeyData == 1 && $getData->medicalHistoryData = 1) {
                $product = Session::get('product');
                $app = Application::with('images', 'medications')->find($getData->id);
                return view('site.apps.general-health-data', ['product' => $product, 'app' => $app]);
            } else {
                return 'not';
            }
        }
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
