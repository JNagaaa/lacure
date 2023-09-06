@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    {{ __("Détails de la réservation") }}
                </div>

                <div class="card-body text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/users/reservations/' . Auth::user()->id) }}">Mes réservations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails de la réservation</li>
                        </ol>
                    </nav>
                    <p class="m-0">Date: {{ $reservation->date }}</p>
                    <p class="mt-0">Heure de début : {{ $reservation->timeslot->start_time }}</p>
                    
                    @if ($reservation->section_id == 2)
                        <p class="m-0">Heure de fin : {{ $reservation->timeslot->end_time }}</p>
                        <p class="m-0">Utilisateurs inscrits :</p>
                        <ul class="list-unstyled">
                            @foreach($reservation->users as $user)
                                <li><a href="{{ url('/users/one/' . $user->id) }}">{{ $user->name }} {{ $user->lastname }}</a></li>
                            @endforeach
                        </ul>
                    @endif

                    <div style="text-align:center">
                        <a class="btn btn-primary btn-sm" href="{{ url('/users/reservations/delete/'.$reservation->id) }}" onclick="return confirm('Souhaitez-vous vraiment annuler cette réservation?')">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
