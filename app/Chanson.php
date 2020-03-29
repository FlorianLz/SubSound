<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chanson extends Model
{
    protected $table = "chansons"; //Nom de la table associée

    public function utilisateur(){
        return $this->belongsTo("App\User", "user_id");
        // SELECT * FROM users WHERE user_id=?
        //et le ? est remplacè par le $this->id

    }

    public function playlist(){
        return $this->belongsTo("App\Playlist", "playlist_id");
        // SELECT * FROM playlist WHERE playlists_id=?
        //et le ? est remplacè par le $this->id

    }

    public function elleEstLikee(){
        return $this->belongsToMany("App\Chanson", "like", "chanson_id", "user_id");
    }
}
