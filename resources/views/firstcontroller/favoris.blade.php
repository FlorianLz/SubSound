@extends('layouts.general')
@section("contenu")
    <div>
        <div>
            <div class="titre"><h2>Mes favoris</h2></div>
        </div>
        @foreach($chansons as $c)
            @if(Auth::user()->ILike->contains($c->id))
                <div id="listfavor{{$c->id}}" class="listfavor" data-id="{{$c->id}}" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-image="{{$c->url_img}}">
                    <span class="titrefav"><img class="fit-picture" src="{{$c->url_img}}"
                                        alt="Images de la musique">{{$c->nom}}
                    <div id="boutonplay{{$c->id}}" class="boutonpause boutonplay_list" data-id="{{$c->id}}"></div>
                    </span>
                    <span>{{$c->utilisateur->name}}</span>
                    <span class="favrep">{{$c->style}}</span>
                    <span class="favrep">{{$c->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                    <span><a class="btnsuppr" href="/like/{{$c->id}}">x</a></span>
                </div>
            @endif
        @endforeach
    </div>
@endsection

<script src="/js/jquery.js"></script>
<script>
    //On regarde si une musique est lanccée dans le player
    var idencours = $('#play-btn').attr('data-id');
    if($('#listfavor'+idencours)){
        var chanson = $('#listfavor'+idencours);
        chanson.addClass('musiqueencours');
        $('#boutonplay'+idencours).show();

        //status

        var status = $('#play-btn').attr('data-status');
        chanson.attr('data-status',status);

        if(status === 'lecture'){
            $('#boutonplay'+idencours).addClass('boutonpause');
            $('#boutonplay'+idencours).removeClass('boutonplay');
        }
        if(status === 'pause'){
            $('#boutonplay'+idencours).addClass('boutonplay');
            $('#boutonplay'+idencours).removeClass('boutonpause');
        }

    }

    $('.listfavor').on('click', function (e) {
        var idplayer = $('#play-btn').attr('data-id');
        var idclic = $(this).attr('data-id');

        if(idplayer === idclic){

            //on récupère le status actuel
            var status = $('#listfavor'+idclic).attr('data-status');
            var player=document.getElementById('player');

            if (status === 'pause'){
                player.play();
                $('#listfavor'+idclic).attr('data-status', 'lecture');
                $('#boutonplay'+idclic).removeClass('boutonplay');
                $('#boutonplay'+idclic).addClass('boutonpause');
                $('#play-btn').attr('data-status', 'lecture');
                $('#play-btn').addClass('pause');
            }
            if (status === 'lecture'){
                player.pause();
                $('#listfavor'+idclic).attr('data-status', 'pause');
                $('#boutonplay'+idclic).removeClass('boutonpause');
                $('#boutonplay'+idclic).addClass('boutonplay');
                $('#play-btn').attr('data-status', 'pause');
                $('#play-btn').removeClass('pause');
            }

        }else{
            var chanson=$('#listfavor'+idclic);
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
            document.getElementById('play-btn').setAttribute('data-id',id);
            document.getElementById('play-btn').setAttribute('data-status','lecture');
            $('#lancement').fadeOut(500);
            document.getElementById("titremusique").innerHTML = titre;
            $('.album-image').css('background-image',image);
            $('.boutonplay_list').hide();
            $('#boutonplay'+id).show();
            $('#boutonplay'+id).addClass('boutonpause');
            chanson.attr('data-status','lecture');
            $('.listfavor').removeClass('musiqueencours');
            chanson.addClass('musiqueencours');
        }
    })

    $('#play-btn').on('click',function(){
        var idclic = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var player=document.getElementById('player');
        if(status === 'pause'){
            $('#listfavor'+idclic).attr('data-status', 'lecture');
            $('#boutonplay'+idclic).removeClass('boutonpause');
            $('#boutonplay'+idclic).addClass('boutonplay');
        }
        if(status === 'lecture'){
            $('#listfavor'+idclic).attr('data-status', 'pause');
            $('#boutonplay'+idclic).removeClass('boutonplay');
            $('#boutonplay'+idclic).addClass('boutonpause');
        }

    })


</script>
