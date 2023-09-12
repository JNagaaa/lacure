@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2 class="text-center">{{ __('Liste des utilisateurs') }}</h2>
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un utilisateur">
                    </div>

                    <div id="users-list" class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
