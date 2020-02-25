@extends('layouts.general')

@section('contenu')
    <h2>La page perso de {{$utilisateur->name}}</h2>

    @auth
        @if(Auth::id() != $utilisateur->id)
            @if(Auth::user()->jeLesSuit->contains($utilisateur->id))
                <a href="/suivre/{{$utilisateur->id}}">Ne plus suivre</a>
            @else
                <a href="/suivre/{{$utilisateur->id}}">Suivre</a>
            @endif

        @endif
    @endauth

    <ul>
        <li>{{$utilisateur->chansons()->count()}} chansons uploadées</li> <!--// avec count() -> permet de récupérer directement le nb de chansons sans lire toutes les données-->
        <li>Il suit {{$utilisateur->jeLesSuit()->count()}} personnes</li>
        <li>Il est suivi par {{$utilisateur->ilsMeSuivent()->count()}} personnes</li>
    </ul>

    @include("firstcontroller._chansons", ["chansons" => $utilisateur->chansons])
@endsection
