@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>{{ __('Liste des terrains') }}</h2>
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <a href="/admin/sports/fields/create" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">
                        Ajouter un nouveau terrain
                    </a>

                    <select id="field-type" class="form-select mt-3 text-center" style="border: 1px solid #FFA500;">
                        <option value="all">Tous les terrains</option>
                        <option value="Tennis">Terrains de Tennis</option>
                        <option value="Padel">Terrains de Padel</option>
                    </select>
                    
                    <div class="row mt-3" id="fields-list">
                        @foreach($fields as $field)
                            <div class="col-md-6 mb-3">
                                <div class="card" style="background-color: #555555; border: 1px solid #FFA500; border-radius: 10px;">
                                    <div class="card-body">
                                        <h5 class="card-title text-white text-center">{{ __("Terrain numéro $field->number") }}</h5>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ url('/admin/sports/fields/edit/'.$field->id) }}" class="btn btn-warning active" role="button">Modifier</a>
                                            <a href="{{ url('fields/delete/'.$field->id) }}" class="btn btn-danger active" role="button" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce terrain?')">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
