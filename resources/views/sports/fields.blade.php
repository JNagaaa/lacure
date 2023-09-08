<div class="row d-flex justify-content-center">
    @foreach($fields as $field)
    <div class="card col-md-3 mb-3 me-1 p-0 text-center" style="min-width: 150px;">
        <div class="card-header">
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
