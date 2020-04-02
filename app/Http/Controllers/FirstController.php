<?php

namespace App\Http\Controllers;

use App\Chanson;
use App\Playlist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirstController extends Controller
{

    public function index(){
        //$chanson = Chanson::findOrFail(3);
        //SELECT * FROM chanson where id=1
        //$chansons = Chanson::all();
        //echo $chanson->url;

        //$chanson->delete();
        //$chanson->nom = "Une chanson douce";
        //$chanson->save(); //Mise à jour de la table
        //dd();

        //$c = new Chanson();
        //$c->nom = "Une chanson";
        //$c->url = "https://file-examples.com/wp-content/uploads/2017/11/file_example_MP3_700KB.mp3";
        //$c->style = "ambiance";
        //$c->save(); //MAJ BDD

        $chansons=Chanson::all(); //SELECT * FROM chansons

        if(Auth::id()){
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.index", ["chansons"=>$chansons,"active"=> "accueil","utilisateur"=>$user]);
        }else{
            return view("firstcontroller.index", ["chansons"=>$chansons,"active"=> "accueil"]);
        }



    }

    public function connexion(){
        return view("auth.login");
    }

    public function inscription(){
        return view("auth.register");
    }

    public function favoris(){
        $chansons=Chanson::all(); //SELECT * FROM chansons
        return view("firstcontroller.favoris", ["chansons"=>$chansons,"active" => "favoris"]);
    }

    public function playlist(){
        $playlists=Playlist::all();  //SELECT * FROM playlist
        return view("firstcontroller.playlist", ["chansons"=>$playlists,"active" => "playlist"]);
    }

    public function nouvelleplaylist(){
        return view("firstcontroller.addPlaylist", ["active" => "playlist"]);
    }

    public function article($id){
        return view("firstcontroller.article", ['id' => $id, 'nom' => 'Florian']);
    }

    public function infosplaylist($id){
        $chansons=Chanson::all();
        $playlist=Playlist::findOrFail($id);  //SELECT * FROM playlist
        return view("firstcontroller.infosplaylist", ["playlist"=>$playlist,"chansons"=>$chansons,"active" => "playlist"]);
    }

    public function utilisateur($id){
        $u = User::findOrFail($id);
        return view("firstcontroller.utilisateur", ['utilisateur' => $u]);
    }

    public function nouvellechanson(){
        return view("firstcontroller.nouvelle");
    }

    public function creerchanson(Request $request){
        $request->validate([
            'nom' => 'required|min:3|max:255',
            'chanson' => 'required|file',
            'chanson_img' => 'required|file',
            'style' => 'required|min:2',
        ]);

        $name= $request->file('chanson')->hashName();
        $request->file('chanson')->move("uploads/".Auth::id(), $name);

        $name_img= $request->file('chanson_img')->hashName();
        $request->file('chanson_img')->move("uploads/".Auth::id(), $name_img);


        $c = new Chanson();
        $c-> nom = $request->input('nom');
        $c-> url = "/uploads/".Auth::id()."/".$name;
        $c-> url_img = "/uploads/".Auth::id()."/".$name_img;
        $c-> style = $request->input('style');
        $c-> user_id = Auth::id();
        $c->save(); //INSERT INTO chansons VALUES (NULL,...)
        //return redirect("/utilisateur/".Auth::id());
        return redirect("/");
    }

    public function suivre($id){
        Auth::user()->jeLesSuit()->toggle($id);
        return back();
    }

    public function like($id){
        Auth::user()->jeLike()->toggle($id);
        return redirect('/');
    }

    public function creerplaylist(Request $request){
        $request->validate([
            'nom' => 'required|min:3|max:255',
            'imgMusiq' => 'required|file',
        ]);

        $name= $request->file('imgMusiq')->hashName();
        $request->file('imgMusiq')->move("uploads/".Auth::id(), $name);


        $c = new Playlist();
        $c-> nom = $request->input('nom');
        $c-> url_image = "/uploads/".Auth::id()."/".$name;
        $c-> user_id = Auth::id();
        $c->save();
        return redirect("/");
    }

    public function recherche($s) {
        $users = User::WhereRaw("name LIKE CONCAT('%',?, '%')" ,[$s])->get();
        $chansons = Chanson::WhereRaw("nom LIKE CONCAT('%',?, '%')" ,[$s])->get();
        return view("firstcontroller.recherche", ['utilisateurs' =>$users , 'chansons'=>$chansons]);
    }

    public function ajoutplaylist($idplaylist,$idchanson){
        Playlist::findOrFail($idplaylist)->aLaChanson()->toggle($idchanson);
        return redirect('/');
    }
}
