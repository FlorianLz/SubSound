@extends('layouts.general')

@section('contenu')
    <div class="titre"><h2>La page perso de {{$utilisateurr->name}}</h2></div>

    @auth
        @if(Auth::id() != $utilisateurr->id)
            <div class="noUser">
                <div>
                    <img class="fit-user" src="{{$utilisateurr->url_avatar}}" alt="image utilisateur">
                    @auth
                        @if(Auth::id() != $utilisateurr->id)
                            @if(Auth::user()->jeLesSuit->contains($utilisateurr->id))
                                <a href="/suivre/{{$utilisateurr->id}}" class="suivre" data-pjax>Ne plus suivre</a>
                            @else
                                <a href="/suivre/{{$utilisateurr->id}}" class="suivre" data-pjax>Suivre</a>
                            @endif
                        @endif
                    @endauth
                </div>

        @else
            <div class="user">
                <a class="deconnexion_button" href="http://127.0.0.1:8000/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button" data-pjax="">
                    <p>Déconnexion</p>
                </a>
                <div>
                    <form action="/utilisateur/update/{{Auth::id()}}" method="POST"  enctype="multipart/form-data" data-pjax>
                        @csrf
                        <label for="avatar" class="label-file col us"><img class="fit-user" src="{{$utilisateurr->url_avatar}}" alt="image utilisateur"></label>
                        <input type="file" id="avatar" name="avatar" value="{{old('url')}}" class="input_file">
                        <input type="email" name="email" placeholder="Votre nouvelle Adresse mail..." class="input_form form" value="{{$utilisateurr->email}}">
                        <input type="password" name="password" placeholder="Votre nouveau mot de passe..." class="input_form form">
                        <input type="submit" value="Valider" class="bouton_aut">
                    </form>
                </div>
        @endif
    @endauth
                <div class="info">
                    @guest <img class="fit-user bas" src="{{$utilisateurr->url_avatar}}" alt="image utilisateur"> @endguest
                    @if(Auth::id() == $utilisateurr->id)
                        <h3>Vos statistiques</h3>
                    @else
                        <h3>Les statistiques de {{$utilisateurr->name}}</h3>
                    @endif
                    <ul>
                        <a href="/musiques/{{$utilisateurr->id}}" data-pjax><li>{{$utilisateurr->chansons()->count()}} chansons uploadées</li></a> <!--// avec count() -> permet de récupérer directement le nb de chansons sans lire toutes les données-->
                        <li>{{$utilisateurr->jeLesSuit()->count()}} abonnements</li>
                        <li>{{$utilisateurr->ilsMeSuivent()->count()}} abonnés</li>
                    </ul>
                </div>
            </div>
            </div>
@endsection
