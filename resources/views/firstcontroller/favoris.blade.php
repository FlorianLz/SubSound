@extends('layouts.general')
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes favoris</h2></div>
        </div>
        @foreach($chansons as $c)
            @if(Auth::user()->ILike->contains($c->id))
                <div class="listfavor">
                    <span class="titrefav"><img class="fit-picture" src="https://media.discopiu.com/img/2013/7/24/192072-large-avicii-wake-me-up.jpg"
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
