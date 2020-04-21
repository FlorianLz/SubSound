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
                                <a href="/suivre/{{$utilisateurr->id}}" class="suivre" >Ne plus suivre</a>
                            @else
                                <a href="/suivre/{{$utilisateurr->id}}" class="suivre" >Suivre</a>
                            @endif

                        @endif
                    @endauth
                </div>

                @else
                    <div class="user">
                        <div>
                            <form action="/utilisateur/update/{{Auth::id()}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <label for="avatar" class="label-file col us"><img class="fit-user" src="{{$utilisateurr->url_avatar}}" alt="image utilisateur"></label>
                                <input type="file" id="avatar" name="avatar" value="{{old('url')}}" class="input_file">
                                <input type="email" name="email" placeholder="Votre nouvelle Adresse mail..." class="input_form form" value="{{$utilisateurr->email}}">
                                <input type="password" name="password" placeholder="Votre nouveau mot de passe..." class="input_form form">
                                <input type="submit" value="Valider" class="bouton_aut">
                            </form>
                        </div>
                        @endif
                        @endguest
                        <div class="info">
                            <h3>Vos statistiques</h3>
                            <ul>
                                <li>{{$utilisateurr->chansons()->count()}} chansons uploadées</li> <!--// avec count() -> permet de récupérer directement le nb de chansons sans lire toutes les données-->
                                <li>{{$utilisateurr->jeLesSuit()->count()}} abonnements</li>
                                <li>{{$utilisateurr->ilsMeSuivent()->count()}} abonnés</li>
                            </ul>
                        </div>
                    </div>




                <!-- @include("firstcontroller._chansons", ["chansons" => $utilisateurr->chansons])-->


@endsection
