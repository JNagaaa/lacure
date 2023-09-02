@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Création d'un plat") }}</div>

                <div class="card-body">
                    <a href="/admin/horeca/dishes/list">{{ __("Retour à la liste des plats")}}</a>
                    <form method="POST" action="{{ url('dishes/store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Nom") }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="text-align:center;">
                            <img src="{{ url('/images/defaultPlate.png') }}" id="imgshow" style="width:120px; height:120px; border-radius:10%; margin-bottom:10px;">
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="imgload" type="file" class="form-control" name="image">

                                @error('imgload')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" type="text" class="form-control" name="type_id" required autocomplete="type_id">
                                    @foreach ($dishTypes as $dishType)
                                        <option value=" {{ $dishType->id }} ">{{ __($dishType->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __("Prix") }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                    {{ __("Enregistrer le plat") }}
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
