/* Player audio */

function calculateTotalValue(length) {
    let minutes = Math.floor(length / 60),
        seconds_int = length - minutes * 60,
        seconds_str = seconds_int.toString(),
        seconds = seconds_str.substr(0, 2);
        let time = minutes + ':' + (seconds < 10 ? "0" + seconds : seconds);

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
}

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

//Gestion du volume dans le player
$('.volume').click(function (e) {
    let status=$(this).attr('data-volume');
    let player=document.getElementById('player');
    if(status === 'true'){
        player.muted=true;
        $(this).attr('data-volume','false');
        $(this).removeClass('fa-volume-up');
        $(this).addClass('fa-volume-mute');
    }
    if(status === 'false'){
        player.muted=false;
        $(this).attr('data-volume','true');
        $(this).removeClass('fa-volume-mute');
        $(this).addClass('fa-volume-up');
    }
});

//Gestion de l'autoplay
$('.autoplay').click(function () {
    if($('#player').attr('autoplay')){
        $('#player').removeAttr('autoplay');
    }else{
        $('#player').attr('autoplay', 'autoplay')
    }
    $(this).toggleClass('autoplayactif');
});
