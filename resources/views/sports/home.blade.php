@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center">
                    <h1>Quoi de neuf côté Sports?</h1>

                    @if(isset($allNews) && $allNews->isNotEmpty())
                        @foreach($allNews as $news)
                            <div class="mb-4 p-3 border rounded" style="background-color: #555555;">
                                <h3 style="color: #FFFFFF;">{{ $news->title }}</h3>
                                @if($news->image != 'defaultNews.png')
                                    <img src="{{ url('storage/' . $news->image) }}" alt="Image de la news" class="img-fluid mb-2 w-100">
                                @endif                                
                                <?= $news->content ?>
                                <p class="text-white font-italic pt-3 pb-0">Publiée le {{ $news->created_at->format('d/m/Y H:i') }}</p>
                                @if($news->updated_at && $news->updated_at != $news->created_at)
                                    <p class="text-white font-italic pt-1">Modifiée le {{ $news->updated_at->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        @endforeach
                                
                        <nav aria-label="...">
                            <ul class="pagination justify-content-center">
                                {{-- Previous Page Link --}}
                                @if ($allNews->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Précédent</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allNews->previousPageUrl() }}" rel="prev" style="background-color: #FFA500; border-color: #FFA500; color: white;">Précédent</a>
                                    </li>
                                @endif
                        
                        
                                {{-- Next Page Link --}}
                                @if ($allNews->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allNews->nextPageUrl() }}" rel="next" style="background-color: #FFA500; border-color: #FFA500; color:white;">Suivant</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Suivant</span>
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
