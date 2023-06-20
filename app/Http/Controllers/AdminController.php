<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    //Gestion du contenu portail Horeca
    public function horeca()
    {
        return view('admin/horeca/home');
    }


    //Gestion du contenu portail Sports
    public function sports()
    {
        return view('admin/sports/home');
    }


    //Gestion des utilisateurs
    public function users()
    {
        return view('admin/users');
    }
}
