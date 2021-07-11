<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\JobProfile;
use App\Package;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return view('site.page.home');
    }

    public function aboutUS()
    {
        return view('site.page.about');
    }

    public function jobProfiles()
    {
        return view('site.page.category');
    }

    public function contactUS()
    {
        return view('site.page.contact');
    }
}
