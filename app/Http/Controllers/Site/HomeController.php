<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Faq;
use App\Models\Staff\Brand;
use App\Models\Staff\Procedure;
use App\Models\Staff\Staff;
use App\Models\Staff\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $lang = app()->getLocale();
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
        $lang = app()->getLocale();

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
            ->get();
            return view('site.team', ['doctors' => $doctors]);
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
        ->first();
        
        if (!$doctor) {abort(404);}

        if ($doctor) { if ($doctor->public_profile == 0) {}}

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
        $lang = app()->getLocale();
        $faqs = Faq::where('active', true)
        ->select('id', "question_$lang As question", "awnser_$lang As awnser")
        ->get();
        return view('site.faqs', ['faqs' => $faqs]);
    }
    public function brand($brand)
    {
        Session::forget('form_session');
        Session::forget('treatment');

        $lang = app()->getLocale();

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
