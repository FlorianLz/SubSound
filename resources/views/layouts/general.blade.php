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
        <div id="grid">

            <header>
                <nav>
                    <form  class="formrecherche" action="#ff">
                        <input type="search">
                        <i class="fa fa-search"></i>
                    </form>
                    <!--<p>Souncloud c'est top</p>-->
                    <ul>
                        <!--<li><a href="/">Home</a></li>-->
                        <!--<li><a href="/about">About</a></li>
                        <li><a href="/article/1">Article 1</a></li>-->
                        @guest
                            <li>
                                <a class="nav-link" href="/connexion" data-pjax><i class="fas fa-user-plus"></i></a>
                            </li>
                        @else
                            <li><a href="/chanson/nouvelle" data-pjax><i class="fas fa-plus-circle"></i></a></li>
                            <li>
                                <a href="/utilisateur/{{Auth::id()}}" role="button" data-pjax>
                                    <i class="fas fa-user-circle"></i> <span class="caret"></span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button" data-pjax>
                               <i class="fas fa-sign-out-alt"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" data-pjax>
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </header>

            <div class="menucote">
                <div><a href="/" data-pjax><img id="logo" class="logo" src="/img/logo.png" alt="SubSound"></a></div>
                <div class="categories">
                    <a href="/" data-pjax>
                        <p id="musique"><i class="fas fa-music"></i> Musique</p>
                    </a>
                    <a href="/playlist" data-pjax>
                        <p id="playlist"><i class="fas fa-file-audio"></i> Playlist</p>
                    </a>
                    <a href="/favoris" data-pjax>
                        <p id="favoris"><i class="fas fa-star"></i> Favoris</p>
                    </a>
                </div>

            </div>

            <!--<audio id="audio" controls></audio>-->
            <div class="audio-player" id="audio-player">
                <div id="play-btn"></div>
                <div class="audio-wrapper" id="player-container" href="javascript:;">
                    <audio id="player" ontimeupdate="initProgressBar()">
                        <source src="" type="audio/mp3">
                    </audio>
                </div>
                <div class="player-controls scrubber">
                    <p id="titremusique"></p>
                    <p hidden id="idmusique"></p>
                    <span id="seek-obj-container">
                        <progress id="seek-obj" value="0" max="1"></progress>
                    </span>
                    <small style="float: left; position: relative; left: 15px;" id="start-time"></small>
                    <small style="float: right; position: relative; right: 20px;" id="end-time"></small>
                </div>
                <div class="album-image" style="background-image: url(https://microsillons.fr/modules/tvcmscategoryslider/views/img/unnamed.jpg)"></div>
            </div>

            <div id="main">
                <div id="pjax-container" class="contenumain">
                    @yield('contenu')
                </div>

            </div>
        </div>


        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.pjax.js"></script>
        <script src="/js/divers.js"></script>
    </body>
    <style>
        #{{$active ?? ''}}{
        color:var(--secondaire);
        border-left:3px solid var(--secondaire);
        padding-left:15px;}
    </style>
    </html>
    @endif
