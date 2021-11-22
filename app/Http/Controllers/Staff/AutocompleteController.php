<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Brand;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use App\Models\Staff\Package;
use App\Models\Staff\Patient;
use App\Models\Staff\Service;
use App\Models\Staff\Procedure;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AutocompleteController extends Controller
{
    public function searchStaff(Request $request)
    {
        $search = Staff::where('show', '=', 1)
        ->where("name",'like', "%".$request->key."%")
        ->orWhere("email",'like', "%".$request->key."%")
        ->get();
        return $search;
    }

    public function searchPatient(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
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
        app()->setLocale($lang);

            $search = Service::where("service_$lang",'like', "%".$request->key."%")
            ->select('id', "service_$lang AS service")
            ->get();

        return $search;
    }

    public function searchProcedure(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

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
        app()->setLocale($lang);

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
        $search = Brand::where("brand",'like', "%".$request->key."%")
        ->get();
        return $search;
    }
}
