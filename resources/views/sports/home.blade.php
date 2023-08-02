@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Accueil portail Sports') }}</div>

                <div class="card-body">
                    @if(isset($allNews))
                        @foreach($allNews as $news)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ url('sports/news/one/'.$news->id) }}"
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
