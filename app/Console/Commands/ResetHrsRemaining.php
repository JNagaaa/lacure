<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ResetHrsRemaining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-hrsremaining';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Réinitialise l\'attribut hrsremaining des utilisateurs tous les premiers du mois.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Réinitialiser l'attribut "hrsremaining" à 15 pour tous les utilisateurs
        User::query()->update(['hrsremaining' => 15]);

        $this->info('L\'attribut hrsremaining des utilisateurs a été réinitialisé à 15.');
    }
}
