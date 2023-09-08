@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>


                <div class="text-center">
                    <h1>Gestion portail Horeca</h1>
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/sports/fields/list' class="btn btn-primary btnAdmin btnFields btn-lg m-3 rounded-pill">
                                {{ __('Terrains')}}
                            </a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/sports/timeslots/list' class="btn btn-primary btnAdmin btnTimeslots btn-lg m-3 rounded-pill">
                                {{ __('Plages horaires')}}
                            </a>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href='/admin/sports/news/list' class="btn btn-primary btnAdmin btnNews btn-lg m-3 rounded-pill">
                                {{ __('Actualités')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
