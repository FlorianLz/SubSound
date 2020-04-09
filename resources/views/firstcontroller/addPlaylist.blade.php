@extends('layouts.general')
@section('contenu')
    <div id="formconnexion" class="container formconnexion">
        <div class="titre"><h2>Créer une playlist</h2></div>
        <h3 class="col">Vous souhaitez créer des categorie de musiques ? Pas de <br>soucis ! Pour cela, vous avez juste à remplir ce formulaire</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/playlist/create" method="POST" enctype="multipart/form-data" data-pjax>
            @csrf
            <input type="text" name="nom" placeholder="Titre de la playlist" value="{{old('nom')}}" class="input_form " required>
            <label for="imgMusiq" class="label-file col"><p>Importer votre image <br>pour votre playlist</p><img class="fit-file" src="/img/upload.png"
                                                                                                                 alt="upload"></label>
            <input type="hidden" name="idchanson" value="{{$idchanson ?? '0'}}">
            <input type="file" id="imgMusiq" name="imgMusiq" value="{{old('url')}}" class="input_file" required>
            <input type="submit" value="Envoyer" class="bouton_aut">
        </form>
    </div>
@endsection
