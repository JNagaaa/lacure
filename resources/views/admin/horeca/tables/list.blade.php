@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Liste des tables</h2>
                </div>
                <div class="me-1 ms-1">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <a href="/admin/horeca/tables/create" class="btn btn-primary d-flex justify-content-center mb-2" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">Ajouter une nouvelle table</a>
                    <div id="tables-list">
                        @foreach($tables as $table)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __("Table numéro $table->number") }}
                                <div>
                                    <a href="{{ url('/admin/horeca/tables/edit/'.$table->id) }}" class="btn btn-warning active" role="button">Modifier</a>
                                    <a href="{{ url('tables/delete/'.$table->id) }}" class="btn btn-danger active" role="button" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette table?')">Supprimer</a>
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
