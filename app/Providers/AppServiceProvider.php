<?php

namespace App\Providers;

use App\Models\Staff\Brand;
use App\Models\Staff\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $lang = app()->getLocale();

        // $brands = Brand::select("id", "brand", "acronym", "url")
        // ->with
        // (
        //     [
        //         'service' => function($q) use ($lang){
        //             $q->select(["id", "brand_id", "service_$lang AS service"]);
        //         },
        //     ]
        // )
        // ->get();


        // if (!$brands) {
        //     $brands = [];
        // }


        // View::share('brands', $brands);
    }
}
