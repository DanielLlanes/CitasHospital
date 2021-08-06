<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Brand;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use App\Models\Staff\Patient;
use App\Models\Staff\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AutocompleteController extends Controller
{
    public function searchBrand(Request $request)
    {
        $search = Brand::where("brand",'like', "%".$request->key."%")
        ->get();
        return $search;
    }

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

        $search = Service::where("service_$lang",'like', "%".$request->key."%")
        ->select('id', "service_$lang AS service")
        ->get();
        return $search;
    }
}
