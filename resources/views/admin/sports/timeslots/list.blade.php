@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Liste des plages horaires</h2>
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <div id="timeslotsContent">
                        <button id="create" class="btn btn-primary d-flex justify-content-center mb-2" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">Ajouter une nouvelle plage horaire</button>
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


