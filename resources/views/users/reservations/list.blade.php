<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Horeca</div>
                <div class="card-body">
                    @foreach($reservations as $key => $reservation)
                        @if ($reservation->section_id == 1)
                            <a href="{{ url('/users/reservations/one/' . $reservation->id) }}" class="reservation-link">
                                <div class="mb-3 @if ($key === count($reservations) - 1) mb-0 @endif">
                                    <p class="m-0">Date: {{ $reservation->date }}</p>
                                    <p class="m-0">Heure: {{ $reservation->timeslot->start_time }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Sports</div>
                <div class="card-body">
                    @foreach($reservations as $key => $reservation)
                        @if ($reservation->section_id != 1)
                            <a href="{{ url('/users/reservations/one/' . $reservation->id) }}" class="reservation-link">
                                <div class="mb-3 @if ($key === count($reservations) - 1) mb-0 @endif">
                                    <p class="m-0">Date: {{ $reservation->date }}</p>
                                    <p class="m-0">Heure: de {{ $reservation->timeslot->start_time }} à {{ $reservation->timeslot->end_time }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>