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
                        <div class="boutonplay" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-image="{{$c->url_img}}" data-id="{{$c->id}}" data-pjax></div>
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
                        <div id ="imgchanson{{$c->id}}" class="imgchanson"></div>
                        <p>lien1</p>
                        <p>lien1</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="/js/jquery.js"></script>
<script>
    $(".boutonplay").click(function () {
        $('.imgchanson').removeClass('encours').removeClass('rotate');
        $('.infoschanson').removeClass('encours').removeClass('rotate');
        let url = $(this).attr('data-file');
        let titre = $(this).attr('data-titre');
        let id = $(this).attr('data-id');
        let audio = $('#player');
        let image="url('"+$(this).attr('data-image')+"')";
        console.log(image);
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
        $('.album-image').css('background-image',image)
    });

    $(".a_plus").click(function () {
        let id = $(this).attr('data-id');
        document.getElementById('flip-card-inner'+id).classList.add('flip-card-inner-rot');
        setTimeout(function(){
            document.getElementById('flip-card-front'+id).style.display="none";
            }, 700);
    });

</script>
