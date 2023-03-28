<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Service;
use Illuminate\Http\Request;


class EmailTemplateController extends Controller
{
     public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        // $this->middleware('can:brand.list')->only(['getBrandList', 'brand']);
        // $this->middleware('can:brand.edit')->only(['edit','update']);
        // $this->middleware('can:brand.create')->only(['create','store']);
        // $this->middleware('can:brand.destroy')->only(['destroy']);
        // $this->middleware('can:brand.activate')->only(['activate']);
    }

    public function index()
    {
        $services = Service::where('active', '1')->get();
        return view('staff.mail-manager.assinaments');
    }

    public function getAssignableList(Request $request)
    {
            return $request;
        if ($request->ajax()) {
            
        }
    }
}
