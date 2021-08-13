<?php

namespace App\Http\Controllers\Site;

use App\Models\Staff\Brand;
use Illuminate\Http\Request;
use App\Models\Staff\Product;
use App\Models\Staff\Procedure;
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

        $products = Product::whereHas('brand', function($query) use ($brand) {
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
                    $query->select('id', "active", "package_$lang as package", "description_$lang as description");
                 }
            ]
        )
        ->where('active', true)
        ->orderBy('procedure_id', 'ASC')
        ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price")
        ->get();

        $titles = "Coming soon";

        if (count($products) > 0) {
            $titles = Product::select("group_$lang as group")
            ->whereHas('brand', function($query) use ($brand) {
                $query->where('url', $brand);
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
        ->first();


        if ($brand) {
            $view = 'site.brand';
            if(view()->exists($view)){
                return view($view,
                    [
                        "brand" => $getBrand,
                        "products" => $products,
                        "title" => $titles
                    ]
                )->render();
            }
        }
    }
}
