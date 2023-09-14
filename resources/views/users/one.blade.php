@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>{{ __("$user->name $user->lastname") }}</h2>
                </div>
                <div class="text-center">
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
                <div class="text-center mt-3">
                    <p>{{ __("Adresse mail: $user->email") }}</p>
                    <p>
                        @if($user->newsletter == 1)
                            {{ __("Inscrit(e) aux newsletters") }}
                        @else
                            {{ __("Non inscrit(e) aux newsletters") }}
                        @endif
                    </p>
                    @if($user->member == 1)                    
                        <p>{{ __("Date adhésion membre: ") }}{{ \Carbon\Carbon::parse($user->date_member)->format('d/m/Y') }}</p>
                        <p>{{ __("Sessions restantes: $user->hrsremaining") }}</p>
                    @endif
                    @if($user->id == Auth::user()->id || Auth::user()->admin == 1)
                        @if($user->id != 1)
                        <div>
                            @if($user->member && Auth::user()->admin == 1)
                                <a href="{{ url('/users/renewMember/' . $user->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Vous apprêtez à renouveler l\'abonnement de ce membre. Confirmez-vous?')">Renouveler l'abonnement</a>
                            @endif
                            <a href="{{ url('/users/edit/'.$user->id) }}" class="btn btn-warning btn-sm">Modifier le profil</a>
                            <a class="btn btn-danger btn-sm" href="{{ url('/users/delete/'.$user->id) }}" onclick="return confirm('En cliquant sur OK, le compte sera définitivement supprimé de la plateforme. Souhaitez-vous continuer?')">Supprimer le profil</a>
                        </div>
                    @endif
                
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
