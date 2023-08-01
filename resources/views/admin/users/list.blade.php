@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des utilisateurs') }}</div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <input type="text" id="searchInput" placeholder="Rechercher un utilisateur">

                    <div id="users-list">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
