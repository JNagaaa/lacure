<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class SendRenewalNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $users = User::where('member', 1)->get();
        $usersToNotify = [];
        foreach($users as $user)
        {
            $dateMember = Carbon::parse($user->date_member);
            $dateMemberPlusOneMonth = $dateMember->addMonth();
            $sevenDaysBeforeExpiry = $dateMemberPlusOneMonth->subDays(8);
            if($user->date_member == $sevenDaysBeforeExpiry->addDays(8)->subMonth())
            {
                $usersToNotify->push($user);
            }
        }
        
        // Récupérez les utilisateurs avec date_member + 1 mois - 7 jours

        foreach ($usersToNotify as $user) {
            // Envoyez une notification à chaque utilisateur
            $user->notify(new RenewalNotification());
        }
    }
}
