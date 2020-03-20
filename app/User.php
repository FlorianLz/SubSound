<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chansons(){
        return $this->hasMany("App\Chanson", "user_id");
        //SELECT * FROM chanson WHERE user_id=?
        //le ? = $this->>id
    }

    public function jeLesSuit(){
        return $this->belongsToMany("App\User", "connexion", "suiveur_id", "suivi_id");
    }

    public function ilsMeSuivent(){
        return $this->belongsToMany("App\User", "connexion", "suivi_id", "suiveur_id");
    }

    public function jeLike(){
        return $this->belongsToMany("App\Chanson", "like", "user_id", "chanson_id");
    }
    public function ILike(){
        return $this->belongsToMany("App\Chanson", "like", "user_id", "chanson_id");
    }
    public function nom(){
        return $this->name;
    }
}
