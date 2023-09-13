@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>{{ __("Création d'un nouveau terrain") }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('fields/store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="number" class="col-md-4 col-form-label text-md-end">{{ __("Numéro") }}</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Sport') }}</label>

                            <div class="col-md-6">
                                <select id="type" type="text" class="form-control" name="type" required autocomplete="type">
                                    <option id="tennis" name="tennis">{{ __('Tennis') }}</option>
                                    <option id="padel" name="padel">{{ __('Padel') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="availability" class="col-md-4 col-form-label text-md-end">{{ __('Disponibilité') }}</label>
                            <div class="col-md-6">
                                <input id="availability" type="checkbox" class="form-check-input" name="availability">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">
                                    {{ __("Enregistrer") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
