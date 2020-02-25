@extends('layouts.general')
@section('contenu')
    <div class="fondbleu pageconnexion">
        <div class="choix">
            <div id="choixconnexion" class="connexion choixactif">Connexion</div>
            <div id="choixinscription" class="inscription">Inscription</div>
        </div>
        <div class="formulaires">
            @include('auth.login')
            @include('auth.register')
        </div>
    </div>

@endsection
