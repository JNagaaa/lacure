@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center">
                    <h1>Gestion portail Sports</h1>
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/sports/fields/list' class="btn btn-primary btnAdmin btnFields btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                {{ __('Terrains')}}
                            </a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/sports/timeslots/list' class="btn btn-primary btnAdmin btnTimeslots btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                {{ __('Plages horaires')}}
                            </a>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href='/admin/sports/news/list' class="btn btn-primary btnAdmin btnNews btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
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
