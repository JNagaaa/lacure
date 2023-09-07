@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Quoi de neuf côté sports?') }}</div>

                <div class="card-body text-center">
                    @if(isset($allNews) && $allNews->isNotEmpty())
                        @foreach($allNews as $news)
                            <div class="mb-4 p-3 border rounded">
                                <h3>{{ $news->title }}</h3>
                                @if($news->image != 'defaultNews.png')
                                <img src="{{ url('storage/' . $news->image) }}" alt="Image de la news" class="img-fluid mb-2">
                                @endif                                
                                <?= $news->content ?>
                                <p class="text-muted">Publiée le {{ $news->created_at->format('d/m/Y H:i') }}</p>
                                @if($news->updated_at && $news->updated_at != $news->created_at)
                                    <p class="text-muted">Modifiée le {{ $news->updated_at->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        @endforeach
                                
                        <nav aria-label="...">
                            <ul class="pagination justify-content-center">
                                {{-- Previous Page Link --}}
                                @if ($allNews->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
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
                                        <span class="page-link">Next</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @else
                        <p>Aucune actualité disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection








