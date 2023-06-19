<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorecaController extends Controller
{
    
    public function home()
    {
        return view('horeca/home');
    }


    public function booking()
    {
        return view('horeca/booking');
    }


    public function menu()
    {
        return view('horeca/menu');
    }


}
