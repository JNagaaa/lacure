<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\User;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function home($id)
    {
        $user = User::find($id);
        $reservations = Reservation::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();
        return view('users/reservations/home', compact('user', 'reservations'));
    }

    public function list($id)
    {
        $user = User::find($id);

        $reservations = Reservation::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->get();

        return view('users/reservations/list', compact('user', 'reservations'));
    }

    public function listSports($id)
    {
        $user = User::find($id);

        $reservations = Reservation::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->where('section_id', 2)
        ->get();

        return view('users/reservations/listSport', compact('user', 'reservations'));
    }

    public function listHoreca($id)
    {
        $user = User::find($id);

        $reservations = Reservation::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->where('section_id', 1)
        ->get();

        return view('users/reservations/listHoreca', compact('user', 'reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::Find($id);
        return view('users/reservations/one', compact('reservation'));
    }
}
