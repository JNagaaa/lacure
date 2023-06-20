@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Modification du terrain numéro $field->number") }}</div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <a href="/admin/sports/fields/list">{{ __("Retour à la liste des terrains")}}</a>
                    <form method="POST" action="{{ url('fields/update/'.$field->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            
                            <label for="number" class="col-md-4 col-form-label text-md-end">{{ __("Numéro") }}</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('name') is-invalid @enderror" name="number" value="{{ $field->number }}" required autocomplete="number" autofocus>

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
                                <select id="type" class="form-control" name="type" required autocomplete="type">
                                    <option id="tennis" value="Tennis" {{ $field->type === 'Tennis' ? 'selected' : '' }}>{{ __('Tennis') }}</option>
                                    <option id="padel" value="Padel" {{ $field->type === 'Padel' ? 'selected' : '' }}>{{ __('Padel') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="availability" class="col-md-4 col-form-label text-md-end">{{ __('Disponibilité') }}</label>
                            <div class="col-md-6">
                                <input id="availability" type="checkbox" class="form-check-input"  name="availability" {{ $field->availability ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Modifier le terrain") }}
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
