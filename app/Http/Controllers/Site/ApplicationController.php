<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Models\Site\BirthControlApplication;
use App\Models\Site\Country;
use App\Models\Site\ExerciseApplication;
use App\Models\Site\HormonesApplication;
use App\Models\Site\IllnsessApplication;
use App\Models\Site\ImageApplication;
use App\Models\Site\MedicationApplication;
use App\Models\Site\State;
use App\Models\Site\SurgeryApplication;
use App\Models\Staff\Patient;
use App\Models\Staff\Service;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use App\Models\Staff\Treatment;
use App\Traits\DatesLangTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ApplicationController extends Controller
{
    use DatesLangTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $lang = app()->getLocale();
        $exists = Treatment::where('active', true)
        ->findOrFail($id);

        $countries = Country::where('active', 1)->orderBy('name', 'desc')->select("id", "name")->get();

        $treatment = Treatment::with
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

        if ($exists) {

            Session::put('treatment', $treatment);

            if(Session::has('form_session'))
            {
                $sessionData = Session::get('form_session');
                $patient = Patient::find($sessionData->patient_id);
                if ($sessionData->treatment_id == $id) {
                    return view
                    (
                        'site.apps.patient-data',
                        [
                            'sessionData' => $sessionData,
                            'patient' => $patient,
                            'treatment' => $treatment,
                            'countries' => $countries
                        ]
                    );
                } else {
                    Session::forget('form_session');
                    return view
                    (
                        'site.apps.patient-data',
                        [
                            'treatment' => $treatment,
                            'countries' => $countries
                        ]
                    );
                }
            }
            return view
            (
                'site.apps.patient-data',
                [
                    'treatment' => $treatment,
                    'countries' => $countries
                ]
            );
        }
    }

    public function createPatientData(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255|email',
        ]);

        $lang = app()->getLocale();

        $patient = Patient::where('email', $request->email)->first();
        $treatment = Session::get('treatment');

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
            $patient->name = Str::ucfirst($request->name);
            $patient->sex = $request->sex;
            $patient->age = $request->age;
            $patient->dob = $request->dob;
            $patient->phone = $request->phone;
            $patient->mobile = $request->mobile;
            $patient->email = Str::of($request->email)->lower();
            $patient->address = $request->address;
            $patient->country_id = $request->country_id;
            $patient->state_id = $request->state_id;
            $patient->city = $request->city;
            $patient->zip = $request->zip;
            $patient->ecn = $request->ecn;
            $patient->ecp = $request->ecp;
            $patient->lang = $lang;
            $patient->password = Hash::make($unHashPassword);
            $patient->code = time().uniqid(Str::random(30));

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
                $img->destroy();

            }
            $patient->save();
        }


        if(!Session::has('form_session'))
        {
            $app = new Application;
            $app->temp_code = Str::random(10);
            $app->patient_id = $patient->id;
            $app->treatment_id = Session::get('treatment')->id;

            $app->save();
            $app->generalData = 1;
            Session::put('form_session', $app);
        } else {
        }



        if (!$treatment->service->need_images) {
            $getData = Session::get('form_session');
            $treatment = Session::get('treatment');
            $app = Application::with('imageMany', 'medications')->find($getData->id);
            Session::forget('form_session');
            $app->generalData = 1;
            $app->servicesData = 1;
            Session::put('form_session', $app);
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
                with([
                    'medications',
                    'imageMany' => function($q) {
                        $q->orderBy('order', 'asc');
                    }, 
                ])
                ->find($getData->id);
                $treatment = Session::get('treatment');
                return view('site.apps.services-data', ['treatment' => $treatment, 'app' => $app]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function postServicesData(Request $request)
    {
        $this->validate($request, [
            'dropify' => 'required|image|mimes:jpg,jpeg,png',
            'order' => 'integer'
        ]);

        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            $app =  Application::with('imageMany', 'medications')->find($getData->id);

            $treatment = Session::get('treatment');
            $qty_images = $treatment->service->qty_images;

            $image = $request->file('dropify');

            $code = time().uniqid(Str::random(30));

            if ($request->code != 'undefined' || !is_null($request->code)) {

                $imageExist = $app->imageMany()->where('code', $request->code)->first();

                if ($imageExist) {

                    $imageForDelete = $imageExist->image;
                    $idForDelete = $imageExist->id;

                    $imageExist->delete();

                    if( file_exists($imageForDelete) ){
                        unlink(public_path($imageForDelete));
                    }
                }
            }

            $destinationPath = storage_path('app/public').'/application/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = Image::make($image)->width();
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '90');
            $image = "storage/application/image/$img_name";
            $img->destroy();
            
            $image = $app->imageMany()->create(["code" => $code, 'image' => $image, 'title' => null, 'order' => $request->order]); 

            $app = Application::find($getData->id);

            Session::forget('form_session');
            $app->generalData = 1;
            $app->servicesData = 1;
            Session::put('form_session', $app);
            $getData = Session::get('form_session');
            $app = Application::with('imageMany', 'medications')->find($getData->id);
            $treatment = Session::get('treatment');

            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('the image processed and stored successfully!'),
                    'data'=> $image,
                    'success' => true,
                    'go' => '1',
                ]
            );
        } else {
            abort(404);
        }
    }

    public function appImageDestroy(Request $request)
    {
        $getData = Session::get('form_session');
        $app = Application::with('imageMany', 'medications')->find($getData->id);

        if ($request->code != 'undefined' || !is_null($request->code)) {

            $imageExist = $app->imageMany()->where('code', $request->code)->first();

            if ($imageExist) {
                $imageForDelete = $imageExist->image;
                $idForDelete = $imageExist->id;

                $imageExist->delete();

                if( file_exists($imageForDelete) ){
                    unlink(public_path($imageForDelete));
                }
            }
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('the image was deleted successfully!'),
                    'success' => true,
                    'go' => '1',
                ]
            );
        }
    }

    public function nextStep(Request $request)
    {
        $getData = Session::get('form_session');
        $app = Application::with('imageMany', 'medications')->find($getData->id);

        $treatment = Session::get('treatment');

        if ($treatment->service->qty_images == count($app->imageMany)) {

            return response()->json(
                [
                    "success" => true,
                    'go' => url('/applications/create-health-data'),
                ]
            );
        }
        return response()->json(
            [
                "success" => false,
                'go' => Lang::get('You must upload all images'),
            ]
        );
    }

    public function createHealthData()
    {
        $lang = app()->getLocale();
        $treatment = Session::get('treatment');


        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            if ($getData->generalData == 1 || $getData->servicesData == 1) {
                $treatment = Session::get('treatment');
                $app = Application::with('imageMany', 'medications')->find($getData->id);
                return view('site.apps.health-data', ['treatment' => $treatment, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postHealthData(Request $request)
    {
        
        $medication_cadena = [];
        $collection = new Collection();
        $code = time().uniqid(Str::random(30));
        if ($request->has('medication_name') || $request->has('medication_reason') || $request->has('medication_dosage') || $request->has('medication_frecuency')) {
            for ($i=0; $i < count($request->medication_name); $i++) {
                $medication_cadena[] = [
                    'medication_name' => $request->medication_name[$i],
                    'medication_reason' => $request->medication_reason[$i],
                    'medication_dosage' => $request->medication_dosage[$i],
                    'medication_frecuency' => $request->medication_frecuency[$i],
                    'code' => $code,
                ];

                $collection->push((object)[
                    'medication_name' => $request->medication_name[$i],
                    'medication_reason' => $request->medication_reason[$i],
                    'medication_dosage' => $request->medication_dosage[$i],
                    'medication_frecuency' => $request->medication_frecuency[$i],
                    'code' => $code,
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
            "drugs_sulfa"   => 'required|boolean',
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
            with('imageMany', 'medications')
            ->find($getData->id);
            $treatment = Session::get('treatment');

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
            $app->drugs_sulfa = $request->drugs_sulfa;
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
                        'code' => $medication_cadena[$i]['code'],
                    ];
                }
                $app->medications()->delete();
                MedicationApplication::insert($insert_medications);

                Session::forget('form_session');
                $app->generalData = 1;
                $app->servicesData = 1;
                $app->healthData = 1;
                Session::put('form_session', $app);
                $getData = Session::get('form_session');
                $app = Application::with('imageMany', 'medications')->find($getData->id);
                $treatment = Session::get('treatment');

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
            if ($getData->generalData == 1 || $getData->servicesData == 1) {
                $treatment = Session::get('treatment');
                $app = Application::with('imageMany', 'medications', 'surgeries')->find($getData->id);
                return view('site.apps.surgical-data', ['treatment' => $treatment, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postSurgicalData(Request $request)
    {
        $surgey_cadena = [];
        $collection = new Collection();
        $code = time().uniqid(Str::random(30));
        if ($request->has('surgey_type') || $request->has('surgey_name') || $request->has('surgey_age') || $request->has('surgey_year') || $request->has('surgey_complications')) {
            for ($i=0; $i < count($request->surgey_type); $i++) {
                $surgey_cadena[] = [
                    'surgey_type' => $request->surgey_type[$i],
                    'surgey_name' => $request->surgey_name[$i],
                    'surgey_age' => $request->surgey_age[$i],
                    'surgey_year' => $request->surgey_year[$i],
                    'surgey_complications' => $request->surgey_complications[$i],
                    'code' => $code, 
                ];

                $collection->push((object)[
                    'surgey_type' => $request->surgey_type[$i],
                    'surgey_name' => $request->surgey_name[$i],
                    'surgey_age' => $request->surgey_age[$i],
                    'surgey_year' => $request->surgey_year[$i],
                    'surgey_complications' => $request->surgey_complications[$i],
                    'code' => $code, 
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
            "surgey_age.*" => ['required_if:take_medication,1','numeric'],
            "surgey_year" =>['required_if:take_medication,1','array'],
            "surgey_year.*" => [
                'required_if:take_medication,1',
                'numeric',
                'min:' . (date("Y") - 100),
                'max:' . date("Y")
            ],
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
            with('imageMany', 'medications')
            ->find($getData->id);
            $treatment = Session::get('treatment');

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
                        'code' => $surgey_cadena[$i]['code'],
                    ];
                }
                $app->surgeries()->delete();
                SurgeryApplication::insert($insert_surgeries);

                Session::forget('form_session');
                $app->generalData = 1;
                $app->servicesData = 1;
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
            if ($getData->generalData == 1 && $getData->servicesData == 1 && $getData->surgeyData == 1) {
                $treatment = Session::get('treatment');
                $app = Application::with('imageMany', 'medications', 'illnessess')->find($getData->id);
                return view('site.apps.medical-history-data', ['treatment' => $treatment, 'app' => $app]);
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
        $code = time().uniqid(Str::random(30));
        if ($request->has('illness') || $request->has('diagnostic_date') || $request->has('treatment')) {
            for ($i=0; $i < count($request->illness); $i++) {
                $illness_cadena[] = [
                    'illness' => $request->illness[$i],
                    'diagnostic_date' => $request->diagnostic_date[$i],
                    'treatment' => $request->treatment[$i],
                    'code' => $code
                ];

                $collection->push((object)[
                    'illness' => $request->illness[$i],
                    'diagnostic_date' => $request->diagnostic_date[$i],
                    'treatment' => $request->treatment[$i],
                    'code' => $code
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
            with('imageMany', 'medications')
            ->find($getData->id);
            $treatment = Session::get('treatment');

            $app->addiction = $request->addiction;
            $app->which_one_adiction = $request->which_one_adiction;
            $app->high_lipid_levels = $request->high_lipid_levels;
            $app->date_high_lipd_levels = $request->date_high_lipid_levels;
            $app->high_lipid_levels_treatment = $request->high_lipid_levels_treatment;
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
                $insert_illnesses = [];
                for ($i = 0; $i < count($illness_cadena); $i++) {
                    $insert_illnesses[] = [
                        'application_id' => $app->id,
                        'illness' => $illness_cadena[$i]['illness'],
                        'diagnostic_date' => $illness_cadena[$i]['diagnostic_date'],
                        'treatment' => $illness_cadena[$i]['treatment'],
                        'code' => $illness_cadena[$i]['code']
                    ];
                }
                $app->illnessess()->delete();
                IllnsessApplication::insert($insert_illnesses);

                Session::forget('form_session');
                $app->generalData = 1;
                $app->servicesData = 1;
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
            if ($getData->generalData == 1 && $getData->servicesData == 1 && $getData->surgeyData == 1 && $getData->medicalHistoryData = 1) {
                $treatment = Session::get('treatment');
                $app = Application::with('imageMany', 'medications', 'exercices')->find($getData->id);
                $patient = Patient::find($getData->patient_id);
                return view('site.apps.general-health-data', ['treatment' => $treatment, 'app' => $app, 'patient' => $patient]);
            } else {
                return 'not';
            }
        }
    }

    public function postGeneralHealthData(Request $request)
    {
        $exercise_cadena = [];
        $collection = new Collection();
        $code = time().uniqid(Str::random(30));
        if ($request->has('exercise_type') || $request->has('exercise_how_long') || $request->has('exercise_how_frecuen') || $request->has('exercise_hours')) {
            for ($i=0; $i < count($request->exercise_type); $i++) {
                $exercise_cadena[] = [
                    'exercise_type' => $request->exercise_type[$i],
                    'exercise_how_long' => $request->exercise_how_long[$i],
                    'exercise_how_frecuent' => $request->exercise_how_frecuent[$i],
                    'exercise_hours' => $request->exercise_hours[$i],
                    'code' => $code,
                ];

                $collection->push((object)[
                    'exercise_type' => $request->exercise_type[$i],
                    'exercise_how_long' => $request->exercise_how_long[$i],
                    'exercise_how_frecuent' => $request->exercise_how_frecuent[$i],
                    'exercise_hours' => $request->exercise_hours[$i],
                    'code' => $code,
                ]);

            }
        }

        $request->merge(["exercise_cadena" => $exercise_cadena]);
        $request->merge(["exerciseCadena" => $collection]);




        //return $request;

        if (Session::has('form_session') && Session::has('treatment')) {
            $treatment = Session::get('treatment');
            $getData = Session::get('form_session');
            $patient = Patient::find($getData->patient_id);

            if ($treatment->service_id != 3 && $patient->sex != 'male') {
                $validator = Validator::make($request->all(), [
                    "smoke" => "required|boolean",
                    "smoke_cigars" => "required_if:smoke,1|nullable|integer",
                    "smoke_years" => "required_if:smoke,1|nullable|numeric",
                    "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                    "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                    "alcohol" => "required|boolean",
                    "volumen_alcohol" => [
                        ($request->alcohol == "1") ? "string":null,
                    ],


                    "recreative_drugs" => "required|boolean",
                    "total_recreative_drugs" => [
                        ($request->recreative_drugs == '1') ? 'string':null,
                    ],

                    "intravenous_drugs" => "required_if:recreative_drugs,1|boolean",
                    "description_intravenous_drugs" => [
                        ($request->intravenous_drugs == '1') ? 'string':null,
                    ],

                    "fatigue" => "required|boolean",
                    "trouble_breathe" => "required|boolean",
                    "asthma" => "required|boolean",
                    "bipap_cpap" => "required|boolean",
                    "exercise" => "required|boolean",

                    "exercise_type" => ['required_if:exercise,1','array'],
                    "exercise_type.*" => ['required_if:exercise,1','string'],
                    "exercise_how_long" => ['required_if:exercise,1','array'],
                    "exercise_how_long.*" => ['required_if:exercise,1','string'],
                    "exercise_how_frecuent.*" => ['required_if:exercise,1','string'],
                    "exercise_how_frecuent" => ['required_if:exercise,1','array'],
                    "exercise_hours.*" => ['required_if:exercise,1','string'],
                    "exercise_hours" => ['required_if:exercise,1','array'],
                ]);

                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            }


            if ($treatment->service_id == 3 && $patient->sex == 'male') {
                $validator2 = Validator::make($request->all(), [

                    "smoke" => "required|boolean",
                    "smoke_cigars" => "required_if:smoke,1|nullable|string",
                    "smoke_years" => "required_if:smoke,1|nullable|numeric",
                    "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                    "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                    "alcohol" => "required|boolean",
                    "volumen_alcohol" => [
                        ($request->alcohol == "1") ? "string":null,
                    ],

                    "recreative_drugs" => "required|boolean",
                    "total_recreative_drugs" => [
                        ($request->recreative_drugs == '1') ? 'string':null,
                    ],
                    "intravenous_drugs" => "required_if:recreative_drugs,1|boolean",
                    "description_intravenous_drugs" => [
                        ($request->intravenous_drugs == '1') ? 'string':null,
                    ],

                    "fatigue" => "required|boolean",
                    "trouble_breathe" => "required|boolean",
                    "asthma" => "required|boolean",
                    "bipap_cpap" => "required|boolean",
                    "exercise" => "required|boolean",

                    "exercise_type" => ['required_if:exercise,1','array'],
                    "exercise_type.*" => ['required_if:exercise,1','string'],
                    "exercise_how_long" => ['required_if:exercise,1','array'],
                    "exercise_how_long.*" => ['required_if:exercise,1','string'],
                    "exercise_how_frecuent.*" => ['required_if:exercise,1','string'],
                    "exercise_how_frecuent" => ['required_if:exercise,1','array'],
                    "exercise_hours.*" => ['required_if:exercise,1','string'],
                    "exercise_hours" => ['required_if:exercise,1','array'],
                    ///////////////////////////////////////////////////////
                    "hours_you_sleep_at_night" => ['required', 'numeric'],
                    'do_you_take_sleeping_pills' => ['required', 'boolean'],
                    'do_you_suffer_from_anxiety_or_depression' => ['required', 'boolean'],
                    'do_you_take_pills_for_anxiety_or_depression' => ['required', 'boolean'],
                    'do_you_feel_under_stress' => ['required', 'boolean'],
                    ///////////////////////////////////////////////////////
                    "do_you_have_erections_at_the_morning" => ['required','boolean'],
                    "how_many_per_week" => [
                        ($request->do_you_have_erections_at_the_morning == '1') ? 'string':null,
                        ($request->do_you_have_erections_at_the_morning == '1') ? 'required':null,
                    ],
                    "do_you_have_problems_getting_erections" => ['required','boolean'],
                    "since_when" => [
                        ($request->do_you_have_problems_getting_erections == '1') ? 'string':null,
                        ($request->do_you_have_problems_getting_erections == '1') ? 'required':null,
                    ],
                    "describe_your_erection_problem" => [
                        ($request->describe_your_erection_problem == '1') ? 'string':null,
                        ($request->describe_your_erection_problem == '1') ? 'required':null,
                    ],
                    "do_you_have_problems_maintaining_an_erection" => ['required','boolean'],
                    "do_you_take_any_natural_remedy_for_erectile_dysfunction" => ['required','boolean'],
                    "what_kind" => [
                        ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'string':null,
                        ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'required':null,
                    ],
                    "how_did_it_work_natural_remedy" => [
                        ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'string':null,
                        ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'required':null,
                    ],
                    "where_did_you_get_them" => [
                        ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'string':null,
                        ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'required':null,
                    ],
                    "has_medication_been_injected_for_dysfunction_erectile" => ['required','boolean'],
                    "how_many_times_have_injected" => [
                        ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'string':null,
                        ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'required':null,
                    ],
                    "how_did_it_work" => [
                        ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'string':null,
                        ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'required':null,
                    ],
                    "have_you_had_an_erection_longer_than_six_hours" => ['required','boolean'],
                    "when_you_had_a_six_hours_erection" =>[
                        ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'string':null,
                        ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'required':null,
                    ],
                    "how_was_it_resolved" => [
                        ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'string':null,
                        ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'required':null,
                    ],
                    "did_you_get_medical_attention" => [
                        ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'string':null,
                        ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'required':null,
                    ],
                    "do_you_suffer_from_penile_curvature" => ['required','boolean'],
                    "how_intense" => [
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
                    ],
                    "which_direction" => [
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
                    ],
                    "does_it_hurt" => [
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
                    ],
                    "does_it_prevent_intercourse" => [
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
                        ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
                    ],
                    "has_prp_been_injected_for_erectile_dysfunction" => ['required','boolean'],
                    "have_you_received_stem_cell_treatment_for_erectile_dysfunction" => ['required','boolean'],
                    "hyrvrntwliwtfed" => ['required','boolean'],
                ]);
                if ($validator2->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator2)
                        ->withInput();
                }
            }

            if ($treatment->service_id == 3 && $patient->sex == 'male') {
                $validator = Validator::make($request->all(), [

                    "smoke" => "required|boolean",
                    "smoke_cigars" => "required_if:smoke,1|nullable|string",
                    "smoke_years" => "required_if:smoke,1|nullable|integer",
                    "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                    "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                    "alcohol" => "required|boolean",
                    "volumen_alcohol" => "required_if:alcohol,1|string",

                    "recreative_drugs" => "required|boolean",
                    "total_recreative_drugs" => [
                        ($request->recreative_drugs == '1') ? 'string': null
                    ],

                    "intravenous_drugs" => "required_if:recreative_drugs,1|boolean",
                    "description_intravenous_drugs" => "required_if:intravenous_drugs,1|string",

                    "fatigue" => "required|boolean",
                    "trouble_breathe" => "required|boolean",
                    "asthma" => "required|boolean",
                    "bipap_cpap" => "required|boolean",
                    "exercise" => "required|boolean",

                    "exercise_type" => ['required_if:exercise,1','array'],
                    "exercise_type.*" => ['required_if:exercise,1','string'],
                    "exercise_how_long" => ['required_if:exercise,1','array'],
                    "exercise_how_long.*" => ['required_if:exercise,1','string'],
                    "exercise_how_frecuent.*" => ['required_if:exercise,1','string'],
                    "exercise_how_frecuent" => ['required_if:exercise,1','array'],
                    "exercise_hours.*" => ['required_if:exercise,1','numeric'],
                    "exercise_hours" => ['required_if:exercise,1','array'],
                    ///////////////////////////////////////////////////////
                    "hours_you_sleep_at_night" => ['required', 'numeric'],
                    
                    'do_you_take_sleeping_pills' => ['required', 'boolean'],
                    'do_you_suffer_from_anxiety_or_depression' => ['required', 'boolean'],
                    'do_you_take_pills_for_anxiety_or_depression' => ['required', 'boolean'],
                    'do_you_feel_under_stress' => ['required', 'boolean'],
                    'do_you_have_erections_at_the_morning' => ['required', 'boolean'],
                    'how_many_per_week' => ['required_if:do_you_have_erections_at_the_morning,1', 'nullable', 'string'],

                    //////////////////////////////
                    'do_you_have_problems_getting_erections' => ['required', 'boolean'],
                    'since_when' => ['required_if:do_you_have_problems_getting_erections,1', 'nullable', 'string'],
                    'describe_your_erection_problem' => ['required_if:do_you_have_problems_getting_erections,1', 'nullable', 'string'],
                    'do_you_have_problems_maintaining_an_erection' => ['required', 'boolean'],
                    'do_you_take_any_natural_remedy_for_erectile_dysfunction' => ['required', 'boolean'],
                    'what_kind' => ['required_if:do_you_take_any_natural_remedy_for_erectile_dysfunction,1', 'nullable', 'string'],
                    'how_did_it_work_natural_remedy' => ['required_if:do_you_take_any_natural_remedy_for_erectile_dysfunction,1', 'nullable', 'string'],
                    'where_did_you_get_them' => ['required_if:do_you_take_any_natural_remedy_for_erectile_dysfunction,1', 'nullable', 'string'],
                    'has_medication_been_injected_for_dysfunction_erectile' => ['required', 'boolean'],
                    'how_many_times_have_injected' => ['required_if:has_medication_been_injected_for_dysfunction_erectile,1', 'nullable', 'string'],
                    'how_did_it_work' => ['required_if:has_medication_been_injected_for_dysfunction_erectile,1', 'nullable', 'string'],
                    'have_you_had_an_erection_longer_than_six_hours' => ['required', 'boolean'],
                    'when_you_had_a_six_hours_erection' => ['required_if:have_you_had_an_erection_longer_than_six_hours,1', 'nullable', 'string'],
                    'how_was_it_resolved' => ['required_if:have_you_had_an_erection_longer_than_six_hours,1', 'nullable', 'string'],
                    'did_you_get_medical_attention' => ['required_if:have_you_had_an_erection_longer_than_six_hours, 1', 'nullable', 'string'],
                    'do_you_suffer_from_penile_curvature' => ['required', 'boolean'],
                    'how_intense' => ['required_if:do_you_suffer_from_penile_curvature,1', 'nullable', 'string'],
                    'which_direction' => ['required_if:do_you_suffer_from_penile_curvature,1', 'nullable', 'string'],
                    'does_it_hurt' => ['required_if:do_you_suffer_from_penile_curvature,1', 'nullable', 'string'],
                    'does_it_prevent_intercourse' => ['required_if:do_you_suffer_from_penile_curvature,1', 'nullable', 'string'],
                    'has_prp_been_injected_for_erectile_dysfunction' => ['required', 'boolean'],
                    'have_you_received_stem_cell_treatment_for_erectile_dysfunction' => ['required', 'boolean'],
                    'hyrvrntwliwtfed' => ['required', 'boolean'],
                ]);
            }
        }

        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            $app =  Application::with('imageMany', 'medications')
            ->find($getData->id);
            $treatment = Session::get('treatment');

            $patient = Patient::select('sex')->find($app->patient_id);

            $app->smoke = $request->smoke;
            $app->smoke_cigars = $request->smoke_cigars;
            $app->smoke_years = $request->smoke_years;
            $app->stop_smoking = $request->stop_smoking;
            $app->when_stop_smoking = $request->when_stop_smoking;
            $app->alcohol = $request->alcohol;
            $app->volumen_alcohol = $request->volumen_alcohol;
            $app->recreative_drugs = $request->recreative_drugs;
            $app->total_recreative_drugs = $request->total_recreative_drugs;
            $app->intravenous_drugs = $request->intravenous_drugs;
            $app->description_intravenous_drugs = $request->description_intravenous_drugs;
            $app->fatigue = $request->fatigue;
            $app->trouble_breathe = $request->trouble_breathe;
            $app->asthma = $request->asthma;
            $app->bipap_cpap = $request->bipap_cpap;
            $app->exercise = $request->exercise;

            $app->hours_you_sleep_at_night = $request->hours_you_sleep_at_night;
            $app->do_you_take_sleeping_pills = $request->do_you_take_sleeping_pills;
            $app->do_you_suffer_from_anxiety_or_depression = $request->do_you_suffer_from_anxiety_or_depression;
            $app->do_you_take_pills_for_anxiety_or_depression = $request->do_you_take_pills_for_anxiety_or_depression;
            $app->do_you_feel_under_stress = $request->do_you_feel_under_stress;
            $app->do_you_have_erections_at_the_morning = $request->do_you_have_erections_at_the_morning;
            $app->how_many_per_week = $request->how_many_per_week;
            $app->do_you_have_problems_getting_erections = $request->do_you_have_problems_getting_erections;
            $app->since_when = $request->since_when;
            $app->describe_your_erection_problem = $request->describe_your_erection_problem;
            $app->do_you_have_problems_maintaining_an_erection = $request->do_you_have_problems_maintaining_an_erection;
            $app->do_you_take_any_natural_remedy_for_erectile_dysfunction = $request->do_you_take_any_natural_remedy_for_erectile_dysfunction;
            $app->what_kind = $request->what_kind;
            $app->how_did_it_work_natural_remedy = $request->how_did_it_work_natural_remedy;
            $app->where_did_you_get_them = $request->where_did_you_get_them;
            $app->has_medication_been_injected_for_dysfunction_erectile = $request->has_medication_been_injected_for_dysfunction_erectile;
            $app->how_many_times_have_injected = $request->how_many_times_have_injected;
            $app->how_did_it_work = $request->how_did_it_work;
            $app->have_you_had_an_erection_longer_than_six_hours = $request->have_you_had_an_erection_longer_than_six_hours;
            $app->when_you_had_a_six_hours_erection = $request->when_you_had_a_six_hours_erection;
            $app->how_was_it_resolved = $request->how_was_it_resolved;
            $app->did_you_get_medical_attention = $request->did_you_get_medical_attention;
            $app->do_you_suffer_from_penile_curvature = $request->do_you_suffer_from_penile_curvature;
            $app->how_intense = $request->how_intense;
            $app->which_direction = $request->which_direction;
            $app->does_it_hurt = $request->does_it_hurt;
            $app->does_it_prevent_intercourse = $request->does_it_prevent_intercourse;
            $app->has_prp_been_injected_for_erectile_dysfunction = $request->has_prp_been_injected_for_erectile_dysfunction;
            $app->have_you_received_stem_cell_treatment_for_erectile_dysfunction = $request->have_you_received_stem_cell_treatment_for_erectile_dysfunction;
            $app->hyrvrntwliwtfed = $request->hyrvrntwliwtfed;

            if ($app->save()) {
                $insert_exercise = [];
                for ($i = 0; $i < count($exercise_cadena); $i++) {
                    $insert_exercise[] = [
                        'application_id' => $app->id,
                        'type' => $exercise_cadena[$i]['exercise_type'],
                        'how_long' => $exercise_cadena[$i]['exercise_how_long'],
                        'how_frecuency' => $exercise_cadena[$i]['exercise_how_frecuent'],
                        'Hours_per_day' => $exercise_cadena[$i]['exercise_hours'],
                        'code' => $exercise_cadena[$i]['code'],
                    ];
                }
                $app->exercices()->delete();
                ExerciseApplication::insert($insert_exercise);


                if ($patient->sex != 'female') {
                        Session::forget('form_session');
                        $app->generalData = 1;
                        $app->servicesData = 1;
                        $app->healthData = 1;
                        $app->surgeyData = 1;
                        $app->medicalHistoryData = 1;
                        $app->medicalHistoryData = 1;
                        $app->gynecologicalData = 1;
                        Session::put('form_session', $app);
                        return redirect()->route('createReferenceData');

                } else {
                    Session::forget('form_session');
                    $app->generalData = 1;
                    $app->servicesData = 1;
                    $app->healthData = 1;
                    $app->surgeyData = 1;
                    $app->medicalHistoryData = 1;
                    Session::put('form_session', $app);
                    if ($treatment->service_id == 3 && $patient->sex == 'male') {
                        return redirect()->route('createReferenceData');
                    }
                    return redirect()->route('createGynecologicalData');
                }


            }
        } else {
            abort(404);
        }
    }

    public function createGynecologicalData()
    {
        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            if ($getData->generalData == 1 && $getData->servicesData == 1 && $getData->surgeyData == 1 && $getData->medicalHistoryData = 1 && $getData->medicalHistoryData = 1) {
                $treatment = Session::get('treatment');
                $app = Application::with('imageMany', 'medications', 'hormones', 'birthcontrol')->find($getData->id);
                return view('site.apps.gynecological-data', ['treatment' => $treatment, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postGynecologicalData(Request $request)
    {
        $birth_control_cadena = [];
        $collection_bc = new Collection();
        $code = time().uniqid(Str::random(30));
        if ($request->has('birthControl_type') || $request->has('birthControl_how_long')) {
            for ($i=0; $i < count($request->birthControl_type); $i++) {
                $birth_control_cadena[] = [
                    'birthControl_type' => $request->birthControl_type[$i],
                    'birthControl_how_long' => $request->birthControl_how_long[$i],
                    'code' => $code
                ];

                $collection_bc->push((object)[
                    'birthControl_type' => $request->birthControl_type[$i],
                    'birthControl_how_long' => $request->birthControl_how_long[$i],
                    'code' => $code
                ]);

            }
        }

        $hormone_cadena = [];
        $collectionHor = new Collection();

        if ($request->has('hormone_type') || $request->has('hormone_how_long')) {
            for ($i=0; $i < count($request->hormone_type); $i++) {
                $hormone_cadena[] = [
                    'hormone_type' => $request->hormone_type[$i],
                    'hormone_how_long' => $request->hormone_how_long[$i],
                    'code' => $code,
                ];

                $collectionHor->push((object)[
                    'hormone_type' => $request->hormone_type[$i],
                    'hormone_how_long' => $request->hormone_how_long[$i],
                    'code' => $code,
                ]);

            }
        }
        $request->merge(["birth_cadena" => $birth_control_cadena]);
        $request->merge(["birthCadena" => $collection_bc]);
        $request->merge(["hormone_cadena" => $hormone_cadena]);
        $request->merge(["hormoneCadena" => $collectionHor]);


        $validator = Validator::make($request->all(), [

            "last_menstrual_period" => "required|date",
            "bleeding_whas" => "required|in:normal,light,heavy,irregular",
            "have_you_been_pregnant" => "required|boolean",
            "how_many_times" => ['required_if:have_you_been_pregnant,1','nullable','string'],
            "c_section" => ['required_if:have_you_been_pregnant,1','nullable','string'], //boleano
            "birth_control" => "required|boolean",

            "birth_control" =>"required|boolean",
            "birthControl_how_long" => ['required_if:birth_control,1','array'],
            "birthControl_how_long.*" => ['required_if:birth_control,1','string'],
            "birthControl_type" => ['required_if:birth_control,1','array'],
            "birthControl_type.*" => ['required_if:birth_control,1','string'],

            "use_hormones" =>"required|boolean",
            "hormone_how_long" => ['required_if:use_hormones,1','array'],
            "hormone_how_long.*" => ['required_if:use_hormones,1','string'],
            "hormone_type" => ['required_if:use_hormones,1','array'],
            "hormone_type.*" => ['required_if:use_hormones,1','string'],

            "is_or_can_be_pregman" => "required|boolean",
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        if (Session::has('form_session')) {
            $getData = Session::get('form_session');

            $app = Application::find($getData->id);

            //return $app;
            $app->last_menstrual_period = $request->last_menstrual_period;
            $app->bleeding_whas = $request->bleeding_whas;
            $app->have_you_been_pregnant = $request->have_you_been_pregnant;
            $app->how_many_times = $request->how_many_times;
            $app->c_section = $request->c_section;
            $app->birth_control = $request->birth_control;
            $app->use_hormones = $request->use_hormones;
            $app->is_or_can_be_pregmant = $request->is_or_can_be_pregman;
            $treatment = Session::get('treatment');

            if ($app->save()) {
                Session::forget('form_session');
                $app->generalData = 1;
                $app->servicesData = 1;
                $app->healthData = 1;
                $app->surgeyData = 1;
                $app->medicalHistoryData = 1;
                $app->medicalHistoryData = 1;
                $app->gynecologicalData = 1;
                Session::put('form_session', $app);

                $insert_bControl = [];
                for ($i = 0; $i < count($birth_control_cadena); $i++) {
                    $insert_bControl[] = [
                        'application_id' => $app->id,
                        'type' => $birth_control_cadena[$i]['birthControl_type'],
                        'how_along_time' => $birth_control_cadena[$i]['birthControl_how_long'],
                        'code' => $birth_control_cadena[$i]['code'],
                    ];
                }
                $app->birthcontrol()->delete();
                BirthControlApplication::insert($insert_bControl);

                $insert_hormone = [];
                for ($i = 0; $i < count($hormone_cadena); $i++) {
                    $insert_hormone[] = [
                        'application_id' => $app->id,
                        'type' => $hormone_cadena[$i]['hormone_type'],
                        'how_along_time' => $hormone_cadena[$i]['hormone_how_long'],
                        'code' => $hormone_cadena[$i]['code'],
                    ];
                }
                $app->hormones()->delete();
                HormonesApplication::insert($insert_hormone);

                return redirect()->route('createReferenceData');
            }

        }
    }

    public function createReferenceData()
    {
        if (Session::has('form_session')) {

            $getData = Session::get('form_session');
            if ($getData->generalData == 1 && $getData->servicesData == 1 && $getData->surgeyData == 1 && $getData->medicalHistoryData = 1 == 1 && $getData->gynecologicalData  = 1) {
                $treatment = Session::get('treatment');
                $app = Application::with('imageMany', 'medications')->find($getData->id);
                return view('site.apps.reference-data', ['treatment' => $treatment, 'app' => $app]);
            } else {
                return 'not';
            }
        }
    }

    public function postReferenceData(Request $request)
    {
        if (Session::has('form_session')) {
            $getData = Session::get('form_session');
            $code = time().uniqid(Str::random(30));
            $app = Application::find($getData->id);
            $treatment = Session::get('treatment');


            if ($request->about_us_other == 1) {
                $this->validate($request, [
                    "about_us_description_other" => "required|string",
                ]);
                $app->about_us_other = $request->about_us_other;
                $app->about_us_description_other = $request->about_us_description_other;
            }
            if ($request->about_us_google == 1) {
                $app->about_us_google = $request->about_us_google;
            }
            if ($request->about_us_youtube == 1) {
                $app->about_us_youtube = $request->about_us_youtube;
            }
            if($request->about_us_facebook == 1)
            {
                $app->about_us_facebook = $request->about_us_facebook;
            }
            if($request->about_us_instagram == 1)
            {
                $app->about_us_instagram = $request->about_us_instagram;
            }
            if($request->about_us_twiter == 1)
            {
                $app->about_us_twiter = $request->about_us_twiter;
            }
            if($request->about_us_email == 1)
            {
                $app->about_us_email = $request->about_us_email;
            }
            if($request->about_us_radio == 1)
            {
                $app->about_us_radio = $request->about_us_radio;
            }
            if($request->about_us_forums == 1)
            {
                $app->about_us_forums = $request->about_us_forums;
            }
            if($request->about_us_friend == 1)
            {
                $this->validate($request, [
                    "friend_name" => "required|string",
                ]);
                $app->about_us_friend = $request->about_us_friend;
                $app->friend_name = $request->friend_name;
            }

            $lang = app()->getLocale();



            $treatment = Session::get('treatment');
            $assignment = [];

            $assignment_staff = Staff::whereHas
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
                    'assignToService' => function($q)
                    {
                        $q->first();
                    }
                ]
            )
            ->first();

            $newMessage = "A new application has been assigned to you";
            $response = [];
            if ($assignment_staff) {
                $assignment[] = [
                    'application_id' => $getData->id,
                    'staff_id' => $assignment_staff->id,
                    'ass_as' => $assignment_staff->specialties[0]->id,
                    'code' => $code,
                ];
                $assignment_staff->last_assignment = date("Y-m-d H:i:s");
                $assignment_staff->save();

                $date = Carbon::now();
                $hours = $date->format('g:i A');
                //$response = [];
                
                $response['staff_id'] = $assignment_staff->id;
                $response['message'] = $newMessage;
                $response['application_id'] = $getData->id;
                $response['timestamp'] = $this->datesLangTrait($date, 'en') . ", " .$hours;
                $response['timeDiff'] = $date->diffForHumans();
                $response['msgStrac'] = \Str::of("A new application has been assigned to you")->limit(20);

                $app->notification()->create([
                    'staff_id' => $assignment_staff->id,
                    'type' => 'New application',
                    'message' => $newMessage,
                    'code' => $code,
                ]);
                //send Email to coordintion
            }

            $other_staff = Staff::whereHas
            (
                
                'specialties', function($q)
                {
                   $q->where('specialties.id', '!=', 10);
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
                    'assignToService' => function($q)
                    {
                        $q->first();
                    }
                ]
            )
            ->get();

            if (count($other_staff) > 0) {
                foreach ($other_staff as $staff) {
                    $app->notification()->create([
                        'staff_id' => $staff->id,
                        'type' => 'New application',
                        'message' => 'Hay una nueva aplicación de ' .$treatment->service->service,
                        'code' => $code,
                    ]);
                    //send Email other staff
                }
            }

            $app->assignments()->sync($assignment);
            $app->is_complete = true;

            if ($app->save()) {
                $app->statusOne()->create(
                    [
                        'status_id' => 9,
                        'code' => $code
                    ]
                );
            }


            Session::forget('form_session');
            Session::forget('treatment');
            return redirect()->route('home')
            ->with(
                [
                    'sys-message' => '',
                    'icon' => 'success',
                    'msg' => Lang::get('Your application has been sent successfully'),
                    'data' => $response,
                ]
            );
        } else {
            abort(404);
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
            ->with('imageMany', 'medication')
            ->first();
            Session::forget('form_session');
            return response()->json(1);
        }
    }
    public function application()
    {
        return view
        (
            'staff.application-manager.list'
        );
    }
}
