@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Création d'une boisson") }}</div>

                <div class="card-body">
                    <a href="/admin/horeca/drinks/list">{{ __("Retour à la liste des boissons")}}</a>
                    <form method="POST" action="{{ url('drinks/store') }}">
                        @csrf

                        <div class="row mb-3">
                            
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Name") }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Sport') }}</label>

                            <div class="col-md-6">
                                <select id="type" type="text" class="form-control" name="type_id" required autocomplete="type_id">
                                    @foreach ($drinkTypes as $drinkType)
                                        <option value=" {{ $drinkType->id }} ">{{ __($drinkType->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __("Description") }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Enregistrer la boisson") }}
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
