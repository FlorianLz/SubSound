@extends('layouts.general')
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes Musiques</h2></div>
        </div>
        @foreach($chansons as $d)
            @if(Auth::user()->chansons->contains($d->id))
                <div class="listfavor">
                    <span class="titrefav"><img class="fit-picture" src="{{$d->url_img}}"
                                        alt="Images de la musique">{{$d->nom}}</span>
                    <span>{{$d->utilisateur->name}}</span>
                    <span class="favrep">{{$d->style}}</span>
                    <span class="favrep">{{$d->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                    <span><a class="btnsuppr" href="/suppr/{{$d->id}}">x</a></span>
                </div>
            @endif
        @endforeach
    </div>
@endsection
