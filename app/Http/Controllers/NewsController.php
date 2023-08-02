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
        $news = News::all();
        return view('admin/sports/news/list', compact('news'));
    }

    public function create()
    {
        return view('/admin/sports/news/create');
    }

    public function show($id)
    {
        $news = News::find($id);
        return view('/sports/news/one', compact('news'));
    }

    public function store(Request $request)
    {
        $users = User::where('newsletter', 1)->get();
        $news = new News(
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

        $news->save();
        
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewsPublished([
                'title' => $news->title,
                'content' => $news->content,
                'news_link' => route('news.show', ['id' => $news->id]),
            ]));
        }
    }


}
