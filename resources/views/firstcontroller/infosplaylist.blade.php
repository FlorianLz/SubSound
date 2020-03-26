@extends("layouts.general")
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Info playlist</h2></div>
        </div>
        <div class="playlistt">
            @foreach($chansons as $c)
                @if(Auth::user()->danslaplaylist->contains($c->id))
                    chanson {{$c->nom}}
                @endif
            @endforeach
            <p>Envie de créer une nouvelle playlist ? C'est par <a href="/playlist/nouvelle">ici</a></p>
        </div>
    </div>

@endsection
