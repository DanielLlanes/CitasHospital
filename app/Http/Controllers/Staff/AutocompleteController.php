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
        $search = Staff::where("name",'like', "%".$request->key."%")
        ->where('show', '=', 1)
        ->get();
        return $search;
    }

    public function searchPatient(Request $request)
    {
        $search = Patient::where("name",'like', "%".$request->key."%")
        ->get();
        return $search;
    }

    public function searchService(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        if ($request->has('brand')) {

            $brand = $request->brand;

            $search = Service::whereHas(

                    'brand', function($query) use ($brand)
                    {
                        $query->where('id', $brand)
                        ->select(
                            [
                                "id", 'brand'
                            ]
                        );
                    }

            )
            ->where("service_$lang",'like', "%".$request->key."%")
            ->select('id', "service_$lang AS service")
            ->get();
        } else {
            $search = Service::where("service_$lang",'like', "%".$request->key."%")
            ->select('id', "service_$lang AS service")
            ->get();
        }


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
