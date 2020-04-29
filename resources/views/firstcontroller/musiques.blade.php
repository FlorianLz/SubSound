@extends('layouts.general')
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes Musiques</h2>
                <a href="/chanson/nouvelle" alt="musique" onclick="changeractif(this.alt);" data-pjax class="Addcircle"><i class="fas fa-plus-circle"></i></a>
            </div>

        </div>
        @foreach($chansons as $d)
            @if(Auth::user()->chansons->contains($d->id))
                <div class="listfavorglobal"><div id="listfavor{{$d->id}}" class="listfavor" data-id="{{$d->id}}" data-file="{{$d->url}}" data-titre="{{$d->nom}}" data-image="{{$d->url_img}}">
                    <span class="titrefav"><img class="fit-picture" src="{{$d->url_img}}"
                                                alt="Images de la musique">{{$d->nom}}
                    <div id="boutonplay{{$d->id}}" class="boutonpause boutonplay_list" data-id="{{$d->id}}"></div>
                    </span>
                    <span>{{$d->utilisateur->name}}</span>
                    <span class="favrep">{{$d->style}}</span>
                    <span class="favrep">{{$d->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                </div>
                <span class="boutonsuppr" id="boutonsuppr{{$d->id}}"><a id="suppr{{$d->id}}" class="btnsupprmusique" data-id="{{$d->id}}">x</a></span>
                </div>
            @endif
        @endforeach
    </div>
@endsection
