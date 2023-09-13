@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #333333; color: #FFFFFF; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div style="border: 1px solid #FFA500; padding: 25px; border-radius: 10px; background-color: #555555;">
                <div class="text-center">
                    <h1>Vérifiez votre adresse mail</h1>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un nouveau lien de vérification vous a été envoyé par mail.
                        </div>
                    @endif

                    <p>Pour pouvoir accéder à cette page, veuillez confirmer votre inscription via le lien envoyé par mail. Si vous n'avez pas reçu le lien de vérification, demandez-en un autre en cliquant
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="color: #FFA500;">ici</button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
