@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                    <div class="text-center pb-2">
                        <h1>Détails de la réservation</h1>
                    </div>
                    <div class="text-center">
                        <p class="m-0">Date: {{ $reservation->date }}</p>
                        <p class="mt-0">Heure de début : {{ $reservation->timeslot->start_time }}</p>

                        @if ($reservation->section_id == 1)
                            <p class="m-0">Téléphone de contact: {{ $reservation->phone }}</p>
                            <p class="m-0">Remarques: {{ $reservation->comment }}</p>
                        @else
                            <p class="m-0 p-0">Heure de fin : {{ $reservation->timeslot->end_time }}</p>
                            <p class="m-0">Utilisateurs inscrits :</p>
                            <ul class="list-unstyled">
                                @foreach($reservation->users as $user)
                                    <li><a href="{{ url('/users/one/' . $user->id) }}">{{ $user->name }} {{ $user->lastname }}</a></li>
                                @endforeach
                            </ul>
                        @endif

                        <div style="text-align:center">
                            <a class="btn btn-primary btn-sm" href="{{ url('/users/reservations/delete/'.$reservation->id) }}" onclick="return confirm('Souhaitez-vous vraiment annuler cette réservation?')" style="background-color: #FFA500; border-color: #FFA500;">
                                Annuler
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
