@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #343a40; color: #ffffff;">
                    {{ __('Portail actualités') }}
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <a href="/admin/sports/news/create" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">
                        Ajouter une nouvelle actualité
                    </a>

                    <ul class="list-group mt-3">
                        @if(isset($allNews))
                            @foreach($allNews as $news)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ url('admin/sports/news/edit/'.$news->id) }}"
                                        style="color: #343a40; text-decoration: none;"
                                    >
                                        <h3>{{ __($news->title) }}</h3>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($allNews->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Précédent</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $allNews->previousPageUrl() }}" rel="prev">Previous</a>
                                </li>
                            @endif
                    
                    
                            {{-- Next Page Link --}}
                            @if ($allNews->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $allNews->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Suivant</span>
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
