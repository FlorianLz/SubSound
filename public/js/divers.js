$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container')
});

$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container')
})

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
$('#search').submit(function (e) {
    e.preventDefault()
    window.location.href = "/recherche/"+e.target.elements[0].value;
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
        $('#play-btn').removeClass('pause');
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

initPlayers(jQuery('#player-container').length);
