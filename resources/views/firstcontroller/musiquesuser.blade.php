@extends('layouts.general')
@section("contenu")
    <div>
        @if(Auth::id() == $userr->id)
            @php
                $c=0;
            @endphp
            <div class="titre"><h2>Mes Musiques</h2>
                <a href="/chanson/nouvelle" alt="musique" onclick="changeractif(this.alt);" data-pjax class="Addcircle"><i class="fas fa-plus-circle"></i></a>
            </div>
            @foreach($chansons as $d)
                @if($userr->chansons->contains($d->id))
                    @php
                        $c=1;
                    @endphp
                    <div class="listfavorglobal"><div id="listfavor{{$d->id}}" class="listfavor" data-id="{{$d->id}}" data-file="{{$d->url}}" data-titre="{{$d->nom}}" data-image="{{$d->url_img}}">
                <span class="titrefav"><img class="fit-picture" src="{{$d->url_img}}"
                                            alt="Images de la musique">{{$d->nom}}
                <div id="boutonplay{{$d->id}}" class="boutonpause boutonplay_list" data-id="{{$d->id}}"></div>
                </span>
                            <span>{{$d->utilisateur->name}}</span>
                            <span class="favrep">{{$d->style}}</span>
                            <span class="favrep">{{$d->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                        </div>
                        <span class="boutonsuppr" id="boutonsuppr{{$d->id}}"><a id="suppr{{$d->id}}" class="btnsupprmusique" data-id="{{$d->id}}">x</a></span>
                    </div>
                @endif
            @endforeach
            @if($c != 1)
                <p class="aucune">Vous n'avez pas encore mis de musiques en ligne.</p>
            @endif
        @else
            @php
                $c=0;
            @endphp
            <div>
                <div class="titre"><h2>Musiques de {{$userr->name}}</h2></div>
            </div>
            @foreach($chansons as $d)
                @if($userr->chansons->contains($d->id))
                    @php
                        $c=1;
                    @endphp
                    <div class="listfavorglobal"><div id="listfavor{{$d->id}}" class="listfavor" data-id="{{$d->id}}" data-file="{{$d->url}}" data-titre="{{$d->nom}}" data-image="{{$d->url_img}}">
                <span class="titrefav"><img class="fit-picture" src="{{$d->url_img}}"
                                            alt="Images de la musique">{{$d->nom}}
                <div id="boutonplay{{$d->id}}" class="boutonpause boutonplay_list" data-id="{{$d->id}}"></div>
                </span>
                            <span>{{$d->utilisateur->name}}</span>
                            <span class="favrep">{{$d->style}}</span>
                            <span class="favrep">{{$d->elleEstLikee()->count()}} <i class="far fa-heart jelike esp"></i></span>
                        </div>
                    </div>
                @endif
            @endforeach
            @if($c != 1)
                <p class="aucune">{{$userr->name}} n'a pas encore mis de musiques en ligne.</p>
            @endif
        @endif
    </div>
@endsection
