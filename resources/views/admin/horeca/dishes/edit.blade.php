@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Création d'un plat") }}</div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    
                    <a href="/admin/horeca/dishes/list">{{ __("Retour à la liste des plats")}}</a>
                    <form method="POST" action="{{ url('dishes/update/'.$dish->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center">
                            @if($dish->image != 'defaultPlate.png')
                                <img style="width:120px; height:120px; border-radius:50%; margin-bottom:5px;" id="imgshow" src="{{url('storage/'.$dish->image)}}">
                            @else
                                <img style="width:120px; height:120px; border-radius:50%; margin-bottom:5px;" id="imgshow" src="{{url('images/defaultPlate.png')}}">
                            @endif
                        </div>

                        <div class="row mb-3">
                            
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Name") }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $dish->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="imgload" type="file" class="form-control" name="image" onchange="onFileSelected(event)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" type="text" class="form-control" name="type_id" required autocomplete="type_id">
                                    @foreach ($dishTypes as $dishType)
                                        <option value="{{ $dishType->id }}"
                                            @if ($dish->type_id == $dishType->id) selected @endif>
                                            {{ __($dishType->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __("Prix") }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $dish->price }}" required autocomplete="price" autofocus>

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
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ $dish->description }}</textarea>

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
                                    {{ __("Modifier") }}
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
