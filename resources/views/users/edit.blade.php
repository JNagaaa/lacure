@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>{{ __('Modification du profil') }}</h2>
                </div>
                <div style="text-align: center">
                    <a href="{{ url('/auth/passwords/edit') }}" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Modifier le mot de passe</a>
                </div>
                <div class="mt-3">
                    <form method="POST" action="{{ url('users/update/'.$user->id) }}" enctype="multipart/form-data">
                        @csrf

                        @if(Auth::user()->admin == 1)
                            <div class="row mb-3">
                                <label for="admin" class="col-md-4 col-form-label text-md-end">{{ __('Administrateur') }}</label>
                                <div class="col-md-6 d-flex align-items-center justify-content-start">
                                    <div class="form-check">
                                        <input class="form-check-input" name="admin" type="checkbox" @if($user->admin == 1) checked @endif @if($user->id == 1) disabled @endif>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(Auth::user()->admin == 1)
                            <div class="row mb-3">
                                <label for="member" class="col-md-4 col-form-label text-md-end">{{ __('Membre') }}</label>
                                <div class="col-md-6 d-flex align-items-center justify-content-start">
                                    <div class="form-check">
                                        <input class="form-check-input" name="member" type="checkbox" @if($user->member == 1) checked @endif>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="text-center mt-4">
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
                            <div class="col-md-6 d-flex align-items-center justify-content-start">
                                <div class="form-check">
                                    <input id="newsletter" type="checkbox" class="form-check-input @error('newsletter') is-invalid @enderror" name="newsletter" autofocus @if($user->newsletter) checked @endif>
                                </div>
                                @error('newsletter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #FFA500; border-color: #FFA500;">
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
