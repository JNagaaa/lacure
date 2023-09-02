@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Administration du portail Horeca') }}</div>

                <div class="card-body">
                    <h1>Que souhaitez-vous gérer?</h1>
                    <ul>
                        <li>
                            <a href='/admin/horeca/dishes/list'>
                                {{ __('Plats')}}
                            </a>
                        </li>
                        <li>
                            <a href='/admin/horeca/drinks/list'>
                                {{ __('Boissons')}}
                            </a>
                        </li>
                        <li>
                            <a href='/admin/horeca/tables/list'>
                                {{ __('Tables')}}
                            </a>
                        </li>
                        <li>
                            <a href='/admin/horeca/reservations/list'>
                                {{ __('Réservations')}}
                            </a>
                        </li>
                        <li>
                            <a href='/admin/horeca/timeslots/list'>
                                {{ __('Plages horaires')}}
                            </a>
                        </li>
                        <li>
                            <a href='/admin/horeca/news/list'>
                                {{ __('Actualités')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
