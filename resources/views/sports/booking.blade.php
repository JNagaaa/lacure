@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Recherche d'utilisateurs") }}</div>

                <div class="card-body">
                    <form action="{{ url('bookingSports') }}" method="POST">
                        @csrf

                        {{-- Champs cachés pour stocker les valeurs de $data, $field_id et $timeslot_id --}}
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="field_id" value="{{ $field_id }}">
                        <input type="hidden" name="timeslot_id" value="{{ $timeslot_id }}">

                        @for ($i = 1; $i <= 4; $i++)
                            <div class="mb-3">
                                <label for="search{{ $i }}" class="form-label">Recherche {{ $i }} :</label>
                                <div class="search-wrapper">
                                    <input type="text" class="form-control search-input" id="search{{ $i }}" data-id="userList{{ $i }}">
                                    <ul class="search-results" id="userList{{ $i }}"></ul>
                                </div>
                                <input type="hidden" name="selectedUsers[]" id="selectedUsers{{ $i }}" value="">
                            </div>
                        @endfor

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
