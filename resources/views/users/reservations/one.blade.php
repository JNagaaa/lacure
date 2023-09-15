@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="border: 1px solid #FFA500; padding: 30px; border-radius: 15px; background-color: #555555;">
                    <div class="text-center pb-3">
                        <h2>Détails de la réservation</h2>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 text-right">
                            <strong>Date:</strong>
                        </div>
                        <div class="col-md-6 text-left">
                            {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 text-right">
                            <strong>Heure de début:</strong>
                        </div>
                        <div class="col-md-6 text-left">
                            {{ $reservation->timeslot->start_time }}
                        </div>
                    </div>

                    @if ($reservation->section_id == 1)
                        <div class="row mb-4">
                            <div class="col-md-6 text-right">
                                <strong>Table:</strong>
                            </div>
                            <div class="col-md-6 text-left">
                                <p>{{ $reservation->table->number }} ({{ $reservation->table->capacity }} personnes)</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 text-right">
                                <strong>Téléphone de contact:</strong>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ $reservation->phone }}
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 text-right">
                                <strong>Remarques:</strong>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ $reservation->comment }}
                            </div>
                        </div>
                    @else

                        <div class="row mb-4">
                            <div class="col-md-6 text-right">
                                <strong>Heure de fin:</strong>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ $reservation->timeslot->end_time }}
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 text-right">
                                <strong>Terrain:</strong>
                            </div>
                            <div class="col-md-6 text-left">
                                <p>{{ $reservation->field->number }} ({{ $reservation->field->type }})</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 text-right">
                                <strong>Utilisateurs inscrits :</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled pl-3">
                                    @foreach($reservation->users as $user)
                                        <li><a href="{{ url('/users/one/' . $user->id) }}" style="color: #FFA500;">{{ $user->name }} {{ $user->lastname }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a class="btn btn-primary btn-sm" href="{{ url('/users/reservations/delete/'.$reservation->id) }}" onclick="return confirm('Souhaitez-vous vraiment annuler cette réservation?')" style="background-color: #FFA500; border-color: #FFA500;">
                            Annuler
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
