<?php

namespace App\Http\Controllers\Site;

use App\Models\Site\Faq;
use App\Models\Staff\Brand;
use Illuminate\Http\Request;
use App\Models\Staff\Treatment;
use App\Models\Staff\Procedure;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        return view('site.welcome');
    }
    public function team()
    {
        return view('site.team');
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
                 }
            ]
        )
        ->where('active', true)
        ->orderBy('procedure_id', 'ASC')
        ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price", "description_$lang as description")
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
                        "title" => $titles
                    ]
                )->render();
            }
        }
    }
}
