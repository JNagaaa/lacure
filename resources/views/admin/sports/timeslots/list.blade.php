@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des plages horaires') }}</div>

                <div class="card-body">

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    
                    
                    <div id="timeslotsContent">
                        <button id="create" class="rounded-pill">Ajouter une nouvelle plage horaire</button>
                        <div id="createTimeslot"></div>
                        @foreach($timeslots as $timeslot)
                            <li id="timeslot_{{ $timeslot->id }}" class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="timeslot">{{ __("$timeslot->start_time -> $timeslot->end_time") }}</span>
                                <div>
                                    <button type="button" class="edit-btn btn btn-warning active" role="button" data-id="{{ $timeslot->id }}">Modifier</button>
                                    <a href="{{ url('timeslots/delete/'.$timeslot->id) }}" class="delete-btn btn btn-danger active" role="button" data-id="{{ $timeslot->id }}">Supprimer</a>
                                </div>
                                <div class="edit-fields" style="display: none;">
                                    <input type="text" class="start-time" value="{{ $timeslot->start_time }}">
                                    <input type="text" class="end-time" value="{{ $timeslot->end_time }}">
                                    <button type="button" class="update-btn btn btn-success" data-id="{{ $timeslot->id }}">Enregistrer</button>
                                    <button type="button" class="cancel-btn btn btn-danger">Annuler</button>
                                </div>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
