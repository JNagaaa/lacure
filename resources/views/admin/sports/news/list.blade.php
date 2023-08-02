@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Portail actualités') }}</div>

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <a href="/admin/sports/news/create">
                        Ajouter une nouvelle actualité
                    </a>

                    @if(isset($allNews))
                        @foreach($allNews as $news)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ url('admin/sports/news/edit/'.$news->id) }}"
                                    ><h3>{{ __($news->title) }}</h3>
                                </a>
                            </li>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
