@extends("layouts.general")
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Musiques de : {{$playlist->nom}}</h2></div>
        </div>

    </div>
    @foreach($chansons as $c)
        @if($playlist->aLaChanson->contains($c->id))
            <div class="listfavor">
            <span class="titrefav"><img class="fit-picture" src="{{$c->url_img}}"
                                        alt="Images de la musique">{{$c->nom}}</span>
                <span>{{$c->utilisateur->name}}</span>
                <span class="favrep">13:30</span>
                <span class="favrep"><i class="far fa-heart jelikepas esp"></i>{{$c->elleEstLikee()->count()}}</span>
                <span><a href="/playlist/update/{{$playlist->id}}/{{$c->id}}" data-pjax>x</a></span>
            </div>
        @endif
    @endforeach

@endsection
