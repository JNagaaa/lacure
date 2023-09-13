@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center">
                    <h1>{{ __('Menu') }}</h1>

                    <div class="text-center pb-3 d-flex justify-content-center flex-wrap">
                        <button id="dishesBtn" class="md-me-2 sm-me-2 btn btn-primary btnAdmin btnDishes btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">Afficher les plats</button>
                        <br>
                        <button id="drinksBtn" class="md-ms-2 sm-ms-2 btn btn-primary btnAdmin btnDrinks btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">Afficher les boissons</button>
                    </div>

                    <div id="dishesNull" data-base-url="{{ url('images/') }}"></div>
                    <div id="drinksNull" data-base-url="{{ url('images/') }}"></div>

                    <div id="dishes" data-base-url="{{ url('storage/') }}" style="color: #FFFFFF;"></div>

                    <div id="drinks" data-base-url="{{ url('storage/') }}" style="color: #FFFFFF;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
