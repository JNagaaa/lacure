@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __("Profil de $user->name $user->lastname") }}
                    <div>
                        @if($user->image != NULL)
                            <img style="width:120px; height:120px; border-radius:50%; margin-bottom:5px;" src="{{url('storage/'.$user->image)}}">
                        @else
                            <img style="width:120px; height:120px; border-radius:50%; margin-bottom:5px;" src="{{url('images/default.png')}}">
                        @endif
                    </div>
                </div>

                <div class="card-body text-center">
                    <h3>{{ __("$user->name $user->lastname") }}</h3>
                    <p>{{ __("Adresse mail: $user->email") }}</p>
                    {{ __("Newsletter: $user->newsletter") }}
                    @if($user->id == Auth::user()->id || Auth::user()->admin == 1)
                        @if($user->id != 1)
                            <div style="text-align:center">
                                <a href="{{ url('/users/edit/'.$user->id) }}" class="btn btn-primary btn-sm">Modifier le profil</a>
                                <a class="btn btn-primary btn-sm" href="{{ url('/user/delete/'.$user->id) }}" onclick="return confirm('En cliquant sur OK, le compte sera définitivement supprimé de la plateforme. Souhaitez-vous continuer?')">Supprimer le profil</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
