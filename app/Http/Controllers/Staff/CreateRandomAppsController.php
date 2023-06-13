<?php

namespace App\Http\Controllers\Staff;

use Carbon\Carbon;
use App\Mail\NewAppEmail;
use App\Models\Site\State;
use App\Models\Staff\Staff;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Site\Country;
use Illuminate\Http\Request;
use App\Models\Staff\Package;
use App\Models\Staff\Patient;
use App\Models\Staff\Service;
use App\Traits\DatesLangTrait;
use App\Models\Staff\Procedure;
use App\Models\Staff\Treatment;
use App\Mail\WelcomeLetterEmail;
use App\Models\Partners\Partner;
use App\Models\Site\Application;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Models\Site\SurgeryApplication;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Site\ExerciseApplication;
use App\Models\Site\HormonesApplication;
use App\Models\Site\IllnsessApplication;
use Illuminate\Support\Facades\Validator;
use App\Models\Site\MedicationApplication;
use App\Models\Site\BirthControlApplication;
use Illuminate\Database\Eloquent\Collection;
class CreateRandomAppsController extends Controller
{
    use datesLangTrait;
    public function addApps()
    {
        $faker = Faker::create();
        $treatments = Treatment::all();
        $lang = 'en';
        $exist = true;
        $minYear = date("Y") - 100;
        $year = date("Y");
        foreach ($treatments as $key => $treatment) {
            //return $treatment;
            $patient = $this->createPatient();
            $need_images = $this->needImages($treatment->service_id);
            $storageApps = $this->createApp($patient, $need_images, $treatment);
            sleep(5);

            echo $storageApps;
        }

        
    }

    private function getCorreos()
    {
        $staff = Staff::whereHas(
            "roles", function($q){ 
                $q->where("name", "administrator"); 
            })
            ->orderBy('last_assignment', 'ASC')
            ->first();

        $staff->last_assignment = Carbon::now();
        $staff->save();
        return $staff;
    }
    private function needImages($service)
    {
        $need_images = Service::select('need_images', 'qty_images')->find($service);
        return $need_images;
    }

    private function createPatient()
    {
        $faker = Faker::create();
        $gender = ["male", "female"];
        $randomDateOfBirth = $faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d');
        $birthDate = Carbon::createFromFormat('Y-m-d', $randomDateOfBirth);
        $currentDate = Carbon::now();
        $age = $birthDate->diffInYears($currentDate);

        $emailPatient = Staff::whereHas(
            "roles", function($q){ 
                $q->where("name", "administrator"); 
            })
            ->orderBy('last_assignment', 'asc')
            ->first();
            $emailPatient->last_assignment = Carbon::now();
            $emailPatient->save();
        $patient = Patient::where('email', $emailPatient->email)->first();

        if(!$patient){
            $patient = new Patient();

            $patient->treatmentBefore = $faker->randomElement(['0', '1']);
            $patient->name = Str::ucfirst($faker->name);
            $patient->sex = $faker->randomElement(['male', 'female']);
            $patient->age = $age;
            $patient->dob = $randomDateOfBirth;
            $patient->phone = $faker->phoneNumber;
            $patient->mobile = $faker->phoneNumber;
            $patient->email = $this->getCorreos()->email;
            $patient->address = $faker->streetAddress;
            $patient->pais = $faker->country;
            $patient->estado = $faker->state;
            $patient->city = $faker->city;
            $patient->zip = $faker->postcode;
            $patient->ecn = $faker->name;
            $patient->ecp = $faker->phoneNumber;
            $patient->lang = 'en';
            $patient->password = Hash::make($faker->ipv4);
            $patient->code = getCode();

            $patient->save();
        }

        return $patient;
    }

