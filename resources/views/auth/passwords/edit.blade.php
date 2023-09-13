@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                    <div class="text-center">
                        <h1>Modification du mot de passe</h1>

                        <form action="{{ url('auth/passwords/update') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="oldPasswordInput" class="col-md-4 col-form-label text-md-end" style="color: white;">Mot de passe actuel</label>
                                <div class="col-md-6">
                                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput">
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPasswordInput" class="col-md-4 col-form-label text-md-end" style="color: white;">Nouveau mot de passe</label>
                                <div class="col-md-6">
                                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirmNewPasswordInput" class="col-md-4 col-form-label text-md-end" style="color: white;">Confirmation nouveau mot de passe</label>
                                <div class="col-md-6">
                                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput">
                                </div>
                            </div>

                            <div style="text-align: center;">
                                <button class="btn btn-primary" type="submit" style="background-color: #FFA500; border-color: #FFA500;">
                                    Modifier
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
