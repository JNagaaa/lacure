@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px;">
                <div class="text-center pb-2">
                    <h2>Réserver un terrain</h2>
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

                <div class="row justify-content-center" id="fieldsContainer">
                    @foreach($fields as $field)
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card p-0 text-center" style="border: 1px solid #FFA500; border-radius: 10px; background-color: #443f39;">
                                <div class="card-header" style="background-color: #443f39; color: #FFFFFF; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <h3>Terrain {{ $field->number }}</h3>
                                    @if($field->type == "Tennis")
                                        <img src='{{ asset('src/img/tennis.webp') }}' style="width: 100px; padding-top: 10px;" class="img-fluid" alt="Terrain de Tennis"/>
                                    @else
                                        <img src='{{ asset('src/img/padel.png') }}' style="width: 85px;" class="img-fluid" alt="Terrain de Padel"/>   
                                    @endif
                                </div>

                                <div class="card-body p-2" style="background-color: #333333;">
                                    @foreach($timeslots as $timeslot)
                                        @php
                                            $isTimeslotAvailable = true;
                                            $reservationUsers = [];
                                            if(!empty($reservations))
                                            {
                                                foreach ($reservations as $reservation) {
                                                    if ($reservation->timeslot_id === $timeslot->id && $reservation->field_id === $field->id) {
                                                        $isTimeslotAvailable = false;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if($isTimeslotAvailable)
                                        <a href="{{ route('booking', ['date' => $date, 'field_id' => $field->id, 'timeslot_id' => $timeslot->id, 'fieldType' => $field->type]) }}" class="btn btn-primary btn-lg mb-2" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">
                                            {{ $timeslot->start_time }} - {{ $timeslot->end_time }}
                                        </a>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-lg mb-2" disabled style="width: 100%;">
                                                {{ $timeslot->start_time }} - {{ $timeslot->end_time }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
