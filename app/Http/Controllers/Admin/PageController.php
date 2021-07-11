<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            return view('admin.pages.dashboard');
        } else {
            return redirect()->route('admin.login');
        }
    }

}
