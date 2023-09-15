<div class="row justify-content-center" id="fieldsContainer">
    @foreach($fields as $field)
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card p-0 text-center" style="border: 1px solid #FFA500; border-radius: 10px; background-color: #443f39;">
                <div class="card-header" style="background-color: #443f39; color: #FFFFFF; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <h3>Terrain {{ $field->number }}</h3>
                    @if($field->type == "Tennis")
                        <img src='{{ asset('src/img/tennis.webp') }}' alt="Terrain de tennis" style="width: 100px; padding-top: 10px;" class="img-fluid" alt="Terrain de Tennis"/>
                    @else
                        <img src='{{ asset('src/img/padel.png') }}' alt="Terrain de padel" style="width: 85px;" class="img-fluid" alt="Terrain de Padel"/>   
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