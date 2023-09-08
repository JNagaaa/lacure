@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: none; background-color: #333333; color: white;">
                <div class="card-header" style="background-color: #ff6600; color: white;">{{ __('Accueil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p style="font-size: 1.2rem;">{{ __('Bienvenue sur le site internet du BATD La Cure!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
