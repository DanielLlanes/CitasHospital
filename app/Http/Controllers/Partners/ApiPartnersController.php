<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\Site\Country;
use App\Models\Site\State;
use App\Models\Staff\Package;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use App\Models\Staff\Treatment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiPartnersController extends Controller
{
    public function countries(Request $request)
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
        $lang = 'es';
        $services = Service::where("service_$lang",'like', "%".$request->search."%")
        ->select('id', "service_$lang as text", 'need_images', 'qty_images')
        ->has('treatments')
        ->get();
        return $services;  
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
        $lang = 'es';
        Session::put('treatment', "holis");
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

            // $validator = Validator::make($request->all(), [
            //     'treatmentBefore' => 'required|boolean',
            //     'name' => 'required|string',
            //     'sex' => 'required|string|',
            //     'age' => 'required|numeric|between:18,99',
            //     'dob' => 'required|date',
            //     'phone' => ['unique:patients,phone', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            //     'mobile' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            //     'email' => 'required|max:255|email|unique:patients,email',
            //     'address' => 'required',
            //     'country_id' => 'required|integer',
            //     'state_id' => 'required|integer',
            //     'city' => 'required|string',
            //     'zip' => 'required|string',
            //     'ecn' => 'required|string',
            //     'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'success' => false,
            //         'go' => '0',
            //         'errors' => $validator->getMessageBag()->toArray()
            //     ]);
            // }
        }
        if ($request->step == 1) {
            $need_images = Service::select('need_images', 'qty_images')->find($request->service);

            
            // $validator = Validator::make($request->all(), [
            //     'imagenes' => "required|array|min:" . $need_images->qty_images, 
            //     'imagenes.*' => "required|image|mimes:jpeg,png,jpg"
            // ]);
            // if ($validator->fails()) {
            //     return response()->json([
            //         'success' => false,
            //         'errors' => $validator->getMessageBag()->toArray()
            //     ]);
            // }
        }
        if ($request->step == 2) {
            // $validator = Validator::make($request->all(), [
            //     "mesure_sistem"     => 'required|in:I,M',
            //     "max_weigh"         => 'required|numeric',
            //     "weight"            => 'required|numeric',
            //     "height"            => 'required|numeric',
            //     "imc"               => 'required|numeric',
            //     "take_medication"   => 'required|boolean',

            //     "medication_name" => ['required_if:take_medication,1','array'],
            //     "medication_name.*" => ['required_if:take_medication,1','string'],
            //     "medication_reason" => ['required_if:take_medication,1','array'],
            //     "medication_reason.*" => ['required_if:take_medication,1','string'],
            //     "medication_dosage" => ['required_if:take_medication,1','array'],
            //     "medication_dosage.*" => ['required_if:take_medication,1','string'],
            //     "medication_frecuency" => ['required_if:take_medication,1','array'],
            //     "medication_frecuency.*" => ['required_if:take_medication,1','string'],

            //     "blood_thinners"    => 'required|boolean',
            //     "razon_blood_thinners" => 'required_if:blood_thinners,1', 'string',

            //     "acid_reflux"   => 'required|in:rarely,occasionally,frequently,no',
            //     "penicilin"     => 'required|boolean',
            //     "drugs_sulfa"   => 'required|boolean',
            //     "iodine"        => 'required|boolean',
            //     "tape"          => 'required|boolean',
            //     "latex"         => 'required|boolean',
            //     "aspirin"       => 'required|boolean',
            //     "other_allergy" => 'sometimes|nullable|string'
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'success' => false,
            //         'errors' => $validator->getMessageBag()->toArray()
            //     ]);
            // }
        }

        if ($request->step == 3) {
            // $validator = Validator::make($request->all(), [
            //     "previus_surgery"   => 'required|boolean',

            //     "surgey_type" => ['required_if:take_medication,1','array'],
            //     "surgey_type.*" => ['required_if:take_medication,1','string'],
            //     "surgey_name" => ['required_if:take_medication,1','array'],
            //     "surgey_name.*" => ['required_if:take_medication,1','string'],
            //     "surgey_age" => ['required_if:take_medication,1','array'],
            //     "surgey_age.*" => ['required_if:take_medication,1','numeric'],
            //     "surgey_year" =>['required_if:take_medication,1','array'],
            //     "surgey_year.*" => [
            //         'required_if:take_medication,1',
            //         'numeric',
            //         'min:' . (date("Y") - 100),
            //         'max:' . date("Y")
            //     ],
            //     "surgey_complications" =>['required_if:take_medication,1','array'],
            //     "surgey_complications.*" => ['required_if:take_medication,1','string']
            // ]);

            // if ($validator->fails()) {
            //    return response()->json([
            //      'success' => false,
            //      'errors' => $validator->getMessageBag()->toArray()
            //  ]);
            // }
        }

        if ($request->step == 4) {
            //return $request;
            // $validator = Validator::make($request->all(), [

            //     "addiction" => 'required|boolean',
            //     "which_one_adiction" => 'required_if:addiction,1','string',
            //     "high_lipid_levels" => 'required|boolean',
            //     "date_high_lipid_levels" => 'required_if:high_lipid_levels,1','date',
            //     "treatment_high_lipid_levels" => 'required_if:high_lipid_levels,1','string',
            //     "arthritis" => 'required|boolean',
            //     "date_arthritis" => 'required_if:arthritis,1','date',
            //     "treatment_arthritis" => 'required_if:arthritis,1','string',
            //     "cancer" => 'required|boolean',
            //     "date_cancer" => 'required_if:cancer,1','date',
            //     "treatment_cancer" => 'required_if:cancer,1','string',
            //     "cholesterol" => 'required|boolean',
            //     "date_cholesterol" => 'required_if:cholesterol,1','date',
            //     "treatment_cholesterol" => 'required_if:cholesterol,1','string',
            //     "triglycerides" => 'required|boolean',
            //     "date_triglycerides" => 'required_if:triglycerides,1','date',
            //     "treatment_triglycerides" => 'required_if:triglycerides,1','string',
            //     "stroke" => 'required|boolean',
            //     "date_stroke" => 'required_if:stroke,1','date',
            //     "treatment_stroke" => 'required_if:stroke,1','string',
            //     "diabetes" => 'required|boolean',
            //     "date_diabetes" => 'required_if:diabetes,1','date',
            //     "treatment_diabetes" => 'required_if:diabetes,1','string',
            //     "coronary_artery_disease" => 'required|boolean',
            //     "date_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
            //     "treatment_coronary_artery_disease" => 'required_if:coronary_artery_disease,1','string',
            //     "liver_disease" => 'required|boolean',
            //     "date_liver_disease" => 'required_if:liver_disease,1','date',
            //     "treatment_liver_disease" => 'required_if:liver_disease,1','string',
            //     "lugn_disease" => 'required|boolean',
            //     "date_lugn_disease" => 'required_if:lugn_disease,1','date',
            //     "treatment_lugn_disease" => 'required_if:lugn_disease,1','string',
            //     "renal_disease" => 'required|boolean',
            //     "date_renal_disease" => 'required_if:renal_disease,1','date',
            //     "treatment_renal_disease" => 'required_if:renal_disease,1','string',
            //     "thyroid_disease" => 'required|boolean',
            //     "date_thyroid_disease" => 'required_if:thyroid_disease,1','date',
            //     "treatment_thyroid_disease" => 'required_if:thyroid_disease,1','string',
            //     "hypertension" => 'required|boolean',
            //     "date_hypertension" => 'required_if:hypertension,1','string',
            //     "treatment_hypertension" => 'required_if:hypertension,1','string',
            //     "any_other_illnesses" => 'required|boolean',

            //     "illness" => ['required_if:any_other_illnesses,1','array'],
            //     "illness.*" => ['required_if:any_other_illnesses,1','string'],
            //     "diagnostic_date" => ['required_if:any_other_illnesses,1','array'],
            //     "diagnostic_date.*" => ['required_if:any_other_illnesses,1','date'],
            //     "treatment" => ['required_if:any_other_illnesses,1','array'],
            //     "treatment.*" => ['required_if:any_other_illnesses,1','string'],
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'success' => false,
            //         'errors' => $validator->getMessageBag()->toArray()
            //     ]);
            // }     
        }

        if ($request->step == 5) {

            // if ($request->service != 3 && $request->sex != 'male') {
            //     $validator = Validator::make($request->all(), [
            //         "smoke" => "required|boolean",
            //         "cigars_smoke" => "required_if:smoke,1|nullable|integer",
            //         "years_smoke" => "required_if:smoke,1|nullable|numeric",
            //         "stop_smoking" => "required_if:smoke,1|nullable|boolean",
            //         "vape" => "required|boolean",
            //         "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
            //         "alcohol" => "required|boolean",
            //         "volumen_alcohol" => [
            //             ($request->alcohol == "1") ? "string":null,
            //         ],


            //         "recreative_drugs" => "required|boolean",
            //         "total_recreative_drugs" => [
            //             ($request->recreative_drugs == '1') ? 'string':null,
            //         ],

            //         "intravenous_drugs" => "required_if:recreative_drugs,1|boolean",
            //         "description_intravenous_drugs" => [
            //             ($request->intravenous_drugs == '1') ? 'string':null,
            //         ],

            //         "fatigue" => "required|boolean",
            //         "trouble_breathe" => "required|boolean",
            //         "asthma" => "required|boolean",
            //         "bipap_cpap" => "required|boolean",
            //         "exercise" => "required|boolean",

            //         "exercise_type" => ['required_if:exercise,1','array'],
            //         "exercise_type.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_long" => ['required_if:exercise,1','array'],
            //         "exercise_how_long.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_frecuent.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_frecuent" => ['required_if:exercise,1','array'],
            //         "exercise_hours.*" => ['required_if:exercise,1','string'],
            //         "exercise_hours" => ['required_if:exercise,1','array'],
            //     ]);

            //     if ($validator->fails()) {
            //         return response()->json([
            //             'success' => false,
            //             'errors' => $validator->getMessageBag()->toArray()
            //         ]);
            //     }
            // }

            // if ($request->service == 3 && $request->sex == 'male') {
            //     $validator = Validator::make($request->all(), [

            //         "smoke" => "required|boolean",
            //         "cigars_smoke" => "required_if:smoke,1|nullable|string",
            //         "years_smoke" => "required_if:smoke,1|nullable|integer",
            //         "stop_smoking" => "required_if:smoke,1|nullable|boolean",
            //         "vape" => "required|boolean",
            //         "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
            //         "alcohol" => "required|boolean",
            //         "volumen_alcohol" => [
            //             ($request->alcohol == '1') ? 'string': null
            //         ],

            //         "recreative_drugs" => "required|boolean",
            //         "total_recreative_drugs" => [
            //             ($request->recreative_drugs == '1') ? 'string': null
            //         ],

            //         "intravenous_drugs" => [
            //             ($request->recreative_drugs == '1') ? 'boolean': null,
            //             ($request->recreative_drugs == '1') ? 'required': null
            //         ],

            //         "description_intravenous_drugs" => [
            //             ($request->intravenous_drugs == '1') ? 'string': null
            //         ],

            //         "fatigue" => "required|boolean",
            //         "trouble_breathe" => "required|boolean",
            //         "asthma" => "required|boolean",
            //         "bipap_cpap" => "required|boolean",
            //         "exercise" => "required|boolean",

            //         "exercise_type" => ['required_if:exercise,1','array'],
            //         "exercise_type.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_long" => ['required_if:exercise,1','array'],
            //         "exercise_how_long.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_frecuent.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_frecuent" => ['required_if:exercise,1','array'],
            //         "exercise_hours.*" => ['required_if:exercise,1','numeric'],
            //         "exercise_hours" => ['required_if:exercise,1','array'],
            //         ///////////////////////////////////////////////////////
            //         "hours_you_sleep_at_night" => ['required', 'numeric'],
            //         'do_you_take_sleeping_pills' => ['required', 'boolean'],
            //         'do_you_suffer_from_anxiety_or_depression' => ['required', 'boolean'],
            //         'do_you_take_pills_for_anxiety_or_depression' => ['required', 'boolean'],
            //         'do_you_feel_under_stress' => ['required', 'boolean'],

            //         ///////////////////////////////////////////////////////
            //         "do_you_have_erections_at_the_morning" => ['required','boolean'],
            //         "how_many_per_week" => [
            //             ($request->do_you_have_erections_at_the_morning == '1') ? 'string':null,
            //             ($request->do_you_have_erections_at_the_morning == '1') ? 'required':null,
            //         ],
            //         "do_you_have_problems_getting_erections" => ['required','boolean'],
            //         "since_when" => [
            //             ($request->do_you_have_problems_getting_erections == '1') ? 'string':null,
            //             ($request->do_you_have_problems_getting_erections == '1') ? 'required':null,
            //         ],
            //         "describe_your_erection_problem" => [
            //             ($request->describe_your_erection_problem == '1') ? 'string':null,
            //             ($request->describe_your_erection_problem == '1') ? 'required':null,
            //         ],
            //         "do_you_have_problems_maintaining_an_erection" => ['required','boolean'],
            //         "do_you_take_any_natural_remedy_for_erectile_dysfunction" => ['required','boolean'],
            //         "what_kind" => [
            //             ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'string':null,
            //             ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'required':null,
            //         ],
            //         "how_did_it_work_natural_remedy" => [
            //             ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'string':null,
            //             ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'required':null,
            //         ],
            //         "where_did_you_get_them" => [
            //             ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'string':null,
            //             ($request->do_you_take_any_natural_remedy_for_erectile_dysfunction == '1') ? 'required':null,
            //         ],
            //         "has_medication_been_injected_for_dysfunction_erectile" => ['required','boolean'],
            //         "how_many_times_have_injected" => [
            //             ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'string':null,
            //             ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'required':null,
            //         ],
            //         "how_did_it_work" => [
            //             ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'string':null,
            //             ($request->has_medication_been_injected_for_dysfunction_erectile == '1') ? 'required':null,
            //         ],
            //         "have_you_had_an_erection_longer_than_six_hours" => ['required','boolean'],
            //         "when_you_had_a_six_hours_erection" =>[
            //             ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'string':null,
            //             ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'required':null,
            //         ],
            //         "how_was_it_resolved" => [
            //             ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'string':null,
            //             ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'required':null,
            //         ],
            //         "did_you_get_medical_attention" => [
            //             ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'string':null,
            //             ($request->have_you_had_an_erection_longer_than_six_hours == '1') ? 'required':null,
            //         ],
            //         "do_you_suffer_from_penile_curvature" => ['required','boolean'],
            //         "how_intense" => [
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
            //         ],
            //         "which_direction" => [
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
            //         ],
            //         "does_it_hurt" => [
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
            //         ],
            //         "does_it_prevent_intercourse" => [
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'string':null,
            //             ($request->do_you_suffer_from_penile_curvature == '1') ? 'required':null,
            //         ],
            //         "has_prp_been_injected_for_erectile_dysfunction" => ['required','boolean'],
            //         "have_you_received_stem_cell_treatment_for_erectile_dysfunction" => ['required','boolean'],
            //         "hyrvrntwliwtfed" => ['required','boolean'],
            //     ]);
            //     if ($validator->fails()) {
            //         return response()->json([
            //             'success' => false,
            //             'errors' => $validator->getMessageBag()->toArray()
            //         ]);
            //     }
            // }

            // if ($request->service == 3 && $request->sex == 'female') {
            //     $validator = Validator::make($request->all(), [

            //         "smoke" => "required|boolean",
            //         "cigars_smoke" => "required_if:smoke,1|nullable|string",
            //         "years_smoke" => "required_if:smoke,1|nullable|integer",
            //         "stop_smoking" => "required_if:smoke,1|nullable|boolean",
            //         "vape" => "required|boolean",
            //         "when_stop_smoking" => "required_if:stop_smoking,1|nullable|string",
            //         "alcohol" => "required|boolean",
            //         "volumen_alcohol" => [
            //             ($request->alcohol == '1') ? 'string': null
            //         ],

            //         "recreative_drugs" => "required|boolean",
            //         "total_recreative_drugs" => [
            //             ($request->recreative_drugs == '1') ? 'string': null
            //         ],

            //         "intravenous_drugs" => [
            //             ($request->recreative_drugs == '1') ? 'boolean': null,
            //             ($request->recreative_drugs == '1') ? 'required': null
            //         ],

            //         "description_intravenous_drugs" => [
            //             ($request->intravenous_drugs == '1') ? 'string': null
            //         ],

            //         "fatigue" => "required|boolean",
            //         "trouble_breathe" => "required|boolean",
            //         "asthma" => "required|boolean",
            //         "bipap_cpap" => "required|boolean",
            //         "exercise" => "required|boolean",

            //         "exercise_type" => ['required_if:exercise,1','array'],
            //         "exercise_type.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_long" => ['required_if:exercise,1','array'],
            //         "exercise_how_long.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_frecuent.*" => ['required_if:exercise,1','string'],
            //         "exercise_how_frecuent" => ['required_if:exercise,1','array'],
            //         "exercise_hours.*" => ['required_if:exercise,1','numeric'],
            //         "exercise_hours" => ['required_if:exercise,1','array'],
            //         ///////////////////////////////////////////////////////
            //         "hours_you_sleep_at_night" => ['required', 'numeric'],

            //         'do_you_take_sleeping_pills' => ['required', 'boolean'],
            //         'do_you_suffer_from_anxiety_or_depression' => ['required', 'boolean'],
            //         'do_you_take_pills_for_anxiety_or_depression' => ['required', 'boolean'],
            //         'do_you_feel_under_stress' => ['required', 'boolean'],
            //         'how_many_per_week' => ['required_if:do_you_have_erections_at_the_morning,1', 'nullable', 'string'],

            //     ]);
            //     if ($validator->fails()) {
            //         return response()->json([
            //             'success' => false,
            //             'errors' => $validator->getMessageBag()->toArray()
            //         ]);
            //     }
            // }
        }

        if ($request->step == 6) {
            // $validator = Validator::make($request->all(), [

            //     "last_menstrual_period" => "required|date",
            //     "bleeding_whas" => "required|in:normal,light,heavy,irregular",
            //     "have_you_been_pregnant" => "required|boolean",
            //     "how_many_times" => ['required_if:have_you_been_pregnant,1','nullable','string'],
            //     "c_section" => ['required_if:have_you_been_pregnant,1','nullable','string'], //boleano
            //     "birth_control" => "required|boolean",

            //     "birth_control" =>"required|boolean",
            //     "birthControl_how_long" => ['required_if:birth_control,1','array'],
            //     "birthControl_how_long.*" => ['required_if:birth_control,1','string'],
            //     "birthControl_type" => ['required_if:birth_control,1','array'],
            //     "birthControl_type.*" => ['required_if:birth_control,1','string'],

            //     "use_hormones" =>"required|boolean",
            //     "hormone_how_long" => ['required_if:use_hormones,1','array'],
            //     "hormone_how_long.*" => ['required_if:use_hormones,1','string'],
            //     "hormone_type" => ['required_if:use_hormones,1','array'],
            //     "hormone_type.*" => ['required_if:use_hormones,1','string'],

            //     "is_or_can_be_pregman" => "required|boolean",
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'success' => false,
            //         'go' => '0',
            //         'errors' => $validator->getMessageBag()->toArray()
            //     ]);
            // }
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
}
