@extends('layouts.general')

@section('contenu')
    <div class="titre rsize"><h3>Les utilisateurs</h3></div>
    <div class="listemembres">
        @foreach($utilisateurs as $u)
            <a href="/utilisateur/{{$u->id}}" data-pjax>{{$u->name}}</a>
        @endforeach
    </div>
    <div class="titre rsize"><h3>Les chansons</h3></div>
    @include("firstcontroller._recherchechansons", ['chansons'=>$chansons])
@endsection
