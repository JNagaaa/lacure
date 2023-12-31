<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{


    public function edit()
    {
        return view('auth/passwords/edit');
    }

    public function update(Request $request)
{
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(!Hash::check($request->old_password, Auth::user()->password)){
            return back()->with("error", "Votre mot de passe actuel n'est pas correct!");
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/users/one/'.Auth::user()->id)->with("status", "Mot de passe modifié avec succès!");
}
}
