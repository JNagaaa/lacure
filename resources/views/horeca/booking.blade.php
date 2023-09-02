@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Participants à la session") }}</div>

                <div class="card-body">
                    <form action="{{ url('bookingHoreca') }}" method="POST">
                        @csrf

                        {{-- Champs cachés pour stocker les valeurs de $data, $field_id et $timeslot_id --}}
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="field_id" value="{{ $table_id }}">
                        <input type="hidden" name="timeslot_id" value="{{ $timeslot_id }}">

                        <div class="row mb-3">
                            
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __("N° de téléphone") }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="price" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __("Remarques (allergies, intolérances...)") }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" style="height:100px;" class="form-control @error('comment') is-invalid @enderror" name="comment" required autocomplete="comment" autofocus>{{ old('comment') }}</textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
