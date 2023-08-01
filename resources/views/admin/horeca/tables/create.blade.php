@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Création d'une nouvelle table") }}</div>

                <div class="card-body">
                    <a href="/admin/horeca/tables/list">{{ __("Retour à la liste des tables")}}</a>
                    <form method="POST" action="{{ url('tables/store') }}">
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
                            
                            <label for="capacity" class="col-md-4 col-form-label text-md-end">{{ __("Capacité") }}</label>

                            <div class="col-md-6">
                                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" required autocomplete="capacity" autofocus>

                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="availability" class="col-md-4 col-form-label text-md-end">{{ __('Disponibilité') }}</label>
                            <div class="col-md-6">
                                <input id="availability" type="checkbox" class="form-check-input" name="availability">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Enregistrer le terrain") }}
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
