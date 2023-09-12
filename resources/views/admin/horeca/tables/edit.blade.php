@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;"">
                <div class="text-center pb-2">
                    <h2>Modification de la table numéro {{ $table->number }}</h2>
                </div>
                <div class="me-1 ms-1">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ url('tables/update/'.$table->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="number" class="col-md-4 col-form-label text-md-end">Numéro</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('name') is-invalid @enderror" name="number" value="{{ $table->number }}" required autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="capacity" class="col-md-4 col-form-label text-md-end">Capacité</label>

                            <div class="col-md-6">
                                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ $table->capacity }}" required autocomplete="capacity" autofocus>

                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="availability" class="col-md-4 col-form-label text-md-end">Disponibilité</label>
                            <div class="col-md-6">
                                <input id="availability" type="checkbox" class="form-check-input" name="availability" {{ $table->availability ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">
                                    Modifier la table
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
