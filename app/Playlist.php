<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "playlist"; //Nom de la table associée

    public function utilisateur(){
        return $this->belongsTo("App\User", "user_id");
        // SELECT * FROM users WHERE user_id=?
        //et le ? est remplacè par le $this->id
    }
    public function chanson(){
        return $this->belongsTo("App\Chanson", "chanson_id");
        // SELECT * FROM chansons WHERE chanson_id=?
        //et le ? est remplacè par le $this->id
    }
    public function aLaChanson(){
        return $this->belongsToMany("App\Chanson", "contenuplaylist", "playlist_id", "chanson_id");
    }

}
