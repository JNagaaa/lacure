@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center">
                    <h1>Informations complémentaires</h1>

                    <form action="{{ url('bookingHoreca') }}" method="POST">
                        @csrf

                        <!-- Champs cachés pour stocker les valeurs de $data, $table_id et $timeslot_id -->
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="table_id" value="{{ $table_id }}">
                        <input type="hidden" name="timeslot_id" value="{{ $timeslot_id }}">

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">N° de téléphone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="price" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">Remarques (allergies, intolérances...)</label>

                            <div class="col-md-6">
                                <textarea id="comment" style="height:100px;" class="form-control @error('comment') is-invalid @enderror" name="comment" required autocomplete="comment" autofocus>{{ old('comment') }}</textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
