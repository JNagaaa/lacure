@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Modification d'un plat</h2>
                </div>
                <div class="me-1 ms-1">
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
                            <label for="name" class="col-md-4 col-form-label text-md-end" style="color: #FFFFFF;">Name</label>

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
                            <label for="image" class="col-md-4 col-form-label text-md-end" style="color: #FFFFFF;">Photo</label>

                            <div class="col-md-6">
                                <input id="imgload" type="file" class="form-control" name="image" onchange="onFileSelected(event)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end" style="color: #FFFFFF;">Type</label>

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
                            <label for="price" class="col-md-4 col-form-label text-md-end" style="color: #FFFFFF;">Prix</label>

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
                            <label for="description" class="col-md-4 col-form-label text-md-end" style="color: #FFFFFF;">Description</label>

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
                            <div class="col-md-6 offset-md-4 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">
                                    Modifier
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
