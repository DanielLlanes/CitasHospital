<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Mail\NewAppEmail;
use App\Mail\WelcomeLetterEmail;
use App\Models\Partners\Partner;
use App\Models\Site\Application;
use App\Models\Site\BirthControlApplication;
use App\Models\Site\Country;
use App\Models\Site\ExerciseApplication;
use App\Models\Site\HormonesApplication;
use App\Models\Site\IllnsessApplication;
use App\Models\Site\MedicationApplication;
use App\Models\Site\State;
use App\Models\Site\SurgeryApplication;
use App\Models\Staff\Package;
use App\Models\Staff\Patient;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use App\Models\Staff\Staff;
use App\Models\Staff\Treatment;
use App\Traits\DatesLangTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ApiPartnersController extends Controller
{
    use DatesLangTrait;

    public function countries(Request $request, $code)
    {
        $countries = Country::where('active', 1)
        ->where("name",'like', "%".$request->search."%")
        ->select('id', "name as text")
        ->get();
        return $countries;
    }
    public function states(Request $request)
    {
        if ($request->has('id')) {
            $states = State::where('country_id', $request->id)
            ->select('id', "name as text")
            ->get();
            return $states;
        }
    }
    public function services(Request $request)
    {
        if (1 == 1) {
           $lang = 'es';
            $services = Service::where("service_$lang",'like', "%".$request->search."%")
            ->select('id', "service_$lang as text", 'need_images', 'qty_images')
            ->has('treatments')
            ->get();
            return $services; 
        }   
    }
    public function procedures(Request $request)
    {
        $lang = 'es';

        if ($request->has('id')) {
            $search = Procedure::whereHas(

                    'treatment', function($query) use ($request, $lang)
                    {
                        $query->where('service_id', $request->id)
                        ->select(
                            [
                                "id", "procedure_$lang as procedure"
                            ]
                        );
                    }

            )
            ->where("procedure_$lang",'like', "%".$request->search."%")
            ->select('id', "procedure_$lang AS text", "has_package as package")
            ->get();
        } else {
            $search = Procedure::where("procedure_$lang",'like', "%".$request->search."%")
            ->select('id', "procedure_$lang AS text")
            ->get();
        }
        return $search;
    }
    public function packages(Request $request)
    {
        $lang = 'es';

        if ($request->has('id')) {

           $package = Package::whereHas(
                'treatment', function($query) use ($request, $lang)
                {
                    $query->where('procedure_id', $request->id)
                    ->select(
                        [
                            "id", "package_$lang as package"
                        ]
                    );
                }
           )
           ->where("package_$lang",'like', "%".$request->key."%")
            ->select('id', "package_$lang AS text")
            ->get();
           } else {
                $package = Procedure::where("package_$lang",'like', "%".$request->key."%")
                ->select('id', "package_$lang AS text")
                ->get();
        }
        return $package;
    }
    public function checkData(Request $request)
    {  
        //return($request);
            $lang = 'es';
            if ($request->step == 0) {
                $exist = false;

                if ( $request->package == 0 ) { $exist = Treatment::where("procedure_id", $request->procedure)->first(); } 
                else { $exist = Treatment::where("procedure_id", $request->procedure)->where('package_id', $request->package)->first(); }

                if (!$exist) {
                    return response()->json(
                        [
                            'exist' => false,
                            'icon' => 'error',
                            'msg' => 'Este procedimiento no existe',
                            'reload' => false
                        ]
                    );
                }
                $patient = false;
                if ($request->has('email')) {
                    
                    $patient = Patient::where('email', $request->email)->first();
                }
                if (!$patient) {
                    $validator = Validator::make($request->all(), [
                        'treatmentBefore' => 'required|boolean',
                        'name' => 'required|string',
                        'sex' => 'required|string|',
                        'age' => 'required|numeric|between:18,99',
                        'dob' => 'required|date',
                        'phone' => ['unique:patients,phone', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                        'mobile' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                        'email' => 'required|max:255|email',
                        'address' => 'required',
                        'country_id' => 'required|integer',
                        'state_id' => 'required|integer',
                        'city' => 'required|string',
                        'zip' => 'required|string',
                        'ecn' => 'required|string',
                        'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'go' => '0',
                            'errors' => $validator->getMessageBag()->toArray()
                        ]);
                    }
                }
                    
            }
            if ($request->step == 1) {
                $need_images = Service::select('need_images', 'qty_images')->find($request->service);
                $validator = Validator::make($request->all(), [
                    'imagenes' => "required|array|min:" . $need_images->qty_images, 
                    'imagenes.*' => "required|image|mimes:jpeg,png,jpg"
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }
            }
            if ($request->step == 2) {
                $validator = Validator::make($request->all(), [
                    "mesure_sistem"     => 'required|in:I,M',
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
                    "razon_blood_thinners" => 'required_if:blood_thinners,1', 'string',

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
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }
            }

            if ($request->step == 3) {
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
                   return response()->json([
                     'success' => false,
                     'errors' => $validator->getMessageBag()->toArray()
                 ]);
                }
            }

            if ($request->step == 4) {
                $validator = Validator::make($request->all(), [
                    "addiction" => 'required|boolean',
                    "which_one_adiction" => 'required_if:addiction,1','string',
                    "high_lipid_levels" => 'required|boolean',
                    "date_high_lipid_levels" => 'required_if:high_lipid_levels,1','date',
                    "treatment_high_lipid_levels" => 'required_if:high_lipid_levels,1','string',
                    "arthritis" => 'required|boolean',
                    "date_arthritis" => 'required_if:arthritis,1','date',
                    "treatment_arthritis" => 'required_if:arthritis,1','string',
                    "cancer" => 'required|boolean',
                    "date_cancer" => 'required_if:cancer,1','date',
                    "treatment_cancer" => 'required_if:cancer,1','string',
                    "cholesterol" => 'required|boolean',
                    "date_cholesterol" => 'required_if:cholesterol,1','date',
                    "treatment_cholesterol" => 'required_if:cholesterol,1','string',
                    "triglycerides" => 'required|boolean',
                    "date_triglycerides" => 'required_if:triglycerides,1','date',
                    "treatment_triglycerides" => 'required_if:triglycerides,1','string',
                    "stroke" => 'required|boolean',
                    "date_stroke" => 'required_if:stroke,1','date',
                    "treatment_stroke" => 'required_if:stroke,1','string',
                    "diabetes" => 'required|boolean',
                    "date_diabetes" => 'required_if:diabetes,1','date',
                    "treatment_diabetes" => 'required_if:diabetes,1','string',
                    "coronary_artery_disease" => 'required|boolean',
                    "date_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
                    "treatment_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
                    "liver_disease" => 'required|boolean',
                    "date_liver_disease" => 'required_if:liver_disease,1','date',
                    "treatment_liver_disease" => 'required_if:liver_disease,1','string',
                    "lugn_disease" => 'required|boolean',
                    "date_lugn_disease" => 'required_if:lugn_disease,1','date',
                    "treatment_lugn_disease" => 'required_if:lugn_disease,1','string',
                    "renal_disease" => 'required|boolean',
                    "date_renal_disease" => 'required_if:renal_disease,1','date',
                    "treatment_renal_disease" => 'required_if:renal_disease,1','string',
                    "thyroid_disease" => 'required|boolean',
                    "date_thyroid_disease" => 'required_if:thyroid_disease,1','date',
                    "treatment_thyroid_disease" => 'required_if:thyroid_disease,1','string',
                    "hypertension" => 'required|boolean',
                    "date_hypertension" => 'required_if:hypertension,1','string',
                    "treatment_hypertension" => 'required_if:hypertension,1','string',
                    "any_other_illnesses" => 'required|boolean',

                    "illness" => ['required_if:any_other_illnesses,1','array'],
                    "illness.*" => ['required_if:any_other_illnesses,1','string'],
                    "diagnostic_date" => ['required_if:any_other_illnesses,1','array'],
                    "diagnostic_date.*" => ['required_if:any_other_illnesses,1','date'],
                    "treatment" => ['required_if:any_other_illnesses,1','array'],
                    "treatment.*" => ['required_if:any_other_illnesses,1','string'],
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }     
            }

            if ($request->step == 5) {

                if ($request->service != 3) {
                    $validator = Validator::make($request->all(), [
                        "smoke" => "required|boolean",
                        "cigars_smoke" => "required_if:smoke,1|nullable|integer",
                        "years_smoke" => "required_if:smoke,1|nullable|numeric",
                        "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                        "vape" => "required|boolean",
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

                        "exercise_type" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_type.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_long" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_how_long.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_frecuent.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_frecuent" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_hours.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_hours" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray()
                        ]);
                    }
                }

                if ($request->service == 3 && $request->sex == 'male') {
                    $validator = Validator::make($request->all(), [

                        "smoke" => "required|boolean",
                        "cigars_smoke" => "required_if:smoke,1|nullable|string",
                        "years_smoke" => "required_if:smoke,1|nullable|integer",
                        "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                        "vape" => "required|boolean",
                        "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                        "alcohol" => "required|boolean",
                        "volumen_alcohol" => [
                            ($request->alcohol == '1') ? 'string': null
                        ],

                        "recreative_drugs" => "required|boolean",
                        "total_recreative_drugs" => [
                            ($request->recreative_drugs == '1') ? 'string': null
                        ],

                        "intravenous_drugs" => [
                            ($request->recreative_drugs == '1') ? 'boolean': null,
                            ($request->recreative_drugs == '1') ? 'required': null
                        ],

                        "description_intravenous_drugs" => [
                            ($request->intravenous_drugs == '1') ? 'string': null
                        ],

                        "fatigue" => "required|boolean",
                        "trouble_breathe" => "required|boolean",
                        "asthma" => "required|boolean",
                        "bipap_cpap" => "required|boolean",
                        "exercise" => "required|boolean",

                        "exercise_type" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_type.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_long" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_how_long.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_frecuent.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_frecuent" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_hours.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_hours" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
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
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray()
                        ]);
                    }
                }

                if ($request->service == 3 && $request->sex == 'female') {
                    $validator = Validator::make($request->all(), [

                        "smoke" => "required|boolean",
                        "cigars_smoke" => "required_if:smoke,1|nullable|string",
                        "years_smoke" => "required_if:smoke,1|nullable|integer",
                        "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                        "vape" => "required|boolean",
                        "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                        "alcohol" => "required|boolean",
                        "volumen_alcohol" => [
                            ($request->alcohol == '1') ? 'string': null
                        ],

                        "recreative_drugs" => "required|boolean",
                        "total_recreative_drugs" => [
                            ($request->recreative_drugs == '1') ? 'string': null
                        ],

                        "intravenous_drugs" => [
                            ($request->recreative_drugs == '1') ? 'boolean': null,
                            ($request->recreative_drugs == '1') ? 'required': null
                        ],

                        "description_intravenous_drugs" => [
                            ($request->intravenous_drugs == '1') ? 'string': null
                        ],

                        "fatigue" => "required|boolean",
                        "trouble_breathe" => "required|boolean",
                        "asthma" => "required|boolean",
                        "bipap_cpap" => "required|boolean",
                        "exercise" => "required|boolean",

                        "exercise_type" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_type.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_long" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_how_long.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_frecuent.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_how_frecuent" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        "exercise_hours.*" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "string": null,
                        ],
                        "exercise_hours" => [
                            ($request->exercise == '1') ? "required": null,
                            ($request->exercise == '1') ? "array": null,
                        ],
                        ///////////////////////////////////////////////////////
                        "hours_you_sleep_at_night" => ['required', 'numeric'],

                        'do_you_take_sleeping_pills' => ['required', 'boolean'],
                        'do_you_suffer_from_anxiety_or_depression' => ['required', 'boolean'],
                        'do_you_take_pills_for_anxiety_or_depression' => ['required', 'boolean'],
                        'do_you_feel_under_stress' => ['required', 'boolean'],
                        'how_many_per_week' => ['required_if:do_you_have_erections_at_the_morning,1', 'nullable', 'string'],

                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray()
                        ]);
                    }
                }
            }

            if ($request->step == 6) {
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
                    return response()->json([
                        'success' => false,
                        'go' => '0',
                        'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }
            }

            $need_images = Service::select('need_images', 'qty_images')->find($request->service);
            return response()->json([
                'success' => true,
                "go" => '1',
                "images" => $need_images,
                "service" => $request->service,
                "gender" => $request->sex
            ]);     
    }
    public function getData(Request $request)
    {  

        $lang = 'es';
        $need_images = Service::select('need_images', 'qty_images')->find($request->service);
        return response()->json([
            'success' => true,
            "go" => '1',
            "images" => $need_images,
            "service" => $request->service,
            "gender" => $request->sex
        ]);
    }
    public function storeData(Request $request, $code)
    {
        //return $request;
        $partnerCode = $code;
        $lang = 'es';
        $exist = false;
        if ( $request->package == 0 ) { $exist = Treatment::where("procedure_id", $request->procedure)->first(); } 
        else { $exist = Treatment::where("procedure_id", $request->procedure)->where('package_id', $request->package)->first(); }
        $treatment = $exist;

        if (!$exist) {
            return response()->json(
                [
                    'exist' => false,
                    'icon' => 'error',
                    'msg' => 'Este procedimiento no existe',
                    'reload' => false
                ]
            );
        }
        $need_images = Service::select('need_images', 'qty_images')->find($request->service);
        $patient = Patient::where('email', $request->email)->first();

        if (!$patient) {
            $validator0 = Validator::make($request->all(), [
                'treatmentBefore' => 'required|boolean',
                'name' => 'required|string',
                'sex' => 'required|string|',
                'age' => 'required|numeric|between:18,99',
                'dob' => 'required|date',
                'phone' => ['unique:patients,phone', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'mobile' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'email' => 'required|max:255|email',
                'address' => 'required',
                'country_id' => 'required|integer',
                'state_id' => 'required|integer',
                'city' => 'required|string',
                'zip' => 'required|string',
                'ecn' => 'required|string',
                'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            ]);
        } else {
            $validator0 = Validator::make($request->all(), [
                'treatmentBefore' => 'nullable',
                'name' => 'nullable',
                'sex' => 'nullable|',
                'age' => 'nullable',
                'dob' => 'nullable',
                'phone' => ['nullable'],
                'mobile' => ['nullable'],
                'email' => 'nullable',
                'address' => 'nullable',
                'country_id' => 'nullable',
                'state_id' => 'nullable',
                'city' => 'nullable',
                'zip' => 'nullable',
                'ecn' => 'nullable',
                'ecp' => ['nullable'],
            ]);
        }
        if ($need_images->need_images == 1) {
            $validator1 = Validator::make($request->all(), [
                'imagenes' => "required|array|min:" . $need_images->qty_images, 
                'imagenes.*' => "required|image|mimes:jpeg,png,jpg"
            ]);
        } else {
            $validator1 = Validator::make($request->all(), [
                'imagenes' => "nullable", 
                'imagenes.*' => "nullable"
            ]);
        }

        $validator2 = Validator::make($request->all(), [
            "mesure_sistem"     => 'required|in:I,M',
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
            "razon_blood_thinners" => 'required_if:blood_thinners,1', 'string',

            "acid_reflux"   => 'required|in:rarely,occasionally,frequently,no',
            "penicilin"     => 'required|boolean',
            "drugs_sulfa"   => 'required|boolean',
            "iodine"        => 'required|boolean',
            "tape"          => 'required|boolean',
            "latex"         => 'required|boolean',
            "aspirin"       => 'required|boolean',
            "other_allergy" => 'sometimes|nullable|string',
            "describe_other_allergy" => 'sometimes|nullable|string',
        ]);

        $validator3 = Validator::make($request->all(), [
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

        $validator4 = Validator::make($request->all(), [

            "addiction" => 'required|boolean',
            "which_one_adiction" => 'required_if:addiction,1','string',
            "high_lipid_levels" => 'required|boolean',
            "date_high_lipid_levels" => 'required_if:high_lipid_levels,1','date',
            "treatment_high_lipid_levels" => 'required_if:high_lipid_levels,1','string',
            "arthritis" => 'required|boolean',
            "date_arthritis" => 'required_if:arthritis,1','date',
            "treatment_arthritis" => 'required_if:arthritis,1','string',
            "cancer" => 'required|boolean',
            "date_cancer" => 'required_if:cancer,1','date',
            "treatment_cancer" => 'required_if:cancer,1','string',
            "cholesterol" => 'required|boolean',
            "date_cholesterol" => 'required_if:cholesterol,1','date',
            "treatment_cholesterol" => 'required_if:cholesterol,1','string',
            "triglycerides" => 'required|boolean',
            "date_triglycerides" => 'required_if:triglycerides,1','date',
            "treatment_triglycerides" => 'required_if:triglycerides,1','string',
            "stroke" => 'required|boolean',
            "date_stroke" => 'required_if:stroke,1','date',
            "treatment_stroke" => 'required_if:stroke,1','string',
            "diabetes" => 'required|boolean',
            "date_diabetes" => 'required_if:diabetes,1','date',
            "treatment_diabetes" => 'required_if:diabetes,1','string',
            "coronary_artery_disease" => 'required|boolean',
            "date_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
            "treatment_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
            "liver_disease" => 'required|boolean',
            "date_liver_disease" => 'required_if:liver_disease,1','date',
            "treatment_liver_disease" => 'required_if:liver_disease,1','string',
            "lugn_disease" => 'required|boolean',
            "date_lugn_disease" => 'required_if:lugn_disease,1','date',
            "treatment_lugn_disease" => 'required_if:lugn_disease,1','string',
            "renal_disease" => 'required|boolean',
            "date_renal_disease" => 'required_if:renal_disease,1','date',
            "treatment_renal_disease" => 'required_if:renal_disease,1','string',
            "thyroid_disease" => 'required|boolean',
            "date_thyroid_disease" => 'required_if:thyroid_disease,1','date',
            "treatment_thyroid_disease" => 'required_if:thyroid_disease,1','string',
            "hypertension" => 'required|boolean',
            "date_hypertension" => 'required_if:hypertension,1','string',
            "treatment_hypertension" => 'required_if:hypertension,1','string',
            "any_other_illnesses" => 'required|boolean',

            "illness" => ['required_if:any_other_illnesses,1','array'],
            "illness.*" => ['required_if:any_other_illnesses,1','string'],
            "diagnostic_date" => ['required_if:any_other_illnesses,1','array'],
            "diagnostic_date.*" => ['required_if:any_other_illnesses,1','date'],
            "treatment" => ['required_if:any_other_illnesses,1','array'],
            "treatment.*" => ['required_if:any_other_illnesses,1','string'],
        ]);

        //if ($request->service != 3 && $request->sex != 'male') {
        if ($request->service != 3) {
            $validator5 = Validator::make($request->all(), [
                "smoke" => "required|boolean",
                "cigars_smoke" => "required_if:smoke,1|nullable|integer",
                "years_smoke" => "required_if:smoke,1|nullable|numeric",
                "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                "vape" => "required|boolean",
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
        }

        if ($request->service == 3 && $request->sex == 'male') {
            $validator5 = Validator::make($request->all(), [

                "smoke" => "required|boolean",
                "cigars_smoke" => "required_if:smoke,1|nullable|string",
                "years_smoke" => "required_if:smoke,1|nullable|integer",
                "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                "vape" => "required|boolean",
                "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                "alcohol" => "required|boolean",
                "volumen_alcohol" => [
                    ($request->alcohol == '1') ? 'string': null
                ],

                "recreative_drugs" => "required|boolean",
                "total_recreative_drugs" => [
                    ($request->recreative_drugs == '1') ? 'string': null
                ],

                "intravenous_drugs" => [
                    ($request->recreative_drugs == '1') ? 'boolean': null,
                    ($request->recreative_drugs == '1') ? 'required': null
                ],

                "description_intravenous_drugs" => [
                    ($request->intravenous_drugs == '1') ? 'string': null
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
                "exercise_hours.*" => ['required_if:exercise,1','numeric'],
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
        }

        if ($request->service == 3 && $request->sex == 'female') {
            $validator5 = Validator::make($request->all(), [

                "smoke" => "required|boolean",
                "cigars_smoke" => "required_if:smoke,1|nullable|string",
                "years_smoke" => "required_if:smoke,1|nullable|integer",
                "stop_smoking" => "required_if:smoke,1|nullable|boolean",
                "vape" => "required|boolean",
                "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
                "alcohol" => "required|boolean",
                "volumen_alcohol" => [
                    ($request->alcohol == '1') ? 'string': null
                ],

                "recreative_drugs" => "required|boolean",
                "total_recreative_drugs" => [
                    ($request->recreative_drugs == '1') ? 'string': null
                ],

                "intravenous_drugs" => [
                    ($request->recreative_drugs == '1') ? 'boolean': null,
                    ($request->recreative_drugs == '1') ? 'required': null
                ],

                "description_intravenous_drugs" => [
                    ($request->intravenous_drugs == '1') ? 'string': null
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
                "exercise_hours.*" => ['required_if:exercise,1','numeric'],
                "exercise_hours" => ['required_if:exercise,1','array'],
                ///////////////////////////////////////////////////////
                "hours_you_sleep_at_night" => ['required', 'numeric'],

                'do_you_take_sleeping_pills' => ['required', 'boolean'],
                'do_you_suffer_from_anxiety_or_depression' => ['required', 'boolean'],
                'do_you_take_pills_for_anxiety_or_depression' => ['required', 'boolean'],
                'do_you_feel_under_stress' => ['required', 'boolean'],
                'how_many_per_week' => ['required_if:do_you_have_erections_at_the_morning,1', 'nullable', 'string'],
            ]);
        }

        if ($request->sex == 'female') {
            $validator6 = Validator::make($request->all(), [
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
        }

        if ($request->sex == 'male') {

            $validator6 = Validator::make($request->all(), [
                "last_menstrual_period" => "nullable",
                "bleeding_whas" => "nullable",
                "have_you_been_pregnant" => "nullable",
                "how_many_times" => 'nullable',
                "c_section" => 'nullable',
                "birth_control" => "nullable",

                "birth_control" =>"nullable",
                "birthControl_how_long" => 'nullable',
                "birthControl_how_long.*" => 'nullable',
                "birthControl_type" => 'nullable',
                "birthControl_type.*" => 'nullable',

                "use_hormones" =>"nullable",
                "hormone_how_long" => 'nullable',
                "hormone_how_long.*" => 'nullable',
                "hormone_type" => 'nullable',
                "hormone_type.*" => 'nullable',

                "is_or_can_be_pregman" => "nullable",
            ]);
        }

        if ($validator0->fails() ||
            $validator1->fails() ||
            $validator2->fails() ||
            $validator3->fails() ||
            $validator4->fails() ||
            $validator5->fails() ||
            $validator6->fails() ) {
                $messages = array_merge_recursive(
                    $validator0->messages()->toArray(), 
                    $validator1->messages()->toArray(), 
                    $validator2->messages()->toArray(),
                    $validator3->messages()->toArray(),
                    $validator4->messages()->toArray(),
                    $validator5->messages()->toArray(),
                    $validator6->messages()->toArray(),
                );
            $bag = new MessageBag($messages);
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $bag
            ]);
        }
        
        $unHashPassword = Str::random(8);
        if (!$patient) {
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
            $patient->lang = 'es';
            $patient->password = Hash::make($unHashPassword);
            $patient->code = getCode();
            $patient->save();
        }

        $app = new Application;

        if (!is_null($request->describe_other_allergy)) {
            $otherAlergies = null;
        } else {
            $otherAlergies = 1;
        }

        $app->temp_code = Str::random(10);
        $app->patient_id = $patient->id;

        $app->temp_code = Str::random(10);
        $app->patient_id = $patient->id;
        $app->treatment_id = $treatment->id;

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
        $app->other_allergy = (is_null($request->other_allergy)? null:$otherAlergies );
        $app->describe_other_allergy = (is_null($request->describe_other_allergy)? null:$request->describe_other_allergy );

        $app->if_have_surgeries = $request->previus_surgery;

        $app->addiction = $request->addiction;
        $app->which_one_adiction = $request->which_one_adiction;
        $app->high_lipid_levels = $request->high_lipid_levels;
        $app->date_high_lipd_levels = $request->date_high_lipid_levels;
        $app->high_lipid_levels_treatment = $request->high_lipid_levels_treatment;
        $app->cancer = $request->cancer;
        $app->date_cancer = $request->date_cancer;
        $app->cancer_treatment = $request->treatment_cancer;
        $app->arthritis = $request->arthritis;
        $app->date_arthritis = $request->date_arthritis;
        $app->arthritis_treatment = $request->treatment_arthritis;
        $app->cholesterol = $request->cholesterol;
        $app->date_cholesterol = $request->date_cholesterol;
        $app->cholesterol_treatment = $request->treatment_cholesterol;
        $app->triglycerides = $request->triglycerides;
        $app->date_triglycerides = $request->date_triglycerides;
        $app->triglycerides_treatment = $request->treatment_triglycerides;
        $app->disease_stroke = $request->stroke;
        $app->date_disease_stroke = $request->date_stroke;
        $app->disease_stroke_treatment = $request->treatment_stroke;
        $app->diabetes = $request->diabetes;
        $app->date_diabetes = $request->date_diabetes;
        $app->diabetes_treatment = $request->treatment_diabetes;
        $app->coronary_artery_disease = $request->coronary_artery_disease;
        $app->date_coronary_artery_disease = $request->date_coronary_artery_disease;
        $app->coronary_artery_disease_treatment = $request->treatment_coronary_artery_disease;
        $app->disease_liver = $request->liver_disease;
        $app->date_disease_liver = $request->date_liver_disease;
        $app->disease_liver_treatment = $request->treatment_liver_disease;
        $app->disease_lung = $request->lugn_disease;
        $app->date_disease_lung = $request->date_lugn_disease;
        $app->disease_lung_treatment = $request->treatment_lugn_disease;
        $app->disease_renal = $request->renal_disease;
        $app->date_disease_renal = $request->date_renal_disease;
        $app->disease_renal_treatment = $request->treatment_renal_disease;
        $app->disease_thyroid = $request->thyroid_disease;
        $app->date_disease_thyroid = $request->date_thyroid_disease;
        $app->disease_thyroid_treatment = $request->treatment_thyroid_disease;
        $app->ypertension = $request->hypertension;
        $app->hypertension = $request->date_hypertension;
        $app->hypertension_treatment = $request->treatment_hypertension;
        $app->disease_other = $request->any_other_illnesses;

        $app->smoke = $request->smoke;
        $app->smoke_cigars = $request->cigars_smoke;
        $app->smoke_years = $request->years_smoke;
        $app->stop_smoking = $request->stop_smoking;
        $app->when_stop_smoking = $request->when_stop_smoking;
        $app->alcohol = $request->alcohol;
        $app->vape = $request->vape;
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


        $app->last_menstrual_period = $request->last_menstrual_period;
        $app->bleeding_whas = $request->bleeding_whas;
                    
        $app->have_you_been_pregnant = $request->have_you_been_pregnant;
        $app->how_many_times = $request->how_many_times;
        $app->c_section = $request->c_section;
        $app->birth_control = $request->birth_control;
        $app->use_hormones = $request->use_hormones;
        $app->is_or_can_be_pregmant = $request->is_or_can_be_pregman;

        $medication_cadena = [];
        if ($request->has('medication_name') || $request->has('medication_reason') || $request->has('medication_dosage') || $request->has('medication_frecuency')) {
            for ($i=0; $i < count($request->medication_name); $i++) {
                $medication_cadena[] = [
                'medication_name' => $request->medication_name[$i],
                'medication_reason' => $request->medication_reason[$i],
                'medication_dosage' => $request->medication_dosage[$i],
                'medication_frecuency' => $request->medication_frecuency[$i],
                'code' => getCode(),
                ];
            }
        }
        $surgey_cadena = [];
        if ($request->has('surgey_type') || $request->has('surgey_name') || $request->has('surgey_age') || $request->has('surgey_year') || $request->has('surgey_complications')) {
            for ($i=0; $i < count($request->surgey_type); $i++) {
                $surgey_cadena[] = [
                    'surgey_type' => $request->surgey_type[$i],
                    'surgey_name' => $request->surgey_name[$i],
                    'surgey_age' => $request->surgey_age[$i],
                    'surgey_year' => $request->surgey_year[$i],
                    'surgey_complications' => $request->surgey_complications[$i],
                    'code' => getCode(),
                ];
            }
        }
        $illness_cadena = [];
        if ($request->has('illness') || $request->has('diagnostic_date') || $request->has('treatment')) {
            for ($i=0; $i < count($request->illness); $i++) {
                $illness_cadena[] = [
                    'illness' => $request->illness[$i],
                    'diagnostic_date' => $request->diagnostic_date[$i],
                    'treatment' => $request->treatment[$i],
                    'code' => getCode()
                ];
            }
        }
        $exercise_cadena = [];
        if ($request->has('exercise_type') || $request->has('exercise_how_long') || $request->has('exercise_how_frecuen') || $request->has('exercise_hours')) {
            for ($i=0; $i < count($request->exercise_type); $i++) {
                $exercise_cadena[] = [
                'exercise_type' => $request->exercise_type[$i],
                'exercise_how_long' => $request->exercise_how_long[$i],
                'exercise_how_frecuent' => $request->exercise_how_frecuent[$i],
                'exercise_hours' => $request->exercise_hours[$i],
                'code' => getCode(),
                ];
            }
        }
        $birth_control_cadena = [];
        if ($request->has('birthControl_type') || $request->has('birthControl_how_long')) {
            for ($i=0; $i < count($request->birthControl_type); $i++) {
                $birth_control_cadena[] = [
                'birthControl_type' => $request->birthControl_type[$i],
                'birthControl_how_long' => $request->birthControl_how_long[$i],
                'code' => getCode()
                ];
            }
        }
        $hormone_cadena = [];
        if ($request->has('hormone_type') || $request->has('hormone_how_long')) {
            for ($i=0; $i < count($request->hormone_type); $i++) {
                $hormone_cadena[] = [
                'hormone_type' => $request->hormone_type[$i],
                'hormone_how_long' => $request->hormone_how_long[$i],
                'code' => getCode(),
                ];
            }
        }

        $partnerExist = Partner::where('code', $partnerCode)->first();
        if (!$partnerExist) {
            return response()->json([
                'success' => false,
                "go" => '0',
                "reload" => true,
                "icon" => 'error',
                "msg" => "Undefined error"
            ]);
        }
        $partnerExist = Partner::where('code', $code)->first();
        if (!$partnerExist) {
            return response()->json([
                'success' => false,
                "go" => '0',
                "reload" => true,
                "icon" => 'error',
                "msg" => "Undefined error"
            ]);
        }
        if ($app->save()) {
            $insert_medications = [];
            $insert_surgeries = [];
            $insert_illnesses = [];
            $insert_exercise = [];
            $insert_bControl = [];
            $insert_hormone = [];

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
            for ($i = 0; $i < count($illness_cadena); $i++) {
                $insert_illnesses[] = [
                'application_id' => $app->id,
                'illness' => $illness_cadena[$i]['illness'],
                'diagnostic_date' => $illness_cadena[$i]['diagnostic_date'],
                'treatment' => $illness_cadena[$i]['treatment'],
                'code' => $illness_cadena[$i]['code']
                ];
            }
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
            for ($i = 0; $i < count($birth_control_cadena); $i++) {
                $insert_bControl[] = [
                'application_id' => $app->id,
                'type' => $birth_control_cadena[$i]['birthControl_type'],
                'how_along_time' => $birth_control_cadena[$i]['birthControl_how_long'],
                'code' => $birth_control_cadena[$i]['code'],
                ];
            }
            for ($i = 0; $i < count($hormone_cadena); $i++) {
                $insert_hormone[] = [
                'application_id' => $app->id,
                'type' => $hormone_cadena[$i]['hormone_type'],
                'how_along_time' => $hormone_cadena[$i]['hormone_how_long'],
                'code' => $hormone_cadena[$i]['code'],
                ];
            }
            $partnerAttach = array(
                "application_id" => $app->id,
                "partner_id" => $partnerExist->id,
                "code" => getCode()
            );
            $app->partners()->attach([$partnerAttach]);
            $app->medications()->delete();
            MedicationApplication::insert($insert_medications);
            $app->surgeries()->delete();
            SurgeryApplication::insert($insert_surgeries);
            $app->illnessess()->delete();
            IllnsessApplication::insert($insert_illnesses);
            $app->exercices()->delete();
            ExerciseApplication::insert($insert_exercise);
            $app->birthcontrol()->delete();
            BirthControlApplication::insert($insert_bControl);
            $app->hormones()->delete();
            HormonesApplication::insert($insert_hormone);

            if ($need_images->need_images == 1) {
                if ($request->has('images')) {
                    foreach ($images as $key => $image) {
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

                        $image = $app->imageMany()->create(["code" => getCode(), 'image' => $image, 'title' => null, 'order' => $key]);
                    }
                }
            }
            $getStaffEmails = getStaffEmails($request);
            $assignment_staff = (count($getStaffEmails) > 0) ? $getStaffEmails[0]:'';  
            $other_staff = getOthersEmails($request);

            $treatment = Treatment::where("procedure_id", $request->procedure)
                ->where('package_id', $request->package)
                ->with([
                    'service' => function($query) use ($lang) {
                        $query->select('id', 'brand_id', "active", "service_$lang as service", "need_images", "qty_images")
                        ->with('brand');
                     },
                    'procedure' => function($query) use ($lang) {
                        $query->select('id', "active", "has_package", "service_id", "procedure_$lang as procedure");
                     },
                    'package' => function($query) use ($lang) {
                        $query->select('id', "active", "package_$lang as package");
                     }
                ])
            ->first();

            $toEmail = new Collection;
            $notifications = new Collection;
            $newMessage = "A new application has been assigned to you";
            $response = [];
            $assignment = [];
            if ($assignment_staff) {
                $assignment[] = [
                    'application_id' => $app->id,
                    'staff_id' => $assignment_staff->id,
                    'ass_as' => $assignment_staff->specialties[0]->id,
                    'code' => getCode(),
                ];
                $assignment_staff->last_assignment = date("Y-m-d H:i:s");
                $assignment_staff->save();

                $date = Carbon::now();
                $hours = $date->format('g:i A');
                $response = [];
                $notifications = new Collection;
                $response['staff_id'] = $assignment_staff->id;
                $response['message'] = $newMessage;
                $response['application_id'] = $app->id;
                $response['timestamp'] = $this->datesLangTrait($date, 'en') . ", " .$hours;
                $response['timeDiff'] = $date->diffForHumans();
                $response['msgStrac'] = \Str::of("A new application has been assigned to you")->limit(20);

                $notifications->push((object)[
                    'staff_id' => $assignment_staff->id,
                    'message' => $newMessage,
                    'application_id' => $app->id,
                    'timestamp' => $this->datesLangTrait($date, 'en') . ", " .$hours,
                    'timeDiff' => $date->diffForHumans(),
                    'msgStrac' => \Str::of("A new application has been assigned to you")->limit(20),
                    'url' => route('staff.applications.show', ["id" => $app->id]),
                ]);
                $app->notification()->create([
                    'staff_id' => $assignment_staff->id,
                    'type' => 'New application',
                    'message' => $newMessage,
                    'code' => getCode(),
                ]);
                $toEmail->push((object)[
                    'staff_name' => $assignment_staff->name,
                    'staff_email' => $assignment_staff->email,
                    'app_id' => $app->id,
                    'treatment' => $treatment,
                    "patient" => $patient,
                    "subject" => $newMessage,
                ]);
            }
            if (count($other_staff) > 0) {
                foreach ($other_staff as $staff) {
                    $app->notification()->create([
                        'staff_id' => $staff->id,
                        'type' => 'New application',
                        'message' => 'Hay una nueva aplicación de ' .$treatment->service->service_es,
                        'code' => getCode(),
                    ]);

                    $toEmail->push((object)[
                        'staff_name' => $staff->name,
                        'staff_email' => $staff->email,
                        'app_id' => $app->id,
                        'treatment' => $treatment,
                        "patient" => $patient,
                        "subject" => $newMessage,
                    ]);
                    $date = Carbon::now();
                    $hours = $date->format('g:i A');
                    $notifications->push((object)[
                        'staff_id' => $staff->id,
                        'message' => 'Hay una nueva aplicación de ' .$treatment->service->service_es,
                        'application_id' => $app->id,
                        'timestamp' => $this->datesLangTrait($date, 'en') . ", " .$hours,
                        'timeDiff' => $date->diffForHumans(),
                        'msgStrac' => \Str::of("Hay una nueva aplicación")->limit(20),
                        'url' => route('staff.applications.show', ["id" => $app->id]),
                    ]);
                }
            }
            foreach ($toEmail as $key => $data) {
                Mail::to($data->staff_email)
                ->send(
                    new NewAppEmail($data)
                );
            }
            Mail::send(new WelcomeLetterEmail($patient, $treatment, $assignment_staff));

            $app->assignments()->sync($assignment);
            $app->is_complete = true;
        } //

        if ($app->save()) {
            $app->statusOne()->create(
                [
                    'status_id' => 9,
                    'code' => getCode()
                ]
            );
        }

        return response()->json([
            'success' => true,
            'terminado' => true,
        ]);
    }
}
