<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormEmail;
use App\Models\Site\Faq;
use App\Models\Staff\Brand;
use App\Models\Staff\Procedure;
use App\Models\Staff\Slider;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use App\Models\Staff\Testimonial;
use App\Models\Staff\Treatment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function home()
    {
       // return Redirect::to('http://staff.prado.test');
        $lang = \App::getLocale();

        $sliders = Slider::with(['imageOne', 'videoOne'])->where('active', 1)->orderBy('order', 'ASC')->get();

        $coordinator = Staff::role('coordinator')
        ->with
        (
            [
                'imageOne',
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
        return view('site.welcome');
    }
    public function team($url = null)
    {
        //return($url);
        $lang = \App::getLocale();

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
                    'imageOne',
                    'specialties' => function($q)use($lang)
                    {
                        $q->selectRaw("name_$lang as specialty, specialties.id");
                    }
                ]
            )
            ->where("public_profile", 1)
            ->get();

            $specialties = Specialty::where("show", 1)
            ->where("active", 1)
            ->select("id", "name_$lang AS specialty", "show", "active")
            ->get();

            $collection = new Collection;
            $titles = new Collection;

            foreach ($doctors as $doc) {
                $echos = $doc->specialties->unique('specialty');
                foreach ($echos as $dsp) {
                    $collection->push($dsp);
                }
            }
            $unique = $collection->unique('specialty')->values()->all();

            foreach ($unique as $value) {
                $titles->push((object)[
                    'id' => $value->id,
                    'name' => $value->specialty
                ]);
            }
            //return $title;

            return view('site.team', ['doctors' => $doctors, 'titles' => $unique]);
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
            'imageOne',
            'imageMany',
            'careerobjetive',
            'surgeryperformed',
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
    public function testimonials(Request $request, $brand, $media)
    {
        $brand = Brand::where('url', $brand)->first();
        $flag = null;
        $testimonials = [];
        if (!$brand) {abort(404);}
        if (!$media) {abort(404);}
        if ($media == 'image' || $media == 'video') { $flag = true;} else {abort(404);}
        if ($flag) {

            if ($media == 'image') {

                $testimonials = Testimonial::where('brand_id', $brand->id)
                ->with([
                    'imageOne',
                    'procedure',
                    'brand' =>function($q){
                        $q->with('service');
                    }
                ])
                ->paginate(3);
                
                
            } elseif($media == 'video') {
                abort(404);
            } else {
                abort(404);
            }
        }


        return view('site.testimonials', ['testimonials' => $testimonials]);
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
        $lang = \App::getLocale();
        $faqs = Faq::where('active', true)
        ->select('id', "question_$lang As question", "awnser_$lang As awnser")
        ->get();
        return view('site.faqs', ['faqs' => $faqs]);
    }
    public function facilities()
    {
        return view('site.facilities');
    }
    public function brand($brand)
    {

        if ($brand === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        if ($brand === 'partners') {
            return redirect()->route('partners.dashboard');
        }
        
        Session::forget('form_session');
        Session::forget('treatment');

        $lang = \App::getLocale();
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
                    $query->select('id', "active", "has_package", "service_id", "procedure_$lang as procedure");
                 },
                'package' => function($query) use ($lang) {
                    $query->select('id', "active", "package_$lang as package");
                 },
                 //'imageOne',
                 "contains" => function($q)use($lang){
                    $q->select('*', "contain_$lang as include");
                 },
            ]
        )
        ->where('active', true)
        ->orderBy('procedure_id', 'ASC')
       // ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price", "*")
        ->get();


        $service = Brand::where('url', $brand)
        ->with(
            'service', function($q) use ($lang)

            {
                $q->selectRaw("service_$lang AS service, brand_id");
            }
        )
        ->selectRaw("id")
        ->first();


        $doctors = Staff::role('doctor')
        ->whereHas
        (
            'assignToService', function($q)use($service, $lang)
            {
                $q->where("service_$lang", $service->service->service);
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
            ->with(
                'procedure', function($query) use ($lang) {
                    $query->select('id', "procedure_$lang as procedure")
                    ->with(
                        [
                            'imageOne',
                            'descriptionOne' => function($q)use($lang){
                                $q->select('*', "description_$lang as description");
                            },
                        ]
                    );
                 },
             )
            ->distinct()
            ->get();
        }

        $getBrand = Brand::where('url', $brand)
        ->select('id', 'brand', 'color')
        ->with(
            [
                'service' => function($q) use ($lang){
                    $q->select("id", "brand_id", "service_$lang as service")
                    ->with(
                        'descriptionOne', function($q)use($lang){
                            $q->select('*', "description_$lang as description");
                        }
                    );
                },
                'imageOne',
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
    public function contactForm(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'bail|string|required',
            'email' => 'bail|required|email',
            'phone' => ['bail', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'subject' => 'bail|string|required',
            'message' => 'bail|string|required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $request->merge(["email_reciver" => 'info@jlpradosc.com', "name_reciver" => "Info Jl Prado"]);

        $data = array(
            'email' => $request->email,
            'name' => $request->name,
            'msg' => $request->message,
            'name_reciver' => $request->name_reciver,
            'email_reciver' => $request->email_reciver,
            'subject' => $request->subject,
            'phone' => $request->phone,
        );

        Mail::send(new ContactFormEmail($data));

        return response()->json([
            'success' => true,
            'go' => '0',
        ]);
    }
}
