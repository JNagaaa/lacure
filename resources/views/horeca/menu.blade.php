@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">

                    <div class="text-center pb-3">
                        <button id="dishesBtn">Afficher les plats</button>
                        <button id="drinksBtn">Afficher les boissons</button>
                    </div>

                    <div id="dishes">
                        
                    </div>

                    <div id="drinks">
                        
                    </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection
