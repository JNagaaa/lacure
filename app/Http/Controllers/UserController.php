<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list()
    {
        $users = User::all();
        return view('/admin/users/list', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('/users/one', compact('user'));

    }


    public function edit($id)
    {
        $user = User::Find($id);

        return view('/users/edit', compact('user'));

        return redirect('/admin/users/list/' . $id)->with('success', 'Utilisateur modifié avec succès!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

    // Diviser le terme de recherche en prénom et nom
    $names = explode(' ', $searchTerm);
    $firstName = isset($names[0]) ? $names[0] : '';
    $lastName = isset($names[1]) ? $names[1] : '';

    // Effectuer la recherche des utilisateurs en fonction du terme de recherche
    $query = User::query();

    if (!empty($firstName) || !empty($lastName)) {
        $query->where(function ($query) use ($firstName, $lastName) {
            if (!empty($firstName)) {
                $query->where('name', 'like', '%' . $firstName . '%')
                      ->orWhere('lastname', 'like', '%' . $firstName . '%');
            }
            if (!empty($lastName)) {
                $query->orWhere('name', 'like', '%' . $lastName . '%')
                      ->orWhere('lastname', 'like', '%' . $lastName . '%');
            }
        });
    } else {
        // Si les deux champs de recherche sont vides, ne renvoyer aucun utilisateur
        $query->where('id', null);
    }

    $users = $query->get();

    // Renvoyer les résultats de recherche au format JSON
    return response()->json(['users' => $users]);
    }
}
