<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    // public function contact()
    // {
    //     return view('frontend.contact');
    // }
}
