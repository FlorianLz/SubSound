@extends('layouts.general')
@section('contenu')
    <div id="formconnexion" class="container formconnexion">
        <div class="titre"><h2>Inscription</h2></div>
        <h3>Envie de faire partie de nos membres ?<br /> Inscrivez-vous dès maintenant !</h3>
        <form method="POST" action="{{ route('register') }}">
        @csrf
            <input id="name" type="text" class="input_form @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Identifiant...">

            <input id="email" type="email" class="input_form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Adresse email..." autofocus>

            <div class="mdp">
                <input id="password" type="password" class="input_form_password @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe...">

                <input id="password-confirm" type="password" class="input_form_password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation...">
            </div>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            @error('email')
            <span class="erreurlogin" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('password')
            <span class="erreurlogin" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <button type="submit" class="bouton_auth">
                {{ __('Inscription') }}
            </button>
        </form>
        <h3>Ou <a href="connexion" class="versinscription" data-pjax>connectez-vous</a> à votre compte !</h3>
    </div>
@endsection
