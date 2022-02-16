<?php

namespace App\Providers;

use App\Models\Staff\Brand;
use App\Models\Staff\Service;
use App\Models\Staff\Staff;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ViewSharedVarsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('America/Tijuana');
        $lang = app()->getLocale();


        $brands = [];
        $coordinatorFooter = [];

        function isRoleExist($role_name){
                $x = Role::where('name', $role_name)->get();

                if (count($x) > 0) {return true;}
                return false;
        }

        if (isRoleExist('coordinator')) {
            $coordinatorFooter = Staff::role('coordinator')
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

            $brands = Brand::select("*")
            ->whereHas
            (
                'service', function($q)
                {
                    $q->whereNotNull('id');
                },
            )
            ->with
                (
                    [
                        'imageOne',
                        'service' => function($q) use ($lang){
                            $q->select(["id", "brand_id", "service_$lang AS service"]);
                        },
                    ]
                )
            ->get();
        }
        

        View::share(['brands' => $brands, 'coordinatorFooter' => $coordinatorFooter]);
    }
}
