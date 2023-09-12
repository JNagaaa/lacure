@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Réserver une table</h2>
                </div>
                <input type="date" id="bookingTableDate" min="{{ date('Y-m-d') }}" value="{{ $date }}" class="form-control mb-3">

                <div class="row justify-content-center">
                    @foreach($tables as $table)
                        <div class="col-lg-4 col-md-6 col-12 mb-2" style="min-width: 150px; border: 1px solid #FFA500; border-radius: 10px; background-color: #443f39;">

                            <div class="text-center" style="color: #FFFFFF; padding: 10px;">
                                <h3>{{ __("Table $table->number ($table->capacity personnes)")}}</h3>
                            </div>

                            <div class="me-1 ms-1" style="background-color: #333333;">
                                @foreach($timeslots as $timeslot)
                                    @php
                                        $isTimeslotAvailable = true;
                                        $reservationUsers = [];
                                        if(!empty($reservations))
                                        {
                                            foreach ($reservations as $reservation) {
                                                if ($reservation->timeslot_id === $timeslot->id && $reservation->table_id === $table->id) {
                                                    $isTimeslotAvailable = false;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    @if($isTimeslotAvailable)
                                    <a href="{{ route('bookingTable', ['date' => $date, 'table_id' => $table->id, 'timeslot_id' => $timeslot->id]) }}" class="btn btn-primary btn-lg mb-2" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">
                                        {{ $timeslot->start_time }}
                                    </a>
                                    <br>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-lg mb-2" disabled style="width: 100%;">
                                            {{ $timeslot->start_time }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
