@extends("layouts.general")
@section("contenu")
    <div>
        <div class="titre"><h2>Mes playlists</h2><a href="/playlist/nouvelle" data-pjax class="Addcircle"><i class="fas fa-plus-circle"></i></a></div>
        <form></form>
    </div>
    <div id="car" class="playlistt">
        @foreach($playlists as $c)
            @if(Auth::user()->playlist->contains($c->id))
                <div><a href="/infosplaylist/{{$c->id}}" data-pjax>
                        <div class="listplaylist">
                            <img class="fit-play" src="{{$c->url_image}}" alt="Image de la playlist">
                            <p>{{$c->nom}}</p>
                        </div>
                    </a></div>
            @endif
        @endforeach
        <div><a href="playlist/nouvelle" data-pjax>
                <div class="listplaylist">
                    <div class="interrogation"><img class="fit-play" src="/img/newplaylist.png" alt="Image de la playlist" /></div>
                    <p>Créer une nouvelle playlist</p>
                </div>
            </a></div>
    </div>

@endsection
