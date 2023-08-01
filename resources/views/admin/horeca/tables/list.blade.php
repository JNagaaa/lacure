@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des tables') }}</div>

                <div class="card-body">

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <a href="/admin/horeca/tables/create">
                        Ajouter une nouvelle table
                    </a>
                    
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
