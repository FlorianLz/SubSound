@if(request()->ajax())
    @yield("contenu")
    @else
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset='UTF-8'>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="stylesheet" href="/css/style.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">    <title>Mon application soundcloud</title>
            <link href="https://fonts.googleapis.com/css?family=Mukta&display=swap" rel="stylesheet">
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        @guest
                            <!--<li>
                                <a class="nav-link" href="/connexion" data-pjax><i class="fas fa-user-plus"></i></a>
                            </li>-->
                        @else
                            <!--<li><a href="/chanson/nouvelle" data-pjax><i class="fas fa-plus-circle"></i></a></li>
                            <li>
                                <a href="/utilisateur/{{Auth::id()}}" role="button" data-pjax>
                                    <i class="fas fa-user-circle"></i> <span class="caret"></span>
                                </a>
                            </li>-->
                        @endguest
                    </ul>
                </nav>
            </header>

            <div class="menucote">
                <a class="logo_a" href="/" data-pjax><img id="logo" class="logomenu" src="/img/logo67.png" alt="SubSound"></a>

                @auth
                <div class="infos_user">
                    <a href="/utilisateur/{{Auth::id()}}" data-pjax><div class="photo_user" style="background-image: url('{{$utilisateur->url_avatar ?? ''}}')"></div></a>
                    <div class="infos">
                        <p>{{$utilisateur->name ?? ''}}</p>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button" data-pjax>
                            <p>Déconnexion</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" data-pjax>
                            @csrf
                        </form>
                    </div>
                </div>
                @endauth

                <div class="menu">
                    <h3>MENU</h3>
                    <a href="/" data-pjax>
                        @if($active ?? ''=='accueil')
                        <p id="accueil" class="accueil actif" onclick="changeractif(this.id);"><i class="fas fa-home"></i><span>Accueil</span></p>
                        @else
                            <p id="accueil" class="accueil" onclick="changeractif(this.id);"><i class="fas fa-home"></i><span>Accueil</span></p>
                        @endif
                    </a>
                @guest
                </div>
                    <h3 class="msg_auth">Merci de vous identifier pour accéder au reste du site.</h3>
                    <div class="boutons_auth">
                        <a href="inscription" class="bouton_auth" data-pjax>Inscription</a>
                        <a href="connexion" class="bouton_auth" data-pjax>Connexion</a>
                    </div>
                @else
                    <div class="lienmusique">
                        <a href="/musiques" data-pjax>
                            <p id="musique" class="musique" onclick="changeractif(this.id);"><i class="fas fa-music"></i><span>Musique</span></p>
                        </a>
                        <a href="/chanson/nouvelle" alt="musique" onclick="changeractif(this.alt);" data-pjax><i class="fas fa-plus-circle"></i></a>
                    </div>
                    <a href="/playlist" data-pjax>
                        <p id="playlist" class="playlist" onclick="changeractif(this.id);"><i class="fas fa-file-audio"></i><span>Playlist</span></p>
                    </a>
                    <a href="/favoris" data-pjax>
                        <p id="favoris" class="favoris" onclick="changeractif(this.id);"><i class="fas fa-star"></i><span>Favoris</span></p>
                    </a>
                </div>

                <div class="vosplaylists">
                    <div><h3>VOS PLAYLISTS</h3><a href="/playlist/nouvelle" data-pjax><i class="fas fa-plus-circle"></i></a></div>

                    @foreach($playlists as $c)
                        @if(Auth::user()->playlist->contains($c->id))
                                <a href="{{URL::to('/')}}/infosplaylist/{{$c->id}}" data-pjax>
                                <p class="playlist"><i class="fas fa-file-audio"></i><span>{{$c->nom}}</span></p>
                            </a>
                        @endif
                    @endforeach
                </div>
                @endguest
                </div>

            <div id="main">
                <form id="search" data-pjax>
                    <input type="search" name="search"  required />
                    <input type="submit" />
                </form>
                <div id="pjax-container" class="contenumain">
                    @yield('contenu')
                </div>
            </div>

            <div class="audio-player" id="audio-player">
                <div id="lancement" class="lancement"><h2>Bienvenue sur SubSound !!!</h2></div>
                <div id="play-btn" data-id="0"></div>
                <div class="audio-wrapper" id="player-container">
                    <audio id="player" ontimeupdate="initProgressBar()">
                        <source src="http://www.lukeduncan.me/oslo.mp3" type="audio/mp3">
                    </audio>
                </div>
                <div class="player-controls scrubber">
                    <p id="titremusique"></p>
                    <span id="seekObjContainer">
			            <progress id="seekObj" value="0" max="1"></progress>
			        </span>
                    <br>
                    <small style="float: left; position: relative; left: 15px;" class="start-time"></small>
                    <small style="float: right; position: relative; right: 20px;" class="end-time"></small>

                </div>
                <div class="album-image" style="background-image: url('https://artwork-cdn.7static.com/static/img/sleeveart/00/051/614/0005161476_350.jpg')"></div>
            </div>

            <script src="/js/jquery.js"></script>
            <script src="/js/jquery.pjax.js"></script>
            <script src="/js/divers.js"></script>
        </body>
    </html>
    @endif

<script>
    if (document.getElementById('play-btn').getAttribute('data-id') != 0 && document.getElementById('play-btn').getAttribute('data-status') === 'lecture'){
        document.getElementById('imgchanson'+document.getElementById('play-btn').getAttribute('data-id')).classList.add('rotate');
        document.getElementById('infoschanson'+document.getElementById('play-btn').getAttribute('data-id')).classList.add('rotate');
        document.getElementById('imgchanson'+document.getElementById('play-btn').getAttribute('data-id')).classList.add('encours');
        document.getElementById('infoschanson'+document.getElementById('play-btn').getAttribute('data-id')).classList.add('encours');
    }
</script>
