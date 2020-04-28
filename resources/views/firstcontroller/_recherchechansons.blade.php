<div class="div_chansons">
    <div class="chansons" onload="initPlayers()">
        @foreach($chansons as $c)
            <div class="flip-card" id="flip-card">
                <div class="flip-card-inner" id="flip-card-inner{{$c->id}}">
                    <div class="chanson flip-card-front " id="flip-card-front{{$c->id}}">
                        <div id ="imgchanson{{$c->id}}" class="imgchanson"></div>
                        <div id ="infoschanson{{$c->id}}" class="infoschanson" style="background-image: url('{{$c->url_img}}')"></div>
                        <h4 class="titrechanson">{{$c->nom}}</h4>
                        <div id="boutonplay{{$c->id}}" class="boutonplay" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-image="{{$c->url_img}}" data-id="{{$c->id}}" data-pjax></div>
                        @guest
                        @else
                            @if(Auth::user()->jeLike->contains($c->id))
                                <a data-pjax class="a_like" href="/like/{{$c->id}}"><i class="fas fa-heart jelike"></i></a>
                            @else
                                <a data-pjax class="a_like" href="/like/{{$c->id}}"><i class="far fa-heart jelikepas"></i></a>
                            @endif
                        @endguest
                        <a  class="a_plus" id="plus{{$c->id}}" href="#" data-id='{{$c->id}}'><i class="fas fa-plus plus"></i></a>
                    </div>
                    <div class="chanson chanson-playlist flip-card-back">
                        <div id ="imgchanson{{$c->id}}" class="imgchanson imgchansonback"></div>
                        <div class="listeplaylists">
                            @auth
                                @foreach($playlists as $p)
                                    @if(Auth::user()->playlist->contains($p->id))
                                        @if($p->aLaChanson->contains($c->id))
                                            <a href="/playlist/update/{{$p->id}}/{{$c->id}}" data-pjax>
                                                <p class="playlist_back danslaplaylist">{{$p->nom}}<i class="fas fa-check"></i></p>
                                            </a>
                                        @else
                                            <a href="/playlist/update/{{$p->id}}/{{$c->id}}" data-pjax>
                                                <p class="playlist_back">{{$p->nom}}</p>
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
                        <a  class="a_retour" id="retour{{$c->id}}" href="#" data-id='{{$c->id}}'><i class="far fa-arrow-alt-circle-left retour"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="/js/jquery.js"></script>
<script>
    $('.boutonplay').on('click', function (e) {
        var idplayer = $('#play-btn').attr('data-id');
        var idclic = $(this).attr('data-id');

        if(idplayer === idclic){

            //on récupère le status actuel
            var status = $('#boutonplay'+idclic).attr('data-status');
            var player=document.getElementById('player');

            if (status === 'pause'){
                player.play();
                $('#imgchanson'+idclic).addClass('rotate');
                $('#infoschanson'+idclic).addClass('rotate');
                $('#imgchanson'+idclic).addClass('encours');
                $('#infoschanson'+idclic).addClass('encours');
                $('#boutonplay'+idclic).attr('data-status', 'lecture');
                $('#boutonplay'+idclic).removeClass('boutonplay');
                $('#boutonplay'+idclic).addClass('boutonpause');
                $('#play-btn').attr('data-status', 'lecture');
                $('#play-btn').addClass('pause');
            }
            if (status === 'lecture'){
                player.pause();
                $('.imgchanson').removeClass('encours').removeClass('rotate');
                $('.infoschanson').removeClass('encours').removeClass('rotate');
                $('#boutonplay'+idclic).attr('data-status', 'pause');
                $('#boutonplay'+idclic).removeClass('boutonpause');
                $('#boutonplay'+idclic).addClass('boutonplay');
                $('#play-btn').attr('data-status', 'pause');
                $('#play-btn').removeClass('pause');
            }

        }else{
            $('.boutonpause').addClass('boutonplay');
            $('.boutonplay').removeClass('boutonpause');
            $('.imgchanson').removeClass('encours').removeClass('rotate');
            $('.infoschanson').removeClass('encours').removeClass('rotate');
            var chanson=$('#boutonplay'+idclic);
            $('.album-image').addClass('visible');
            let url = chanson.attr('data-file');
            let titre = chanson.attr('data-titre');
            let id = idclic;
            let audio = $('#player');
            let image="url('"+chanson.attr('data-image')+"')";
            audio[0].src = url;
            audio[0].play();
            document.getElementById('audio-player').style.display="flex";
            document.getElementById('play-btn').className = "pause";
            document.getElementById('imgchanson'+id).classList.add('rotate');
            document.getElementById('infoschanson'+id).classList.add('rotate');
            document.getElementById('imgchanson'+id).classList.add('encours');
            document.getElementById('infoschanson'+id).classList.add('encours');
            document.getElementById('play-btn').setAttribute('data-id',id);
            document.getElementById('play-btn').setAttribute('data-status','lecture');
            $('#lancement').fadeOut(500);
            document.getElementById("titremusique").innerHTML = titre;
            $('.album-image').css('background-image',image);
            //$('.boutonplay_list').hide();
            $('#boutonplay'+id).show();
            $('#boutonplay'+id).removeClass('boutonplay');
            $('#boutonplay'+id).addClass('boutonpause');
            chanson.attr('data-status','lecture');
            //$('.listfavor').removeClass('musiqueencours');
            //chanson.addClass('musiqueencours');
        }
    });

    $(".a_plus").click(function () {
        let id = $(this).attr('data-id');
        document.getElementById('flip-card-inner'+id).classList.add('flip-card-inner-rot');
        setTimeout(function(){
            document.getElementById('flip-card-front'+id).style.display="none";
        }, 1000);
    });
    $(".a_retour").click(function () {
        let id = $(this).attr('data-id');
        document.getElementById('flip-card-front'+id).style.display="block";
        document.getElementById('flip-card-inner'+id).classList.remove('flip-card-inner-rot');
        setTimeout(function(){
            document.getElementById('flip-card-back'+id).style.display="none";
        }, 1000);
    });

</script>
