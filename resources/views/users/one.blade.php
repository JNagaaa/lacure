@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    {{ __("Profil de $user->name $user->lastname") }}
                    <div>
                        @if($user->image != NULL)
                            @if($user->member == 1)
                                <div class="border border-warning rounded-circle" style="display: inline-block;">
                                    <img style="width:100px; height:100px; border-radius:50%;" src="{{url('storage/'.$user->image)}}">
                                </div>
                            @else
                                <img style="width:100px; height:100px; border-radius:50%;" src="{{url('storage/'.$user->image)}}">
                            @endif
                        @else
                            @if($user->member == 1)
                                <div class="border border-warning rounded-circle" style="display: inline-block;">
                                    <img style="width:100px; height:100px; border-radius:50%;" src="{{url('images/default.png')}}">
                                </div>
                            @else
                                <img style="width:100px; height:100px; border-radius:50%;" src="{{url('images/default.png')}}">
                            @endif
                        @endif
                    </div>
                    <div name="badges">
                    @if($user->member == 1)
                        <div class="badge bg-warning text-dark">Membre</div>
                    @endif
                    @if($user->admin == 1)
                        <div class="badge bg-success text-white">Administrateur</div>
                    @endif
                    </div>
                </div>

                <div class="card-body text-center">
                    <h3>{{ __("$user->name $user->lastname") }}</h3>
                    <p>{{ __("Adresse mail: $user->email") }}</p>
                    <p>{{ __("Newsletter: $user->newsletter") }}</p>
                    <p>{{ __("Sessions restantes: $user->hrsremaining") }}</p>
                    @if($user->id == Auth::user()->id || Auth::user()->admin == 1)
                        @if($user->id != 1)
                            <div style="text-align:center">
                                <a href="{{ url('/users/edit/'.$user->id) }}" class="btn btn-primary btn-sm">Modifier le profil</a>
                                <a class="btn btn-primary btn-sm" href="{{ url('/user/delete/'.$user->id) }}" onclick="return confirm('En cliquant sur OK, le compte sera définitivement supprimé de la plateforme. Souhaitez-vous continuer?')">Supprimer le profil</a>
                                @if($user->member && Auth::user()->admin == 1)
                                    <a href="{{ url('/users/renewMember/' . $user->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Vous apprêtez à renouveler l\'abonnement de ce membre. Confirmez-vous?')">Renouveler l'abonnement</a>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
