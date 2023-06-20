@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des terrains') }}</div>

                <div class="card-body">

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <a href="/admin/sports/fields/create">
                        Ajouter un nouveau terrain
                    </a>

                    <select id="field-type" class="form-control">
                        <option value="all">Tous les terrains</option>
                        <option value="Tennis">Terrains de Tennis</option>
                        <option value="Padel">Terrains de Padel</option>
                    </select>
                    
                    <div id="fields-list">
                        @foreach($fields as $field)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __("Terrain numéro $field->number") }}
                                <div>
                                    <a href="{{ url('/admin/sports/fields/edit/'.$field->id) }}" class="btn btn-warning active" role="button">Modifier</a>
                                    <a href="{{ url('fields/delete/'.$field->id) }}" class="btn btn-danger active" role="button" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce terrain?')">Supprimer</a>
                                </div>
                            </li>
                        @endforeach
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
