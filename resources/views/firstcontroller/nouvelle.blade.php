@extends('layouts.general')
@section('contenu')
    <div id="formconnexion" class="container formconnexion">
        <div class="titre"><h2>Ajouter une chanson</h2></div>
        <h3 class="col">Vous souhaitez publier votre nouvelle création ? Pas de <br>soucis ! Pour cela, vous avez juste à remplir ce formulaire</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/chanson/create" method="POST" enctype="multipart/form-data" data-pjax>
            @csrf
            <input type="text" name="nom" placeholder="Titre de la musique..." value="{{old('nom')}}" class="input_form " required>
            <input type="text" name="style" placeholder="Genre de la musique..." value="{{old('style')}}" class="input_form " required>
            <label for="chanson" class="label-file col"><p>Importer votre musique<br>au format mp3</p><img class="fit-file" src="/img/upload.png"
                                                                                                           alt="upload"></label>
            <input type="file" id="chanson" name="chanson" value="{{old('url')}}" class="input_file" required>
            <input type="submit" value="Envoyer" class="bouton_aut">
        </form>
    </div>
@endsection
