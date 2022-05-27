<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Site\Application;
use App\Models\Staff\Brand;
use App\Models\Staff\Package;
use App\Models\Staff\Patient;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use App\Models\Staff\Specialty;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutocompleteController extends Controller
{
    public function searchStaff(Request $request)
    {
    
            // $search = Staff::where
            // (
            //     [
            //         ["name",'like', "%".$request->search."%"],
            //         ['show', "=", 1]
            //     ]
            // )
            // ->orWhere
            // (
            //     [
            //         ["email",'like', "%".$request->search."%"],
            //         ['show', "=", 1]
            //     ]
            // )
            // ->get();
            // 
            // 
        
        if ($request->has('app')) {
            $appSearch = Application::with(['treatment' => function($q)use($request){ $q->with('service');}])->where('id', $request->app)->first();
            $service = $appSearch->treatment->service->service_en; 
            $search = Staff::whereHas(
                'assignment', function($q)use($request){
                    $q->where('applications.id', $request->app);
                }
            )
            ->whereHas(
                'assignToSpecialty', function($q)use($service){
                    $q->whereHas(
                        'services', function($q)use($service) {
                            $q->where('service_en', $service);
                        }
                    );
                }
            )
            ->where(
                [
                    ["name",'like', "%".$request->search."%"],
                    ['show', "=", 1]
                ]
            )
            ->get();
        } else {
            $search = Staff::whereHas(
                
                'specialties', function($q){
                   $q->where(
                        [
                            ['specialties.id', '!=', 10],
                            ['specialties.id', '!=', 1],
                            ['specialties.id', '!=', 2],
                            ['specialties.id', '!=', 3],
                            ['specialties.id', '!=', 9],
                            ['specialties.id', '!=', 11],
                            ['specialties.id', '!=', 16],
                        ]
                    );
                },
            )
            
            ->get();
        }
            
        

        
        
        return($search);

        return response()->json([
            "service" => $service
        ]);
    }

    public function searchPatient(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        
        $search = Patient::where("name",'like', "%".$request->key."%")
        ->with(
            [
                'applications' => function ($q) use ($lang){
                    $q->with(
                        [
                            'treatment' => function($q) use($lang) {
                                $q->with(
                                    [
                                        "brand" => function($q){
                                            $q->select("brand", "id", "color");
                                        },
                                        "service" => function($q) use($lang) {
                                            $q->select("service_$lang AS service", "id");
                                        },
                                        "procedure" => function($q) use($lang) {
                                            $q->select("procedure_$lang AS procedure", "id");
                                        },
                                        "package" => function($q) use($lang) {
                                            $q->select("package_$lang AS package", "id");
                                        },
                                    ]
                                );
                            },
                        ]
                    );
                }
            ]
        )
        ->get();
        return $search;
    }

    public function searchService(Request $request)
    {

        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

            $search = Service::where("service_$lang",'like', "%".$request->key."%")
            ->select('id', "service_$lang AS service")
            ->get();

        return $search;
    }

    public function searchProcedure(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        if ($request->has('service')) {

            $search = Procedure::whereHas(

                    'service', function($query) use ($request, $lang)
                    {
                        $query->where('id', $request->service)
                        ->select(
                            [
                                "id", "service_$lang as service"
                            ]
                        );
                    }

            )
            ->where("procedure_$lang",'like', "%".$request->key."%")
            ->select('id', "procedure_$lang AS procedure", "has_package as package")
            ->get();
        } else {
            $search = Procedure::where("procedure_$lang",'like', "%".$request->key."%")
            ->select('id', "procedure_$lang AS procedure")
            ->get();
        }
        return $search;
    }

    public function searchPackage(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        if ($request->has('package')) {

            $search = Package:: whereHas(
                [
                    'procedure' => function($query) use ($request, $lang)
                    {
                        $query->where('id', $request->brand)
                        ->select(
                            [
                                "id", "procedure_$lang as procedure"
                            ]
                        );
                    }
                ]
            )
            ->where("package_$lang",'like', "%".$request->key."%")
            ->select('id', "package_$lang AS package")
            ->get();
        } else {
            $search = package::where("package_$lang",'like', "%".$request->key."%")
            ->select('id', "package_$lang AS package")
            ->get();
        }
        return $search;
    }

    public function searchBrand(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        if ($request->has('procedures')) {
            $search = Brand::where("brand",'like', "%".$request->key."%")
            ->with(
                 'procedureBrand', function($q)use($lang){
                     $q->select('*', "procedures.id", "procedure_$lang as procedure");
                 }
             )
            ->get();
            return $search;
        } 
        $search = Brand::where("brand",'like', "%".$request->key."%")
        ->get();
        return $search;
    }
}
