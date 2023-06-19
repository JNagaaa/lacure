<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    
    public function one($id)
    {
        $user = User::Find($id);
        return view('/profile/one', compact('user'));
    }


    public function edit($id)
    {
        $user = User::Find($id);
        return view('/profile/edit', compact('user'));
    }


    public function reservations($id)
    {
        $user = User::Find($id);
        return view('/profile/reservations', compact('user'));
    }

}
