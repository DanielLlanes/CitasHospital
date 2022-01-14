<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Faq;
use App\Models\Staff\Brand;
use App\Models\Staff\Procedure;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use App\Models\Staff\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $lang = "en";
        $coordinator = Staff::role('coordinator')
        ->with
        (
            [
                'assignToService' => function($q) use($lang) 
                {
                    $q->selectRaw("services.id, service_$lang as service, brand_id");
                    $q->with
                    (
                        [
                            'brand'
                        ]
                    );
                }
            ]
        )
        ->get();
        //return($coordinator);
        return view('site.welcome', ["coordinators" => $coordinator]);
    }
    public function team($url = null)
    {
        //return($url);
        $lang = "en";

        if (is_null($url)) {
            $doctors = Staff::role('doctor')
            ->with
            (
                [
                    'assignToService' => function($q) use($lang) 
                    {
                        $q->selectRaw("services.id, service_$lang as service, brand_id");
                        $q->with
                        (
                            [
                                'brand',
                            ]
                        );
                    },
                    'specialties'
                ]
            )
            ->where("public_profile", 1)
            ->get();

            $specialties = Specialty::where("show", 1)
            ->where("active", 1)
            ->select("id", "name_$lang AS specialty", "show", "active")
            ->get();

            return view('site.team', ['doctors' => $doctors, "specialties" => $specialties]);
        } 

        $staffUrl= $url;
        

        $doctor = Staff::with([
            'roles' => function($query) use ($lang) {
                $query->select(["id", "name_$lang AS Rname"]);
            },
            'workhistory',
            'educationbackground',
            'postgraduatestudies',
            'updatecourses',
            'imagespublicprofile',
            'careerobjetive',
            'specialties' => function($query) use ($lang){
                $query->select(["specialties.id", "name_$lang AS Sname"]);
            },
            'assignToService' => function($query) use ($lang){
                $query->select(["services.id", "service_$lang AS service"]);
            },
        ])
        ->where("url", $staffUrl)
        ->where("public_profile", 1)
        ->first();
        
        if (!$doctor) {abort(404);}

        //if ($doctor) { if ($doctor->public_profile == 0) {}}

        return view('site.public_profile', ['doctor' => $doctor]);
    }
    public function testimonials()
    {
        return view('site.testimonials');
    }
    public function contact()
    {
        return view('site.contact');
    }
    public function blog()
    {
        return view('site.blog');
    }
    public function singlePost()
    {
        return view('site.single-post');
    }
    public function faqs()
    {
        $lang = "en";
        $faqs = Faq::where('active', true)
        ->select('id', "question_$lang As question", "awnser_$lang As awnser")
        ->get();
        return view('site.faqs', ['faqs' => $faqs]);
    }
    public function brand($brand)
    {

        if ($brand === 'staff') {
            return redirect()->route('staff.dashboard');
        }
        Session::forget('form_session');
        Session::forget('treatment');

        $lang = "en";

        $brandExist = Brand::where('url', $brand)->first();

        if (!$brandExist) {
            abort(404);
        }

        $treatment = Treatment::whereHas('brand', function($query) use ($brand) {
            $query->where('url', $brand);
         })
        ->with
        (
            [
                'brand',
                'service',
                'procedure' => function($query) use ($lang) {
                    $query->select('id', "active", "has_package", "service_id", "procedure_$lang as procedure", "description_$lang as description", "image");
                 },
                'package' => function($query) use ($lang) {
                    $query->select('id', "active", "package_$lang as package");
                 },
            ]
        )
        ->where('active', true)
        ->orderBy('procedure_id', 'ASC')
        ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price", "description_$lang as description")
        ->get();
        

        $service = Brand::where('url', $brand)
        ->with(
            'service', function($q)
            {
                $q->selectRaw("service_en AS service, brand_id");
            }
        )
        ->selectRaw("id")
        ->first();

        $doctors = Staff::role('doctor')
        ->whereHas
        (
            'assignToService', function($q)use($service)
            {
                $q->where("service_en", $service->service->service);
            }
        )
        ->where("public_profile", 1)
        ->get();

        $titles = new Collection();

        if (count($treatment) > 0) {
            $titles = Treatment::select("procedure_id", "group_$lang as group")
            ->whereHas('brand', function($query) use ($brand) {
                $query->where('url', $brand);
            })
            ->with('procedure', function($query) use ($lang) {
                $query->select('id', "procedure_$lang as procedure", "description_$lang as description");
             })
            ->distinct()
            ->get();
        }

        $getBrand = Brand::where('url', $brand)
        ->select('id', 'brand', 'color')
        ->with(
            [
                'service' => function($q) use ($lang){
                    $q->select("id", "brand_id", "service_$lang as service", "description_$lang as description");
                },
            ]
        )
        ->firstOrFail();


        if ($brand) {
            $view = 'site.brand';
            if(view()->exists($view)){
                return view($view,
                    [
                        "brand" => $getBrand,
                        "treatments" => $treatment,
                        "title" => $titles,
                        "doctors" => $doctors
                    ]
                )->render();
            }
        }
    }
    public function profile()
    {
        return view('site.profile');
    }
}
