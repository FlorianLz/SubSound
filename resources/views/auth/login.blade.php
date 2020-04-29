@extends('layouts.general')
@section('contenu')
<div id="formconnexion" class="container formconnexion">
    <div class="titre"><h2>Connexion</h2></div>
    <h3>De retour parmi nous ?<br /> Connectez-vous dès maintenant !</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
            <!--<label for="email" class="col-md-4 col-form-label text-md-right textlabel">{{ __('E-Mail Address') }}</label>-->

                <input id="email" type="email" class="input_form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Adresse email..." autofocus>



            <!--<label for="password" class="col-md-4 col-form-label text-md-right textlabel">{{ __('Password') }}</label>-->

                <input id="password" type="password" class="input_form @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe...">

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


        <div class="remember">
            <label class="my_checkbox" for="remember">{{ __('Se souvenir de moi') }}
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            @if (Route::has('password.request'))
                <a class="mdpoublie" href="/resetmdp" data-pjax>
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="bouton_auth">
            {{ __('Connexion') }}
        </button>
    </form>
    <h3>Ou <a href="inscription" class="versinscription" data-pjax>rejoignez-nous</a> sans attendre !</h3>
</div>
@endsection
