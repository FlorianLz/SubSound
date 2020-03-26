$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container')
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


function initProgressBar() {
    let player = document.getElementById('player');
    let length = player.duration
    let current_time = player.currentTime;

    // calculate total length of value
    let totalLength = calculateTotalValue(length)
    document.getElementById("end-time").innerHTML = totalLength;

    // calculate current value time
    let currentTime = calculateCurrentValue(current_time);
    document.getElementById("start-time").innerHTML = currentTime;

    let progressbar = document.getElementById('seek-obj');
    progressbar.value = (player.currentTime / player.duration);
    progressbar.addEventListener("click", seek);

    if (player.currentTime == player.duration) {
        document.getElementById('play-btn').className = "";
        let idmusique=document.getElementById('idmusique').innerText;
        document.getElementById('imgchanson'+idmusique).className = "imgchanson";
    }

    function seek(event) {
        let percent = event.offsetX / this.offsetWidth;
        player.currentTime = percent * player.duration;
        progressbar.value = percent / 100;
    }
}

function initPlayers(num) {
    // pass num in if there are multiple audio players e.g 'player' + i

    for (let i = 0; i < num; i++) {
        (function() {

            // Variables
            // ----------------------------------------------------------
            // audio embed object
            let playerContainer = document.getElementById('player-container'),
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
                    document.getElementById('play-btn').className = "";
                    let idmusique=document.getElementById('idmusique').innerText;
                    document.getElementById('imgchanson'+idmusique).className = "imgchanson";

                } else {
                    player.play();
                    document.getElementById('play-btn').className = "pause";
                    isPlaying = true;
                    let idmusique=document.getElementById('idmusique').innerText;
                    document.getElementById('imgchanson'+idmusique).className = "imgchanson rotate";
                }
            }
        }());
    }
}

function calculateTotalValue(length) {
    let minutes = Math.floor(length / 60),
        seconds_int = length - minutes * 60,
        seconds_str = seconds_int.toString(),
        seconds = seconds_str.substr(0, 2),
        time = minutes + ':' + seconds

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

initPlayers(jQuery('#player-container').length);

$(document).ready(function () {
    $("a.chanson").click(function (e) {
        e.preventDefault();
        let url = $(this).attr('data-file');
        let titre = $(this).attr('data-titre');
        let id = $(this).attr('data-id');
        let audio = $('#player');
        audio[0].src = url;
        audio[0].play();
        document.getElementById('audio-player').style.display="flex";
        document.getElementById('play-btn').className = "pause";
        document.getElementById("titremusique").innerHTML = titre;
        document.getElementById("idmusique").innerHTML = id;
        for (let element of document.getElementsByClassName("rotate")){
            element.className="imgchanson";
        }
        document.getElementById('imgchanson'+id).classList.add("rotate");



    });

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
            $(this).attr("src", "/img/logo.gif");
        })
        .mouseout(function () {
            $(this).attr("src", "/img/logo.png");
        });
});
$('#search').submit(function (e) {
    e.preventDefault()
    window.location.href = "/recherche/"+e.target.elements[0].value;
})

