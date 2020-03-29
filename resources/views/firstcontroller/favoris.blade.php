@extends('layouts.general')
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes favoris</h2></div>
        </div>
        @foreach($chansons as $c)
            @if(Auth::user()->ILike->contains($c->id))
                <div class="listfavor">
                    <span class="titrefav"><img class="fit-picture" src="{{$c->url_img}}"
                                        alt="Images de la musique">{{$c->nom}}</span>
                    <span>{{$c->utilisateur->name}}</span>
                    <span>{{$c->style}}</span>
                    <span>{{$c->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                    <span><a class="btnsuppr" href="/like/{{$c->id}}">x</a></span>
                </div>
            @endif
        @endforeach
    </div>
@endsection
