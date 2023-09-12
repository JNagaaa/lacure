@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Portail actualités</h2>
                </div>
                <div class="me-1 ms-1">
                    <div id="success-message-container">

                    </div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <a href="/admin/horeca/news/create" class="btn btn-primary d-flex justify-content-center" style="background-color: #FFA500; border-color: #FFA500;">
                        Ajouter une nouvelle actualité
                    </a>
                    <ul class="list-group mt-3">
                        @if(isset($allNews))
                            @foreach($allNews as $news)
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #555555;">
                                    <a href="{{ url('admin/horeca/news/edit/'.$news->id) }}" style="color: #343a40; text-decoration: none;">
                                        <h3 class="text-white">{{ __($news->title) }}</h3>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <nav class="mt-2" aria-label="...">
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($allNews->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link btn btn-primary me-2">Précédent</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link btn btn-primary text-white me-2" style="background-color: #FFA500; border-color: #FFA500;" href="{{ $allNews->previousPageUrl() }}" rel="prev">Précédent</a>
                                </li>
                            @endif
                            {{-- Next Page Link --}}
                            @if ($allNews->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link btn btn-primary text-white" style="background-color: #FFA500; border-color: #FFA500;" href="{{ $allNews->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link ">Suivant</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
