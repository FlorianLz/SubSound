<div class="div_chansons">
    <div class="chansons" onload="initPlayers()">
        @foreach($chansons as $c)
            <div class="chanson">
                <div class="chanson">
                    <div id ="imgchanson{{$c->id}}" class="imgchanson"></div>
                    <div class="infoschanson"></div>
                    <h4 class="titrechanson">{{$c->nom}}</h4>
                    <div class="boutonplay" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-id="{{$c->id}}" data-pjax></div>
                    @guest
                    @else
                        @if(Auth::user()->jeLike->contains($c->id))
                            <a class="a_like" href="/like/{{$c->id}}"><i class="fas fa-heart jelike"></i></a>
                        @else
                            <a class="a_like" href="/like/{{$c->id}}"><i class="far fa-heart jelikepas"></i></a>
                        @endif
                    @endguest
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="/js/jquery.js"></script>
<script>
    $(".boutonplay").click(function () {
        console.log("clic");
        let url = $(this).attr('data-file');
        let titre = $(this).attr('data-titre');
        let audio = $('#player');
        audio[0].src = url;
        audio[0].play();
        document.getElementById('audio-player').style.display="flex";
        document.getElementById('play-btn').className = "pause";
        document.getElementById("titremusique").innerHTML = titre;
    });

</script>
