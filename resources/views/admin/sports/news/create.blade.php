@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Création d'une actualité") }}</div>

                <div class="card-body">
                    <a href="/admin/sports/news/list">{{ __("Retour à la liste des actualités")}}</a>
                    <form method="POST" action="{{ url('news/store') }}">
                        @csrf

                        <div class="row mb-3">
                            
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __("Titre") }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <label for="content" class="col-md-4 col-form-label text-md-end">{{ __("Contenu") }}</label>

                            <div class="col-md-6">
                                <textarea id="content" class="tinymce-editor form-control @error('content') is-invalid @enderror" name="content" autocomplete="content">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Publier") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
