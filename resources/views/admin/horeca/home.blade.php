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
                            <a href='/admin/horeca/dishes/list' class="btn btn-primary btnAdmin btnDishes btn-lg m-3 rounded-pill">
                                {{ __('Plats')}}
                            </a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/horeca/drinks/list' class="btn btn-primary btnAdmin btnDrinks btn-lg m-3 rounded-pill">
                                {{ __('Boissons')}}
                            </a>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href='/admin/horeca/tables/list' class="btn btn-primary btnAdmin btnTables btn-lg m-3 rounded-pill">
                                {{ __('Tables')}}
                            </a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/horeca/timeslots/list' class="btn btn-primary btnAdmin btnTimeslots btn-lg m-3 rounded-pill">
                                {{ __('Plages horaires')}}
                            </a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href='/admin/horeca/news/list' class="btn btn-primary btnAdmin btnNews btn-lg m-3 rounded-pill">
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
