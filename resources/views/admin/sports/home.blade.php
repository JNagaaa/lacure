@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Administration du portail Sports') }}</div>

                <div class="card-body">
                    <h1>Que souhaitez-vous gérer?</h1>
                    <ul>
                        <li>
                            <a href='/admin/sports/fields/list'>
                                Terrains
                            </a>
                        </li>
                        <li>
                            <a href='/admin/sports/reservations/list'>
                                Réservations
                            </a>
                        </li>
                        <li>
                            <a href='/admin/sports/timeslots/list'>
                                Plages horaires
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
