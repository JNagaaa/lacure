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
                                    @if ($key !== count($reservations) - 1)
                                        <hr style="border-color: #FFA500;">
                                    @endif
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

