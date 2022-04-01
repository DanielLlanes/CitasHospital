<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff');
        date_default_timezone_set('America/Tijuana');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        return view('staff.dashboard');
    }

    public function dashboard()
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
         return redirect()->route('staff.dashboard');
    }
}
