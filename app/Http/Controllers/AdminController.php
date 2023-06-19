<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function horeca()
    {
        return view('admin/horeca');
    }


    public function sports()
    {
        return view('admin/sports');
    }


    public function users()
    {
        return view('admin/users');
    }
}
