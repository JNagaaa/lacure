<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

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
        $allNews = News::where('section_id', 2)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin/sports/news/list', compact('allNews'));
    }

    public function listNewsHoreca()
    {
        $allNews = News::where('section_id', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin/horeca/news/list', compact('allNews'));
    }

    public function editNews($id)
    {
        $news = News::find($id);
        return view('admin/sports/news/edit', compact('news'));
    }

    public function editNewsHoreca($id)
    {
        $news = News::find($id);
        return view('admin/horeca/news/edit', compact('news'));
    }

    public function updateNews(Request $request, $id)
    {
        $news = News::Find($id);
        
        $news->title = $request->title;
        $news->content = $request->content;

        $news->update();

        return redirect('/admin/sports/news/edit/' . $id)->with('success', 'Actualité modifiée avec succès!');
    }

    public function updateNewsHoreca(Request $request, $id)
    {
        $news = News::Find($id);
            
        $news->title = $request->title;
        $news->content = $request->content;

        if($request->image)
        {
            Storage::delete('images/'.$news->image);
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $imageName = time().'.'.$request->image->extension();
            
            $news->image = $imageName;
            $request->image->storeAs('images', $imageName);
        }

        

        $news->update();

        return redirect('/admin/horeca/news/edit/' . $id)->with('success', 'Actualité modifiée avec succès!');
    }

    public function deleteNews($id)
    {
        $news = News::find($id);

        $news->delete();

        return redirect('/admin/sports/news/list')->with('success', 'Actualité supprimée avec succès!');
    }

    public function deleteNewsHoreca($id)
    {
        $news = News::find($id);

        $news->delete();

        return redirect('/admin/horeca/news/list')->with('success', 'Actualité supprimée avec succès!');
    }


    //Gestion des utilisateurs
    public function users()
    {
        return view('admin/users');
    }


}
