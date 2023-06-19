<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SportsController extends Controller
{
    
    public function home()
    {
        return view('sports/home');
    }


    public function booking()
    {
        return view('sports/booking');
    }


    public function planning()
    {
        return view('sports/planning');
    }


}
