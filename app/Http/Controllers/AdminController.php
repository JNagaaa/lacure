<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

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

    public function listNews()
    {
        $allNews = News::all();
        return view('admin/sports/news/list', compact('allNews'));
    }

    public function editNews($id)
    {
        $news = News::find($id);
        return view('admin/sports/news/edit', compact('news'));
    }

    public function updateNews(Request $request, $id)
    {
        $news = News::Find($id);
        
        $news->title = $request->title;
        $news->content = $request->content;

        $news->update();

        return redirect('/admin/sports/news/edit/' . $id)->with('success', 'Actualité modifiée avec succès!');
    }


    //Gestion des utilisateurs
    public function users()
    {
        return view('admin/users');
    }


}
