<?php

namespace App\Http\Controllers\Site;

use App\Models\Staff\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('site.faqs');
    }
    public function brand($brand)
    {
        $lang = app()->getLocale();
        $brand = Brand::with(
            [
                'service' => function($q) use ($lang){
                    $q->select(["*", "service_$lang as service", "description_$lang as decription"]);
                },
            ]
        )
        ->firstOrFail();
        if ($brand) {
            $view = 'site.brand';
            if(view()->exists($view)){
                return view($view, ["brand" => $brand])->render();
            }
        }
    }
}
