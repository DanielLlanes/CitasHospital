<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Brand;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use App\Models\Staff\Patient;
use App\Models\Staff\Service;
use App\Http\Controllers\Controller;

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
}
