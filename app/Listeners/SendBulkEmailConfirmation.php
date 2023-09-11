<?php

namespace App\Listeners;

use App\Events\BulkEmailSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBulkEmailConfirmation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BulkEmailSent $event)
    {
        $batchSize = $event->batchSize;
        \Log::info("Envoyé avec succès un groupe de $batchSize e-mails.");

        // Ajoutez ici votre code pour afficher un message de confirmation à l'utilisateur
    }
}
