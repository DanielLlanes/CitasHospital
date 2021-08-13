<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
}
