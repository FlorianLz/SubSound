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
            <span class="titrefav"><img class="fit-picture" src="https://media.discopiu.com/img/2013/7/24/192072-large-avicii-wake-me-up.jpg"
                                        alt="Images de la musique">{{$c->nom}}</span>
                <span>{{$c->utilisateur->name}}</span>
                <span>13:30</span>
                <span><i class="far fa-heart jelikepas esp"></i>{{$c->elleEstLikee()->count()}}</span>
                <span>x</span>
            </div>
        @endif
    @endforeach

@endsection
