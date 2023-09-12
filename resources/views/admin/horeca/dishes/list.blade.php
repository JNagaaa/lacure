@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Liste des plats</h2>
                </div>
                <div class="me-1 ms-1">
                    <div id="success-message-container">

                    </div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="text-center">
                        <button id="addDishContent" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Plats</button>
                        <button id="addDishTypeContent" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Types de plat</button>
                    </div>

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
