<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('site.welcome');
    }
    public function team()
    {
        return view('site.team');
    }
    public function testimonials()
    {
        return view('site.testimonials');
    }
    public function contact()
    {
        return view('site.contact');
    }
    public function blog()
    {
        return view('site.blog');
    }
    public function singlePost()
    {
        return view('site.single-post');
    }
    public function faqs()
    {
        return view('site.faqs');
    }
}