    private function createApp($patient, $needImages, $treatment)
    {

        $currentDate = Carbon::now();
        $modifiedDate = $currentDate->subDays(15);

        $app = new Application;
        $app->code = getCode();
        $app->patient_id = $patient->id;
        $app->price = (!is_null($treatment->price) ? $treatment->price: null);

        $app->temp_code = Str::random(10);
        $app->patient_id = $patient->id;
        $app->treatment_id = $treatment->id;
        $app->mesure_sistem = 'M';
        $app->weight = '120';
        $app->max_weigh = '90';
        $app->height = '1.85';
        $app->imc = '26.3';
        $app->if_take_medication = 0;
        $app->if_take_blood_thinners = 0;
        $app->razon_blood_thinners = null;
        $app->acid_reflux = 'no';
        $app->penicilin = 0;
        $app->drugs_sulfa = 0;
        $app->iodine = 0;
        $app->tape = 0;
        $app->latex = 0;
        $app->aspirin = 0;
        $app->other_allergy = null;
        $app->describe_other_allergy = null;

        $app->if_have_surgeries = 0;

        $app->addiction = 0;
        $app->which_one_adiction = null;
        $app->high_lipid_levels = 0;
        $app->date_high_lipd_levels = null;
        $app->high_lipid_levels_treatment = null;
        $app->cancer = 0;
        $app->date_cancer = null;
        $app->cancer_treatment = null;
        $app->arthritis = 0;
        $app->date_arthritis = null;
        $app->cholesterol = 0;
        $app->date_cholesterol = null;
        $app->cholesterol_treatment = null;
        $app->triglycerides = 0;

        $app->disease_stroke = 0;
        $app->diabetes = 0;
        $app->coronary_artery_disease = 0;
        $app->disease_liver = 0;
        $app->disease_lung = 0;
        $app->disease_renal = 0;
        $app->disease_thyroid = 0;
        $app->ypertension = 0;
        $app->smoke = 0;
        $app->stop_smoking = 0;
        $app->alcohol = 0;
        $app->vape = 0;
        $app->recreative_drugs = 0;
        $app->intravenous_drugs = 0;
        $app->fatigue = 0;
        $app->trouble_breathe = 0;
        $app->asthma = 0;
        $app->bipap_cpap = 0;
        $app->exercise = 0;
        $app->save();

        if ($patient->sex == 'male') {
            $app->hours_you_sleep_at_night = null;
            $app->do_you_take_sleeping_pills = 0;
            $app->do_you_suffer_from_anxiety_or_depression = 0;
            $app->do_you_take_pills_for_anxiety_or_depression = 0;
            $app->do_you_feel_under_stress = 0;
            $app->do_you_have_erections_at_the_morning = 0;
            $app->how_many_per_week = null;
            $app->do_you_have_problems_getting_erections = 0;
            $app->since_when = null;
            $app->describe_your_erection_problem = null;
            $app->do_you_have_problems_maintaining_an_erection = null;
            $app->do_you_take_any_natural_remedy_for_erectile_dysfunction = 0;
            $app->what_kind = null;
            $app->how_did_it_work_natural_remedy = null;
            $app->where_did_you_get_them = null;
            $app->has_medication_been_injected_for_dysfunction_erectile = 0;
            $app->how_many_times_have_injected = null;
            $app->how_did_it_work = null;
            $app->have_you_had_an_erection_longer_than_six_hours = 0;
            $app->when_you_had_a_six_hours_erection = null;
            $app->how_was_it_resolved = null;
            $app->did_you_get_medical_attention = null;
            $app->do_you_suffer_from_penile_curvature = 0;
            $app->how_intense = null;
            $app->which_direction = null;
            $app->does_it_hurt = 0;
            $app->does_it_prevent_intercourse = null;
            $app->has_prp_been_injected_for_erectile_dysfunction = 0;
            $app->have_you_received_stem_cell_treatment_for_erectile_dysfunction = 0;
            $app->hyrvrntwliwtfed = 0;
        }
        if($patient->sex !== 'male') {
            $app->last_menstrual_period = $modifiedDate;
            $app->bleeding_whas = 'normal';
                        
            $app->have_you_been_pregnant = 0;
            $app->how_many_times = null;
            $app->c_section = 0;
            $app->birth_control = 0;
            $app->use_hormones = 0;
            $app->is_or_can_be_pregmant = 0;
        }
        
        // if ($need_images->need_images == 1) {
        //     for ($i=0; $i < $needImages->qty_images; $i++) { 
        //         $this->generateRandomImage($app, $i);
        //     }

        // }
        //$treatment->merge(['service', $treatment->service_id]);
        $treatment->service = $treatment->service_id;
        $getStaffEmails = getStaffEmails($treatment);
        
        $assignment_staff = (count($getStaffEmails) > 0) ? $getStaffEmails[0]:'';  

        $other_staff = getOthersEmails($treatment);

        $treatment = Treatment::where("procedure_id", $treatment->procedure_id)
            ->where('package_id', $treatment->package_id)
            ->with([
                'service' => function($query) {
                    $query->select('id', 'brand_id', "active", "service_en as service", "need_images", "qty_images")
                    ->with('brand');
                    },
                'procedure' => function($query) {
                    $query->select('id', "active", "has_package", "service_id", "procedure_en as procedure");
                    },
                'package' => function($query) {
                    $query->select('id', "active", "package_en as package");
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
                'ass_as' => 10,
                'code' => getCode(),
            ];
            $staffx = Staff::find($assignment_staff->id);
            $staffx->last_assignment = Carbon::now();
            $staffx->save();

            // $date = Carbon::now();
            // $hours = $date->format('g:i A');
            // $response = [];
            // $notifications = new Collection;
            // $response['staff_id'] = $assignment_staff->id;
            // $response['message'] = $newMessage;
            // $response['application_id'] = $app->id;
            // $response['timestamp'] = $this->datesLangTrait($date, 'en') . ", " .$hours;
            // $response['timeDiff'] = $date->diffForHumans();
            // $response['msgStrac'] = \Str::of("A new application has been assigned to you")->limit(20);

            // $notifications->push((object)[
            //     'staff_id' => $assignment_staff->id,
            //     'message' => $newMessage,
            //     'application_id' => $app->id,
            //     'timestamp' => $this->datesLangTrait($date, 'en') . ", " .$hours,
            //     'timeDiff' => $date->diffForHumans(),
            //     'msgStrac' => \Str::of("A new application has been assigned to you")->limit(20),
            //     'url' => 'Nodata',
            // ]);

            // $app->notification()->create([
            //     'staff_id' => $assignment_staff->id,
            //     'type' => 'New application',
            //     'message' => $newMessage,
            //     'code' => getCode(),
            // ]);

            // $toEmail->push((object)[
            //     'staff_name' => $assignment_staff->name,
            //     'staff_email' => $assignment_staff->email,
            //     'app_id' => $app->id,
            //     'treatment' => $treatment,
            //     "patient" => $patient,
            //     "subject" => $newMessage,
            // ]);
            // $toEmail->push((object)[
            //     'staff_name' => 'Gabriel',
            //     'staff_email' => 'gabriel@jlpradosc.com',
            //     'app_id' => $app->id,
            //     'treatment' => $treatment,
            //     "patient" => $patient,
            //     "subject" => $newMessage,
            // ]);
        }

        
        Mail::send(new WelcomeLetterEmail($patient, $treatment, $assignment_staff));
        // if (count($other_staff) > 0) {
        //     foreach ($other_staff as $staff) {
        //         $app->notification()->create([
        //             'staff_id' => $staff->id,
        //             'type' => 'New application',
        //             'message' => 'Hay una nueva aplicación de ' .$treatment->service->service_es,
        //             'code' => getCode(),
        //         ]);

        //         $toEmail->push((object)[
        //             'staff_name' => $staff->name,
        //             'staff_email' => $staff->email,
        //             'app_id' => $app->id,
        //             'treatment' => $treatment,
        //             "patient" => $patient,
        //             "subject" => $newMessage,
        //         ]);
                
        //         $date = Carbon::now();
        //         $hours = $date->format('g:i A');
        //         $notifications->push((object)[
        //             'staff_id' => $staff->id,
        //             'message' => 'Hay una nueva aplicación de ' .$treatment->service->service_es,
        //             'application_id' => $app->id,
        //             'timestamp' => $this->datesLangTrait($date, 'en') . ", " .$hours,
        //             'timeDiff' => $date->diffForHumans(),
        //             'msgStrac' => \Str::of("Hay una nueva aplicación")->limit(20),
        //             'url' => route('staff.applications.show', ["id" => $app->id]),
        //         ]);
        //     }
        // }
        // foreach ($toEmail as $key => $data) {
        //     Mail::to($data->staff_email)
        //     ->send(
        //         new NewAppEmail($data)
        //     );
        //     sleep(1);
        // }
            
        $app->assignments()->sync($assignment);
        $app->is_complete = true;

    
        if ($app->save()) {
            $app->statusOne()->create(
                [
                    'status_id' => 9,
                    'code' => getCode()
                ]
            );
        }

        return 'terminando....';

    }

    private function generateRandomImage($app, $key)
    {
        $destinationPath = storage_path('app/public').'/tests/application/image';

        $faker = Faker::create();
        $image = Image::canvas(800, 600);
        
        $image->text("imagen random", 400, 300, function ($font) {
            $font->size(148);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });
        File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

        $filename = $faker->uuid . '.jpg';
        $path = '/public/tests/application/image' . '/' . $filename;
        $url = "storage/test/application/image/$filename";

        $image->encode('jpg');
        $image->save($destinationPath."/".$filename, '90');
        $url = "storage/application/image/$filename";

        $image = $app->imageMany()->create(["code" => getCode(), 'image' => $image, 'title' => null, 'order' => $key]);
    }
}
