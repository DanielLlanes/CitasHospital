<?php

namespace App\Providers;

use App\Models\Staff\Brand;
use App\Models\Staff\Debate;
use App\Models\Staff\Message;
use App\Models\Staff\Notification;
use App\Models\Staff\Service;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ViewFrondtedShereServiceProvider extends ServiceProvider
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
    public function boot(Request $request)
    {
        // function isRoleExistx($role_name){
            
        // }
    
        view()->composer('*', function ($view) 
        {
            date_default_timezone_set('America/Tijuana');
            $lang = app()->getLocale();
            $lang = ($lang == 'es') ? 'es' : "en";
            $brands = [];
            $coordinatorFooter = [];
            $debateMessages = [];
            $notifications = [];
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

                if (Auth::guard('staff')->check()) {
                    $lang = Auth::guard('staff')->user()->lang;
                    app()->setLocale($lang);
                    $debateMessages = Message::with([
                        'debateInverseMessages' => function($q)
                        {
                            $q->with('staffDebate');
                        }
                    ])
                    ->orderBy('created_at', 'DESC')
                    ->where('staff_id', Auth::guard('staff')->user()->id)
                    ->get();

                    $notifications = Notification::orderBy('created_at', 'DESC')
                    ->where('staff_id', Auth::guard('staff')->user()->id)
                    ->with('notificationStaff')
                    ->get();
                }
                
            }
            $view->with(['brands' => $brands, 'coordinatorFooter' => $coordinatorFooter, 'debateMessages' => $debateMessages, 'notifications' => $notifications]);    
        }); 
    }
}
