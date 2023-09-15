@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                    <div class="text-center">
                        <h1>{{ __("Participants à la session") }}</h1>
                    </div>

                    <div class="mt-4">
                        <form action="{{ url('bookingSports') }}" method="POST">
                            @csrf

                            <input type="hidden" name="date" value="{{ $date }}">
                            <input type="hidden" name="field_id" value="{{ $field_id }}">
                            <input type="hidden" name="timeslot_id" value="{{ $timeslot_id }}">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="mb-3">
                                    <label for="search{{ $i }}" class="form-label" style="color: white;">Membre {{ $i }} :</label>
                                    <div class="search-wrapper">
                                        <input type="text" class="form-control search-input" id="search{{ $i }}" data-id="userList{{ $i }}">
                                        <ul class="search-results" id="userList{{ $i }}"></ul>
                                    </div>
                                    <input type="hidden" name="selectedUsers[]" id="selectedUsers{{ $i }}" value="">
                                </div>
                            @endfor

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
