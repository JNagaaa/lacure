@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des plats') }}</div>

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
                    <button id="addDishContent">Plats</button>
                    <button id="addDishTypeContent">Types de plat</button>
                    
                    <div id="dishesContent">
                        
                    </div>

                    <div id="dishesTypeContent">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
