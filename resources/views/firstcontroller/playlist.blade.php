@extends("layouts.general")
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes playlists</h2></div>
            <form></form>
        </div>
        <div class="playlistt">
            @foreach($chansons as $c)
                @if(Auth::user()->playlist->contains($c->id))
                    <a href="infosplaylist/{{$c->id}}">
                        <div class="listplaylist">
                            <img class="fit-play" src="{{$c->url_image}}" alt="Image de la playlist">
                            <p>{{$c->nom}}</p>
                        </div>
                    </a>
                @endif
            @endforeach
            <p>Envie de créer une nouvelle playlist ? C'est par <a href="/playlist/nouvelle">ici</a></p>
        </div>
    </div>

@endsection
