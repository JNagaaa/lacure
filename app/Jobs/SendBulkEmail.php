<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsPublished;
use Illuminate\Support\Facades\Log;
use Exception;



class SendBulkEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $news;
    protected $batchSize;

    public function __construct($news)
    {
        $this->news = $news;
    }

    public function handle()
    {
        try {
            $users = User::where('newsletter', 1)
                        ->get();


            foreach ($users as $user) {
                Mail::to($user->email)->send(new NewsPublished([
                    'title' => $this->news->title,
                    'content' => $this->news->content,
                    'image' => $this->news->image,
                    'news_link' => $this->news->section_id == 1 ? url('/horeca/home') : url('/sports/home'),
                ]));
            }

            event(new BulkEmailSent($this->batchSize));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de la newsletter : ' . $e->getMessage());

        }
    }
}
