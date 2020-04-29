@extends('layouts.general')
@section('contenu')
    <div id="formconnexion" class="container formconnexion">
        <div class="titre"><h2>Mot de passe oublié</h2></div>
        <h3>Tu as oublié ton mdp ?<br /> Pas de panique !</h3>
        <form method="POST" action="{{ route('password.update') }}">
        @csrf

            <input id="email" type="email" class="input_form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Adresse email..." autofocus>

            @error('email')
            <span class="erreurlogin" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="bouton_auth">
                {{ __('Réinitialiser mon mdp') }}
            </button>
        </form>
        <h3>Ou <a href="inscription" class="versinscription" data-pjax>connectez-vous</a> sans attendre !</h3>
    </div>
@endsection
