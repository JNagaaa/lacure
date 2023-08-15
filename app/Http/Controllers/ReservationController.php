<?php

namespace App\Http\Controllers;
use App\Models\Reservation;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show($id)
    {
        $reservation = Reservation::Find($id);
        return view('sports/reservations/one', compact('reservation'));
    }
}
