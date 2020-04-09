@extends('layouts.general')

@section('contenu')
    <div class="titre"><h2>La page perso de {{$utilisateur->name}}</h2></div>

    @auth
        @if(Auth::id() != $utilisateur->id)
            <div class="noUser">
                <div>
                    <img class="fit-user" src="/img/album.jpg" alt="image utilisateur">
                    @auth
                        @if(Auth::id() != $utilisateur->id)
                            @if(Auth::user()->jeLesSuit->contains($utilisateur->id))
                                <a href="/suivre/{{$utilisateur->id}}" class="suivre" >Ne plus suivre</a>
                            @else
                                <a href="/suivre/{{$utilisateur->id}}" class="suivre" >Suivre</a>
                            @endif

                        @endif
                    @endauth
                </div>

                @else
                    <div class="user">
                        <div>
                            <form action="" method="POST" >
                                <label for="chanson" class="label-file col us"><img class="fit-user" src="{{$utilisateur->url_avatar}}" alt="image utilisateur"></label>
                                <input type="file" id="chanson" name="chanson" value="{{old('url')}}" class="input_file" required>
                                <input type="email" placeholder="Votre nouvelle Adresse mail..." class="input_form form" value="{{$utilisateur->email}}">
                                <input type="password" placeholder="Votre nouveau mot de passe..." class="input_form form">
                                <input type="submit" value="Valider" class="bouton_aut">
                            </form>
                        </div>
                        @endif
                        @endguest
                        <div class="info">
                            <h3>Vos statistiques</h3>
                            <ul>
                                <li>{{$utilisateur->chansons()->count()}} chansons uploadées</li> <!--// avec count() -> permet de récupérer directement le nb de chansons sans lire toutes les données-->
                                <li>{{$utilisateur->jeLesSuit()->count()}} abonnements</li>
                                <li>{{$utilisateur->ilsMeSuivent()->count()}} abonnés</li>
                            </ul>
                        </div>
                    </div>




                <!-- @include("firstcontroller._chansons", ["chansons" => $utilisateur->chansons])-->


@endsection
