<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewMemberNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;



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

        $users = User::where('member', 1)->get();
        
        return view('/users/one', compact('user'));

    }


    public function edit($id)
    {
        $user = User::Find($id);

        return view('/users/edit', compact('user'));

        return redirect('/admin/users/list/' . $id)->with('success', 'Utilisateur modifié avec succès!');
    }

    public function update(Request $request, $id)
    {
        $user = User::Find($id);
        
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->newsletter = $request->has('newsletter') ? 1 : 0;

        if($user->id != 1){
            $user->admin = $request->input('admin') == "on" ? 1 : 0;
        }

        if($request->image != NULL)
        {
            Storage::delete('images/'.$user->image);
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $imageName = time().'.'.$request->image->extension();
            
            $user->image = $imageName;
            $request->image->storeAs('images', $imageName);
        }

        if($request->input('member') == "on" && $user->member == 0)
        {
            $user->member = 1;
            $user->hrsremaining = 30;
            $user->date_member = now();
            $user->notify(new NewMemberNotification);
        }

        if($request->input('member') != "on" && $user->member == 1)
        {
            $user->member = 0;
            $user->date_member = NULL;
            $user->hrsremaining = 0;
            
        }
        $user->update();

        return redirect('/users/one/' . $id)->with('success', 'Profil modifié avec succès!');
    }

    public function renewMember($id)
    {
        $user = User::find($id);
        $user->date_member = now();
        $user->hrsremaining = 30;

        $user->update();

        return redirect('/users/one/' . $id)->with('success', 'Accès membre renouvelé avec succès!');

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
