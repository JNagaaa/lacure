<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;



class ClearExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-expired-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();

        // Supprimer les réservations dont la date est supérieure à un mois
        Reservation::where('date', '<', $oneMonthAgo)->delete();

        $this->info('Les réservations expirées datant de plus d\'un mois ont été supprimées.');
    }

}
