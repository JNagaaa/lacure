<div class="row">
    @foreach($fields as $field)
        <div class="card col ms-3 mb-3 p-0 text-center" style="min-width: 150px;">
            <div class="card-header">
                <h3>Terrain {{ $field->number }}</h3>
                @if($field->type == "Tennis")
                    <img src='{{ asset('src/img/tennis.webp') }}' style="width: 100px; padding-top: 10px;"/>
                @else
                    <img src='{{ asset('src/img/padel.png') }}' style="width: 85px;"/>   
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
                    <a href="{{ route('booking', ['date' => $date, 'field_id' => $field->id, 'timeslot_id' => $timeslot->id, 'fieldType' => $field->type]) }}">
                        {{ $timeslot->start_time }} - {{ $timeslot->end_time }}
                    </a>
                    <br>
                    @else
                        {{ $timeslot->start_time }} - {{ $timeslot->end_time }} - Réservé par : {{ implode(', ', $reservationUsers) }}
                    <br>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
    
</div>