@extends('layouts.general')
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes favoris</h2></div>
        </div>
        @foreach($chansons as $c)
            @if(Auth::user()->ILike->contains($c->id))
                <div class="listfavorglobal"><div id="listfavor{{$c->id}}" class="listfavor" data-id="{{$c->id}}" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-image="{{$c->url_img}}">
                    <span class="titrefav"><img class="fit-picture" src="{{$c->url_img}}"
                                        alt="Images de la musique">{{$c->nom}}
                    <div id="boutonplay{{$c->id}}" class="boutonpause boutonplay_list" data-id="{{$c->id}}"></div>
                    </span>
                    <span>{{$c->utilisateur->name}}</span>
                    <span class="favrep">{{$c->style}}</span>
                    <span class="favrep">{{$c->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                </div>
                <span class="boutonsuppr"><a id="suppr{{$c->id}}" class="btnsuppr" data-id="{{$c->id}}">x</a></span>
                </div>
            @endif
        @endforeach
    </div>
@endsection
