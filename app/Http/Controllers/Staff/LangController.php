<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class LangController extends Controller
{
    public function update(Request $request, $lang)
    {
        app()->setLocale($lang);
        $staff = Staff::findOrFail(Auth::guard('staff')->user()->id);

        if ($lang != $staff->lang) {
            $staff->lang = $lang;
            $staff->save();
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function publicLang(Request $request, $lang){

        switch ( $lang ) {
            case 'en':
                app()->setLocale($lang);
                return redirect()->back()->withCookie(Cookie::forever('PublicLang', $lang));
                break;
            case 'es':
                app()->setLocale($lang);
                return redirect()->back()->withCookie(Cookie::forever('PublicLang', $lang));
                break;
            default:
                app()->setLocale($lang);
                return redirect()->back()->withCookie(Cookie::forever('PublicLang', app()->getLocale()));
                break;
        }
        return $lang;
        
    }
}
