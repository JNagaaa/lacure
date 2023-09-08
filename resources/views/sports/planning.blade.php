@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-white" style="background-color: #333333;">
        <div class="card-body">
            <div class="text-center pb-2">
                <h2>Réservation de terrain</h2>
            </div>
            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-md-4">
                    <input type="date" id="bookingDate" min="{{ date('Y-m-d') }}" value="{{ $date }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <select name="fieldType" id="fieldTypeSelect" class="form-select">
                        <option value="">Tous les terrains</option>
                        <option value="Tennis">Tennis</option>
                        <option value="Padel">Padel</option>
                    </select>
                </div>
            </div>

            <div class="row d-flex justify-content-center" id="fieldsContainer">
                @foreach($fields as $field)
                    <div class="card col-md-3 mb-3 me-1 p-0 text-center" style="min-width: 150px;">
                        <div class="card-header" style="height: 130px;">
                            <h3>Terrain {{ $field->number }}</h3>
                            @if($field->type == "Tennis")
                                <img src='{{ asset('src/img/tennis.webp') }}' style="width: 100px; padding-top: 10px;" class="img-fluid" alt="Terrain de Tennis"/>
                            @else
                                <img src='{{ asset('src/img/padel.png') }}' style="width: 85px;" class="img-fluid" alt="Terrain de Padel"/>   
                            @endif
                        </div>

                        <div class="card-body me-1 ms-1">
                            @foreach($timeslots as $timeslot)
                                @php
                                    $isTimeslotAvailable = true;
                                    $reservationUsers = [];
                                    if(!empty($reservations))
                                    {
                                        foreach ($reservations as $reservation) {
                                            if ($reservation->timeslot_id === $timeslot->id && $reservation->field_id === $field->id) {
                                                $isTimeslotAvailable = false;
                                                $reservationUsers = $reservation->users->pluck('lastname')->toArray();
                                            }
                                        }
                                    }
                                @endphp
                                @if($isTimeslotAvailable)
                                <a href="{{ route('booking', ['date' => $date, 'field_id' => $field->id, 'timeslot_id' => $timeslot->id, 'fieldType' => $field->type]) }}" class="btn btn-primary btn-sm mb-2">
                                    {{ $timeslot->start_time }} - {{ $timeslot->end_time }}
                                </a>
                                @else
                                    <p class="text-danger">{{ $timeslot->start_time }} - {{ $timeslot->end_time }} - Réservé par : {{ implode(', ', $reservationUsers) }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
