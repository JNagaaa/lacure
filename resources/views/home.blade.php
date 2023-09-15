@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                    <div class="text-center">
                        <h1>Bienvenue à La Cure</h1>
                        <p>Votre destination privilégiée pour une expérience culinaire de qualité et des moments sportifs mémorables!</p>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 text-center mb-4">
                            <h2>Menu du Restaurant</h2>
                            <img src="{{ url('images/plateHome.jpg') }}" alt="Image du plat" style="width:100%; border-radius: 10px;"/>
                            <p>Découvrez nos délicieux plats et boissons. De la cuisine authentique et faite maison.</p>
                            <a href="{{ url('horeca/menu') }}" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Voir le Menu</a>
                        </div>

                        <div class="col-md-4 text-center mb-4">
                            <h2>Réservations au Restaurant</h2>
                            <img src="{{ url('images/tableHome.jpg') }}" alt="Image de la table du restaurant" style="width:100%; border-radius: 10px;"/>
                            <p>Réservez votre table en quelques clics et profitez d'une ambiance chaleureuse.</p>
                            <a href="{{ url('/horeca/planning?date=' . \Illuminate\Support\Carbon::today()->format('Y-m-d')) }}" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Réserver une Table</a>
                        </div>

                        <div class="col-md-4 text-center">
                            <h2>Réservations Terrains</h2>
                            <img src="{{ url('images/fieldHome.jpg') }}" alt="Image des terrains de padel et de tennis" style="width:100%; border-radius: 10px;"/>
                            <p>Membres exclusifs? Réservez votre terrain de padel ou de tennis dès maintenant!</p>
                            <a href="{{ url('/sports/planning?date=' . \Illuminate\Support\Carbon::today()->format('Y-m-d')) }}" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Réserver un Terrain</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
