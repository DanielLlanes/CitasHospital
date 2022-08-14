<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:partners');
        // $this->middleware('can:services.list')->only(['getServiceList', 'service']);
        // $this->middleware('can:services.edit')->only(['edit','update']);
        // $this->middleware('can:services.create')->only(['create','store']);
        // $this->middleware('can:services.destroy')->only(['destroy']);
        // $this->middleware('can:services.activate')->only(['activate']);
    }
   public function index()
   {
       return view('partners.dashboard');
   }
}
