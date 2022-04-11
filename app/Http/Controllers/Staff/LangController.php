<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class LangController extends Controller
{
    public function language(Request $request, $lang)
    {
        if ($lang == "en" || $lang == "es") {
            if (Auth::guard('staff')->check()) {
                $staff = Staff::findOrFail(Auth::guard('staff')->user()->id);
                if ($lang != $staff->lang) {
                    $staff->lang = $lang;
                    $staff->save();
                    session()->put('locale', $lang);
                    app()->setLocale(session('locale'));
                    return redirect()->back();
                }
            }
            session()->put('locale', $lang);
            app()->setLocale(session('locale'));
        }
        return redirect()->back();
    }
}
