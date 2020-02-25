@extends('layouts.general')

@section('contenu')
    <h2>Nouvelle chanson </h2>
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
        <input type="text" name="nom" placeholder="Le nom..." value="{{old('nom')}}" required>
        <input type="file" name="chanson" value="{{old('url')}}" required>
        <input type="text" name="style" placeholder="Le style..." value="{{old('style')}}" required>
        <input type="submit" value="Go ...">
    </form>
@endsection
