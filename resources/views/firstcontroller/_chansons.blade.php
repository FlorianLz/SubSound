<div class="chansons">
    @foreach($chansons as $c)
        <a href="#" class="chanson" data-file="{{$c->url}}" data-titre="{{$c->nom}}">
            <div class="chanson">
                <div class="imgchanson"></div>
                <h4>{{$c->nom}}</h4>
            </div>
        </a>
    @endforeach
</div>
