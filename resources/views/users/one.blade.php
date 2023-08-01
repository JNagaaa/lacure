@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Profil de $user->name $user->lastname") }}</div>

                <div class="card-body text-center">
                    <h3>{{ __("$user->name $user->lastname") }}</h3>
                    <p>{{ __("Adresse mail: $user->email") }}</p>
                    {{ __("Newsletter: $user->newsletter") }}
                    <div class="text-center">
                        <a href="{{ url('/users/edit/'.$user->id) }}" class="btn btn-primary btn-sm">Modifier le profil</a>
                        <a class="btn btn-primary btn-sm" href="{{ url('/users/delete/'.$user->id) }}" onclick="return confirm('En cliquant sur OK, votre compte sera définitivement supprimé de la plateforme. Souhaitez-vous continuer?')">Supprimer le profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
