@extends('layouts.general')

@section('contenu')
    <div class="titre rsize"><h3>les utilisateurs</h3></div>
    @foreach($utilisateurs as $u)
        <a href="/utilisateur/{{$u->id}}">{{$u->name}}</a><br>
    @endforeach
    <div class="titre rsize"><h3>chansons</h3></div>
    @include("firstcontroller._recherchechansons", ['chansons'=>$chansons])
@endsection
