@extends('layouts.general')

@section('contenu')
    <div class="titre"><h2>La page perso de {{$utilisateur->name}}</h2></div>


    @auth
        @if(Auth::id() != $utilisateur->id)
            @if(Auth::user()->jeLesSuit->contains($utilisateur->id))
                <a href="/suivre/{{$utilisateur->id}}">Ne plus suivre</a>
            @else
                <a href="/suivre/{{$utilisateur->id}}">Suivre</a>
            @endif

        @endif
    @endauth

    <div class="user">
        <div>

            <form action="" method="POST" >
                <label for="chanson" class="label-file col us"><img class="fit-user" src="https://media.discopiu.com/img/2013/7/24/192072-large-avicii-wake-me-up.jpg" alt="image utilisateur"></label>
                <input type="file" id="chanson" name="chanson" value="{{old('url')}}" class="input_file" required>
                <input type="email" placeholder="Votre nouvelle Adresse mail..." class="input_form form">
                <input type="password" placeholder="Votre nouveaux mot de passe..." class="input_form form">
                <input type="submit" value="Valider" class="bouton_aut">
            </form>
        </div>

        <div class="info">
            <h3>Vos statistique</h3>
            <ul>
                <li>Nombres de chansons uploadées {{$utilisateur->chansons()->count()}} </li> <!--// avec count() -> permet de récupérer directement le nb de chansons sans lire toutes les données-->
                <li>Vous suivez {{$utilisateur->jeLesSuit()->count()}} personnes</li>
                <li>Vous etez suivi par {{$utilisateur->ilsMeSuivent()->count()}} personnes</li>
            </ul>
        </div>
    </div>




    <!-- @include("firstcontroller._chansons", ["chansons" => $utilisateur->chansons])-->


@endsection
