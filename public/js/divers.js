$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container');
});
$(document).on('pjax:success', function(event, data, status, xhr, options) {
    //Au chargement d'une page avec pjax, on recharge nos différentes fonctions, contenues dans la fonction lectureEnCours
    lectureEnCours();
});

$('.loaderpage').slideUp(2000);


lectureEnCours();

function changeractif(id){
    $('#accueil').removeClass('actif');
    $('#musique').removeClass('actif');
    $('#playlist').removeClass('actif');
    $('#favoris').removeClass('actif');
    $('#'+id).addClass('actif');
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

function lectureEnCours(){
    var idencours = $('#play-btn').attr('data-id');
    if($('#listfavor'+idencours)){
        var chanson = $('#listfavor'+idencours);
        chanson.addClass('musiqueencours');
        $('#boutonplay'+idencours).show();

        //status

        var status = $('#play-btn').attr('data-status');
        chanson.attr('data-status',status);

        if(status === 'lecture'){
            $('#boutonplay'+idencours).removeClass('boutonplay').addClass('boutonpause');

        }
        if(status === 'pause'){
            $('#boutonplay'+idencours).removeClass('boutonpause').addClass('boutonplay');
        }

        $('#boutonsuppr'+idencours).css({"visibility":"hidden"});

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
                $('#boutonplay'+idclic).removeClass('boutonplay').addClass('boutonpause');
                $('#play-btn').attr('data-status', 'lecture').addClass('pause');
            }
            if (status === 'lecture'){
                player.pause();
                $('#listfavor'+idclic).attr('data-status', 'pause');
                $('#boutonplay'+idclic).removeClass('boutonpause').addClass('boutonplay');
                $('#play-btn').attr('data-status', 'pause').removeClass('pause');
            }

        }else{
            let chanson=$('#listfavor'+idclic);
            let url = chanson.attr('data-file');
            let titre = chanson.attr('data-titre');
            let id = idclic;
            let audio = $('#player');
            let image="url('"+chanson.attr('data-image')+"')";
            audio[0].src = url;
            audio[0].play();
            $('#audio-player').css('display','flex');
            $('#play-btn').addClass('pause').attr('data-id',id).attr('data-status','lecture');
            $('#lancement').fadeOut(500);
            document.getElementById("titremusique").innerHTML = titre;
            $('.album-image').addClass('visible').css('background-image',image);
            $('.boutonplay_list').hide();
            $('#boutonplay'+id).show().addClass('boutonpause');
            chanson.attr('data-status','lecture');
            $('.listfavor').removeClass('musiqueencours');
            chanson.addClass('musiqueencours');
            $('.boutonsuppr').css({"visibility":"visible"});
            $('#boutonsuppr'+id).css({"visibility":"hidden"});
        }
    });

    //Clic sur le bouton lecture de la page d'accueil
    $('.boutonplayy').on('click', function (e) {
        let idplayer = $('#play-btn').attr('data-id');
        let idclic = $(this).attr('data-id');

        if(idplayer === idclic){

            //on récupère le status actuel
            let status = $('#boutonplay'+idclic).attr('data-status');
            let player=document.getElementById('player');

            if (status === 'pause'){
                player.play();
                $('#imgchanson'+idclic).addClass('rotate').addClass('encours');
                $('#infoschanson'+idclic).addClass('rotate').addClass('encours');;
                $('#boutonplay'+idclic).attr('data-status', 'lecture').removeClass('boutonplay').addClass('boutonpause');
                $('#play-btn').attr('data-status', 'lecture').addClass('pause');
            }
            if (status === 'lecture'){
                player.pause();
                $('.imgchanson').removeClass('encours').removeClass('rotate');
                $('.infoschanson').removeClass('encours').removeClass('rotate');
                $('#boutonplay'+idclic).attr('data-status', 'pause').removeClass('boutonpause').addClass('boutonplay');
                $('#play-btn').attr('data-status', 'pause').removeClass('pause');
            }

        }else{
            $('.boutonpause').addClass('boutonplay');
            $('.boutonplay').removeClass('boutonpause');
            $('.imgchanson').removeClass('encours').removeClass('rotate');
            $('.infoschanson').removeClass('encours').removeClass('rotate');
            var chanson=$('#boutonplay'+idclic);
            let url = chanson.attr('data-file');
            let titre = chanson.attr('data-titre');
            let id = idclic;
            let audio = $('#player');
            let image="url('"+chanson.attr('data-image')+"')";
            audio[0].src = url;
            audio[0].play();
            $('#audio-player').css('display','flex');
            $('#play-btn').addClass('pause').attr('data-id',id).attr('data-status','lecture');;
            $('#imgchanson'+id).addClass('rotate').addClass('encours');
            $('#infoschanson'+id).addClass('rotate').addClass('encours');
            $('#lancement').fadeOut(500);
            document.getElementById("titremusique").innerHTML = titre;
            $('.album-image').addClass('visible').css('background-image',image);
            //$('.boutonplay_list').hide();
            $('#boutonplay'+id).show().removeClass('boutonplay').addClass('boutonpause');
            chanson.attr('data-status','lecture');
        }
    });

    //Relancer la rotation du disque si la lecture est en cours
    if ($('#play-btn').attr('data-id') !== 0 && $('#play-btn').attr('data-status') === 'lecture'){
        var idchanson = $('#play-btn').attr('data-id');
        if($('#infoschanson'+idchanson)){
            $('#infoschanson'+idchanson).addClass('rotate').addClass('encours');
            $('#imgchanson'+idchanson).addClass('encours');
            $('#boutonplay'+idchanson).addClass('boutonpause').attr('data-status','lecture');
        }

    }

    $('#play-btn').on('click',function(){
        var idclic = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var player=document.getElementById('player');
        if(status === 'pause'){
            $('#listfavor'+idclic).attr('data-status', 'pause');
            $('#boutonplay'+idclic).removeClass('boutonpause').addClass('boutonplay');
        }
        if(status === 'lecture'){
            $('#listfavor'+idclic).attr('data-status', 'lecture');
            $('#boutonplay'+idclic).removeClass('boutonplay').addClass('boutonpause');
        }

    });

    //Bouton qui permet d'afficher les playlists au dos d'une carte
    $(".a_plus").click(function () {
        let id = $(this).attr('data-id');
        document.getElementById('flip-card-inner'+id).classList.add('flip-card-inner-rot');
        setTimeout(function(){
            document.getElementById('flip-card-front'+id).style.display="none";
        }, 1000);
    });

    //Bouton qui permet de retourner la carte d'une musique
    $(".a_retour").click(function () {
        let id = $(this).attr('data-id');
        $('#flip-card-front'+id).show();
        $('#flip-card-inner'+id).removeClass('flip-card-inner-rot');
    });

    //Ajout ou suppression d'un like sur la page d'accueil
    $('.a_like').click(function (e) {
        e.preventDefault();
        let id=$(this).attr('data-id');
        let status=$(this).attr('data-like');
        $.get( "/like/"+id, '', function(data) {
            if(status === 'jelike'){
                //On a retiré le like
                $('#like'+id).removeClass('fas').removeClass('jelike').addClass('far').addClass('jelikepas');
                $('.like'+id).attr('data-like','jelikepas');
            }else{
                //On a ajouté un like
                $('#like'+id).removeClass('far').removeClass('jelikepas').addClass('fas').addClass('jelike');
                $('.like'+id).attr('data-like','jelike');
            }
        });
    });

    //Suppression d'une musique de ses favoris
    $('.btnsuppr').click(function (e) {
        e.preventDefault();
        let id=$(this).attr('data-id');
        $.get( "/like/"+id, '', function(data) {
            $('#suppr'+id).fadeOut();
            $('#listfavor'+id).slideUp(300, function () {
                $(this).remove();
            });
        });
    });

    //Suppression d'une musique uploadée
    $('.btnsupprmusique').click(function (e) {
        e.preventDefault();
        let id=$(this).attr('data-id');
        $.get( "/suppr/"+id, '', function(data) {
            $('#suppr'+id).fadeOut();
            $('#listfavor'+id).slideUp(300, function () {
                $(this).remove();
            });
        });
    });

    //Suppression d'une dans une playlist
    $('.btnsupprmp').click(function (e) {
        e.preventDefault();
        let id=$(this).attr('data-id');
        let idplaylist=$(this).attr('data-idplaylist');
        $.get( "/playlist/update/"+idplaylist+"/"+id, '', function(data) {
            $('#suppr'+id).fadeOut();
            $('#listfavor'+id).slideUp(300, function () {
                $(this).remove();
            });
        });
    });

    //Ajout ou suppression d'une musique dans sa playlist page d'accueil
    $('.majplaylist').click(function (e) {
        e.preventDefault();
        let id=$(this).attr('data-id');
        let idplaylist=$(this).attr('data-idplaylist');
        let status = $(this).attr('data-status');
        let clic=$(this);
        $.get( "/playlist/update/"+idplaylist+"/"+id, '', function(data) {
            $('#p'+idplaylist).toggleClass('danslaplaylist');
            $('#check'+idplaylist).toggleClass('invisible');
            if(status==='contient'){
                clic.attr('data-status','necontientpas');
            }else{
                clic.attr('data-status','contient');
            }
        });
    });

    //Aperçu de l'image lors de la création d'une playlist ou l'ajout d'une musique
    $('.imgapercu').on('change', function (event) {
        let sortie = document.getElementById('apercuimg');
        sortie.src = URL.createObjectURL(event.target.files[0]);
    });

    //Suppression d'une playlist
    $('.sup-playlist').on('click', function (e) {
        e.preventDefault();
        let idplaylist=$(this).attr('data-idplaylist');
        $.get( "/playlist/supprimer/"+idplaylist, '', function(data) {
        }).done(
            $.get( "/playlist", '', function(data) {
                window.history.pushState('playlist','playlist', '/playlist');
            })
        );
    })



}
