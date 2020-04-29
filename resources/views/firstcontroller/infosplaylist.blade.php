@extends("layouts.general")
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Musiques de : {{$playlist->nom}}</h2><a class="sup-playlist" data-idplaylist="{{$playlist->id}}"><i class="fas fa-trash-alt sup-playlist"></i></a></div>
        </div>

    </div>
    @foreach($chansons as $c)
        @if($playlist->aLaChanson->contains($c->id))
            <div class="listfavorglobal"><div id="listfavor{{$c->id}}" class="listfavor" data-id="{{$c->id}}" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-image="{{$c->url_img}}">
            <span class="titrefav"><img class="fit-picture" src="{{$c->url_img}}"
                                        alt="Images de la musique">{{$c->nom}}
                <div id="boutonplay{{$c->id}}" class="boutonpause boutonplay_list" data-id="{{$c->id}}"></div>
                </span>
                <span>{{$c->utilisateur->name}}</span>
                <span class="favrep">13:30</span>
                <span class="favrep"><i class="far fa-heart jelikepas esp"></i>{{$c->elleEstLikee()->count()}}</span>
            </div>
                <span class="boutonsuppr" id="boutonsuppr{{$c->id}}"><a id="suppr{{$c->id}}" class="btnsupprmp" data-id="{{$c->id}}" data-idplaylist="{{$playlist->id}}">x</a></span>
            </div>
        @endif
    @endforeach

@endsection

