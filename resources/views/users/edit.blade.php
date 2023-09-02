@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modification du profil') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('users/update/'.$user->id) }}" enctype="multipart/form-data">
                        @csrf

                        @if(Auth::user()->admin == 1)
                            <div class="row mb-3">              
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="admin" type="checkbox" @if($user->admin == 1) checked @endif @if($user->id == 1) disabled @endif>
                                        <label class="form-check-label" >Administrateur</label>
                                    </div>
                                </div>
                            </div>
                            @endif

                        <div style="text-align:center;">
                            @if($user->image != NULL)
                                <img src="{{url('storage/'.$user->image)}}" id="imgshow" style="width:120px; height:120px; border-radius:50%;">
                            @else
                                <img src="{{url('images/default.png')}}" id="imgshow" style="width:120px; height:120px; border-radius:50%;">
                            @endif
                        </div>
                        <br>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ __("$user->name") }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ __("$user->lastname") }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image de profil') }}</label>

                            <div class="col-md-6">
                                <input id="imgload" type="file" class="form-control" name="image" onchange="onFileSelected(event)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newsletter" class="col-md-4 col-form-label text-md-end">{{ __('Newsletter') }}</label>
                            <div class="col-md-6">
                                <input id="newsletter" type="checkbox" class="form-check-input @error('newsletter') is-invalid @enderror" name="newsletter" autofocus @if($user->newsletter) checked @endif>
                                @error('newsletter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
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
