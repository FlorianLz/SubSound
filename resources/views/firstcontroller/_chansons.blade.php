<div class="div_chansons">
    <div class="titre"><h2>Les derniers ajouts</h2></div>
    <div class="chansons" onload="initPlayers()">
        @foreach($chansons as $c)
            <div class="flip-card" id="flip-card">
                <div class="flip-card-inner" id="flip-card-inner{{$c->id}}">
                    <div class="chanson flip-card-front " id="flip-card-front{{$c->id}}">
                        <div id ="imgchanson{{$c->id}}" class="imgchanson"></div>
                        <div id ="infoschanson{{$c->id}}" class="infoschanson" style="background-image: url('{{$c->url_img}}')"></div>
                        <h4 class="titrechanson">{{$c->nom}}</h4>
                        <div id="boutonplay{{$c->id}}" class="boutonplay boutonplayy" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-image="{{$c->url_img}}" data-id="{{$c->id}}" data-pjax></div>
                        @guest
                        @else
                            @if(Auth::user()->jeLike->contains($c->id))
                                <a class="a_like like{{$c->id}}" data-id="{{$c->id}}" data-like="jelike" href="/like/{{$c->id}}"><i  id="like{{$c->id}}" class="fas fa-heart jelike"></i></a>
                            @else
                                <a class="a_like like{{$c->id}}" data-id="{{$c->id}}" data-like="jelikepas" href="/like/{{$c->id}}"><i id="like{{$c->id}}" class="far fa-heart jelikepas"></i></a>
                            @endif
                        @endguest
                        <a  class="a_plus" id="plus{{$c->id}}" data-id='{{$c->id}}'><i class="fas fa-plus plus"></i></a>
                    </div>
                    <div class="chanson chanson-playlist flip-card-back">
                        <div id ="imgchanson{{$c->id}}" class="imgchanson imgchansonback"></div>
                        <div class="listeplaylists">
                            @auth
                            @foreach($playlists as $p)
                                @if(Auth::user()->playlist->contains($p->id))
                                    @if($p->aLaChanson->contains($c->id))
                                        <a class="majplaylist" data-idplaylist="{{$p->id}}" data-id="{{$c->id}}" data-status="contient">
                                            <p id="p{{$p->id}}" class="playlist_back danslaplaylist" data-idplaylist="{{$p->id}}" data-id="{{$c->id}}">{{$p->nom}}<i id="check{{$p->id}}" class="fas fa-check"></i></p>
                                        </a>
                                    @else
                                        <a class="majplaylist" data-idplaylist="{{$p->id}}" data-id="{{$c->id}}" data-status="necontientpas">
                                            <p id="p{{$p->id}}" class="playlist_back">{{$p->nom}}<i id="check{{$p->id}}" class="fas fa-check invisible"></i></p>
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                                <a href="/playlist/nouvelle/{{$c->id}}"><p class="addplaylist">Ajouter à une nouvelle playlist</p></a>
                            @endauth
                            @guest
                                <p>Connectez-vous pour ajouter cette chanson à une playlist.</p>
                            @endguest
                        </div>
                        <a  class="a_retour" id="retour{{$c->id}}" data-id='{{$c->id}}'><i class="far fa-arrow-alt-circle-left retour"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
