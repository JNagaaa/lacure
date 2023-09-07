@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Planning des réservations</div>
        <div class="card-body">

            <input type="date" id="bookingTableDate" min="{{ date('Y-m-d') }}" value="{{ $date }}">


            <div class="row">
                @foreach($tables as $table)
                    <div class="card col mb-3 me-1 p-0 text-center" style="min-width: 150px;">
                        <div class="card-header">
                            <h3>{{ __("Table $table->number ($table->capacity personnes)")}}</h3>
                        </div>

                        <div class="card-body me-1 ms-1">
                            @foreach($timeslots as $timeslot)
                                @php
                                    $isTimeslotAvailable = true;
                                    $reservationUsers = [];
                                    if(!empty($reservations))
                                    {
                                        foreach ($reservations as $reservation) {
                                            if ($reservation->timeslot_id === $timeslot->id && $reservation->table_id === $table->id) {
                                                $isTimeslotAvailable = false;
                                                // Vous pouvez récupérer les noms des utilisateurs associés à cette réservation si nécessaire
                                                // $reservationUsers = $reservation->users->pluck('name')->toArray();
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                @if($isTimeslotAvailable)
                                <a href="{{ route('bookingTable', ['date' => $date, 'table_id' => $table->id, 'timeslot_id' => $timeslot->id]) }}">
                                    {{ $timeslot->start_time }}
                                </a>
                                <br>
                                @else
                                    {{ $timeslot->start_time }}
                                    <br>
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
