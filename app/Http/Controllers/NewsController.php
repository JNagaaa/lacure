<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsPublished;
use App\Jobs\SendBulkEmail;



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
        if($request->image != NULL)
        {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('images', $imageName);
        }

        $news = new News([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $request->input('image') == NULL ? 'defaultNews.png' : $imageName,
            'section_id' => $request->input('section_id'),
        ]);
    
        $news->save();
    
        dispatch(new SendBulkEmail($news))->onQueue('bulk_email'); // Envoie le job à la file d'attente 'bulk_email'
        if($news->section_id == 1)
        {
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

            $drink->update();

            return redirect('/admin/horeca/news/one/' . $id)->with('success', 'Actualité modifiée avec succès!');
        }

    


}
