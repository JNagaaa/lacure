@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center pb-2">
                    <h2>Création d'une actualité</h2>
                </div>
                <div class="me-1 ms-1">
                    <form method="POST" action="{{ url('news/storeHoreca') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Titre</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="text-align:center;">
                            <img src="{{ url('/images/defaultNews.png') }}" alt="Image de la news" id="imgshow" style="width:120px; height:120px; border-radius:10%; margin-bottom:10px;">
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">Photo d'illustration</label>

                            <div class="col-md-6">
                                <input id="imgload" type="file" class="form-control" name="image">

                                @error('imgload')
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

                        <input type="hidden" id="section_id" name="section_id" value="1"/>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">
                                    Publier
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
