@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card" style="border: 1px solid #FFA500; border-radius: 10px; background-color: #555555;">
                <div class="text-center">
                    <h1 class="text-white m-3">Mes réservations</h1>

                    <div class="container text-center pb-3">
                        <select id="reservationTypeSelect" class="form-select" data-base-url={{$user->id}}>
                            <option value="all" style="background-color: #555555; color: #FFFFFF;">Toutes mes réservations</option>
                            <option value="sport" style="background-color: #555555; color: #FFFFFF;">Réservations sportives</option>
                            <option value="horeca" style="background-color: #555555; color: #FFFFFF;">Réservations Horeca</option>
                        </select>
                    </div>

                    <div id="reservationsList">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card" style="border: 1px solid #FFA500; border-radius: 10px; background-color: #555555;">
                                        <div class="card-header" style="background-color: #443f39; color: #FFFFFF;">Horeca</div>
                                        <div class="card-body" style="background-color: #333333;">
                                            @foreach($reservations as $key => $reservation)
                                                @if ($reservation->section_id == 1)
                                                    <a href="{{ url('/users/reservations/one/' . $reservation->id) }}" class="reservation-link">
                                                        <div class="mb-3 @if ($key === count($reservations) - 1) mb-0 @endif">
                                                            <p class="m-0 text-white">Date: {{ $reservation->date }}</p>
                                                            <p class="m- text-white">Heure: {{ $reservation->timeslot->start_time }}</p>
                                                        </div>
                                                        @if ($key !== count($reservations) - 1)
                                                            <hr style="border-color: #FFA500;">
                                                        @endif
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card" style="border: 1px solid #FFA500; border-radius: 10px; background-color: #555555;">
                                        <div class="card-header" style="background-color: #443f39; color: #FFFFFF;">Sports</div>
                                        <div class="card-body" style="background-color: #333333;">
                                            @foreach($reservations as $key => $reservation)
                                                @if ($reservation->section_id != 1)
                                                    <a href="{{ url('/users/reservations/one/' . $reservation->id) }}" class="reservation-link">
                                                        <div class="mb-3 @if ($key === count($reservations) - 1) mb-0 @endif">
                                                            <p class="m-0 text-white">Date: {{ $reservation->date }}</p>
                                                            <p class="m-0 text-white">Heure: de {{ $reservation->timeslot->start_time }} à {{ $reservation->timeslot->end_time }}</p>
                                                        </div>
                                                        @if ($key !== count($reservations) - 1)
                                                            <hr style="border-color: #FFA500;">
                                                        @endif
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
