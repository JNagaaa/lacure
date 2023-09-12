@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                    <div class="text-center">
                        <h1>Gestion portail Horeca</h1>
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href='/admin/horeca/dishes/list' class="btn btn-primary btnAdmin btnDishes btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                    {{ __('Plats')}}
                                </a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href='/admin/horeca/drinks/list' class="btn btn-primary btnAdmin btnDrinks btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                    {{ __('Boissons')}}
                                </a>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <a href='/admin/horeca/tables/list' class="btn btn-primary btnAdmin btnTables btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                    {{ __('Tables')}}
                                </a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href='/admin/horeca/timeslots/list' class="btn btn-primary btnAdmin btnTimeslots btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                    {{ __('Plages horaires')}}
                                </a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href='/admin/horeca/news/list' class="btn btn-primary btnAdmin btnNews btn-lg m-3 rounded-pill" style="background-color: #FFA500; border-color: #FFA500;">
                                    {{ __('Actualités')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
