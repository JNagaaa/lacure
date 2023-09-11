<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\ResetHrsRemaining::class,
        \App\Console\Commands\ClearExpiredReservations::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('user:reset-hrsremaining')->monthlyOn(1, '00:00');
        $schedule->job(new \App\Jobs\SendRenewalNotification)->daily();
        $schedule->command('email:send-bulk')->everyMinute();
        $schedule->command('clear:expired_reservations')->dailyAt('00:00');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('user:reset-hrsremaining')->monthlyOn(1, '00:00');
        });

        require base_path('routes/console.php');
    }
}
