@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des boissons') }}</div>

                <div class="card-body">
                    <div id="success-message-container">

                    </div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <button id="addDrinkContent">Boissons</button>
                    <button id="addDrinkTypeContent">Types de boisson</button>
                    
                    <div id="drinksContent">
                        
                    </div>

                    <div id="drinksTypeContent">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
