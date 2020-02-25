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
    <script>
        $(document).ready(function () {

            /* Page connexion */
            $('#choixinscription').click(function (e) {
                $('#choixinscription').addClass('choixactif');
                $('#choixconnexion').removeClass('choixactif');
                $('#forminscription').show();
                $('#formconnexion').hide();

            });
            $('#choixconnexion').click(function (e) {
                $('#choixconnexion').addClass('choixactif');
                $('#choixinscription').removeClass('choixactif');
                $('#forminscription').hide();
                $('#formconnexion').show();

            });

        });


    </script>

@endsection
