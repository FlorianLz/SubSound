<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "playlist"; //Nom de la table associée

    public function playlistuser(){
        return $this->belongsTo("App\Playlist", "user_id");
        // SELECT * FROM users WHERE user_id=?
        //et le ? est remplacè par le $this->id
    }

}
