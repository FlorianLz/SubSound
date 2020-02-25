<div class="chansons" onload="initPlayers()">
    @foreach($chansons as $c)
        <a class="chanson" data-file="{{$c->url}}" data-titre="{{$c->nom}}" data-id="{{$c->id}}" data-pjax>
            <div class="chanson">
                <div id ="imgchanson{{$c->id}}" class="imgchanson"></div>
                <div class="infoschanson">
                    <h4>{{$c->nom}}</h4>
                </div>

            </div>
        </a>
    @endforeach
</div>
<script>
    $("a.chanson").click(function (e) {
        e.preventDefault();
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
