<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationNotification extends Notification
{
    use Queueable;

    private $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'message' => '<div class="notification-title border-bottom pb-2"><a href="' . route('reservation.show', ['id' => $this->reservation->id]) . '" style="text-decoration: none; color: black; display: block; width: 100%;">Une nouvelle réservation a été effectuée.'
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
