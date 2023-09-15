<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsPublished;


class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('section_id', 2)->get();
        return view('admin/sports/news/list', compact('news'));
    }

    public function indexHoreca()
    {
        $news = News::where('section_id', 1)->get();
        return view('admin/horeca/news/list', compact('news'));
    }

    public function create()
    {
        return view('/admin/sports/news/create');
    }

    public function createHoreca()
    {
        return view('/admin/horeca/news/create');
    }

    public function show($id)
    {
        $news = News::find($id);
        return view('/sports/news/one', compact('news'));
    }



    public function store(Request $request)
    {
        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName);
        }

        $news = new News([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $request->image == NULL ? 'defaultNews.png' : $imageName,
            'section_id' => $request->input('section_id'),
        ]);

        $news->save();

        $subscribedUsers = User::where('newsletter', 1)->get();
        foreach ($subscribedUsers as $user) {
            Mail::to($user->email)->send(new NewsPublished([
                'title' => $news->title,
                'content' => $news->content,
                'news_link' => $request->section_id == 1 ? url('horeca/home') : url('sports/home')
            ]));
        }

        if ($news->section_id == 1) {
            return redirect('/horeca/home')->with('success', 'Actualité publiée avec succès!');
        } else {
            return redirect('/sports/home')->with('success', 'Actualité publiée avec succès!');
        }
    }


    public function update(Request $request, $id)
        {
            $news = News::Find($id);
            
            $news->title = $request->title;
            $news->content = $request->content;
            $news->image = $request->image;

            if($request->image != $news->image)
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

            return redirect('/admin/horeca/news/one/' . $id)->with('success', 'Actualité modifiée avec succès!');
        }

    


}
