$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container');
});

function changeractif(id){
    let accueil=document.getElementById('accueil');
    let musique=document.getElementById('musique');
    let playlist=document.getElementById('playlist');
    let favoris=document.getElementById('favoris');
    accueil.classList.remove('actif');
    musique.classList.remove('actif');
    playlist.classList.remove('actif');
    favoris.classList.remove('actif');
    document.getElementById(id).classList.add('actif');
}

$(document).ready(function () {
    /* Page connexion */
    $('#choixinscription').click(function (e) {
        $('#choixinscription').addClass('choixactif');
        $('#choixconnexion').removeClass('choixactif');
        $('#forminscription').show();
        $('#formconnexion').hide();

    });
    $('#choixconnexion').click(function (e) {
        $('#choixconnexion').addClass('choixactif');
        $('#choixinscription').removeClass('choixactif');
        $('#forminscription').hide();
        $('#formconnexion').show();

    });

    /* Hover logo */
    $('#logo')
        .mouseover(function () {
            $(this).attr("src", "/img/logo67.gif");
        })
        .mouseout(function () {
            $(this).attr("src", "/img/logo67.png");
        });
});

/* Player audio */

function calculateTotalValue(length) {
    let minutes = Math.floor(length / 60),
        seconds_int = length - minutes * 60,
        seconds_str = seconds_int.toString(),
        seconds = seconds_str.substr(0, 2),
        time = minutes + ':' + seconds;

    return time;
}

function calculateCurrentValue(currentTime) {
    let current_hour = parseInt(currentTime / 3600) % 24,
        current_minute = parseInt(currentTime / 60) % 60,
        current_seconds_long = currentTime % 60,
        current_seconds = current_seconds_long.toFixed(),
        current_time = (current_minute < 10 ? "0" + current_minute : current_minute) + ":" + (current_seconds < 10 ? "0" + current_seconds : current_seconds);

    return current_time;
}

function initProgressBar() {
    let player = document.getElementById('player');
    let length = player.duration;
    let current_time = player.currentTime;

    // calculate total length of value
    let totalLength = calculateTotalValue(length)
    jQuery(".end-time").html(totalLength);

    // calculate current value time
    let currentTime = calculateCurrentValue(current_time);
    jQuery(".start-time").html(currentTime);

    let progressbar = document.getElementById('seekObj');
    progressbar.value = (player.currentTime / player.duration);
    progressbar.addEventListener("click", seek);

    if (player.currentTime === player.duration) {
        if($('#player').attr('autoplay') === 'autoplay'){
            console.log('auto');
            player.currentTime = 0;
            progressbar.value = 0;
            player.play();
        }else{
            player.pause();
            isPlaying = false;
            $('#play-btn').removeClass('pause').attr('data-status','pause');
            $('.encours').removeClass('rotate lecture');
        }

    }

    function seek(evt) {
        let percent = evt.offsetX / this.offsetWidth;
        player.currentTime = percent * player.duration;
        progressbar.value = percent / 100;
    }
};

function initPlayers(num) {
    // pass num in if there are multiple audio players e.g 'player' + i

    for (var i = 0; i < num; i++) {
        (function() {

            // Variables
            // ----------------------------------------------------------
            // audio embed object
            var playerContainer = document.getElementById('player-container'),
                player = document.getElementById('player'),
                isPlaying = false,
                playBtn = document.getElementById('play-btn');

            // Controls Listeners
            // ----------------------------------------------------------
            if (playBtn != null) {
                playBtn.addEventListener('click', function() {
                    togglePlay()
                });
            }

            // Controls & Sounds Methods
            // ----------------------------------------------------------
            function togglePlay() {
                if (player.paused === false) {
                    player.pause();
                    isPlaying = false;
                    $('#play-btn').removeClass('pause').attr('data-status','pause');
                    $('.encours').removeClass('rotate lecture');

                } else {
                    player.play();
                    $('#play-btn').addClass('pause').attr('data-status','lecture');
                    $('.encours').addClass('rotate');
                    isPlaying = true;
                }
            }
        }());
    }
}
$('.autoplay').click(function () {
    if($('#player').attr('autoplay')){
        $('#player').removeAttr('autoplay');
    }else{
        $('#player').attr('autoplay', 'autoplay')
    }
    $(this).toggleClass('autoplayactif');
});

initPlayers(jQuery('#player-container').length);

$('#play-btn').on('click',function(){
    var idclic = $(this).attr('data-id');
    var status = $(this).attr('data-status');
    var player=document.getElementById('player');
    if(status === 'pause'){
        $('#boutonplay'+idclic).attr('data-status', 'lecture');
        $('#boutonplay'+idclic).removeClass('boutonpause');
        $('#boutonplay'+idclic).addClass('boutonplay');
        if($('#imgchanson'+idclic)){
            $('#imgchanson'+idclic).removeClass('rotate');
            $('#infoschanson'+idclic).removeClass('rotate');
        }
        $('#listfavor'+idclic).attr('data-status', 'pause');
    }
    if(status === 'lecture'){
        $('#boutonplay'+idclic).attr('data-status', 'pause');
        $('#boutonplay'+idclic).removeClass('boutonplay');
        $('#boutonplay'+idclic).addClass('boutonpause');
        if($('#imgchanson'+idclic)){
            $('#imgchanson'+idclic).addClass('rotate');
            $('#infoschanson'+idclic).addClass('rotate');
        }
        $('#listfavor'+idclic).attr('data-status', 'lecture');
    }

})

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
        $('.boutonsuppr').css({"visibility":"visible"});
        $('#boutonsuppr'+id).css({"visibility":"hidden"});

    }
})
