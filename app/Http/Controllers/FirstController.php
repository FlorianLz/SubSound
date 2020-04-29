<?php

namespace App\Http\Controllers;

use App\Chanson;
use App\Playlist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        $playlists=Playlist::all(); //SELECT * FROM playlist

        if(Auth::id()){
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.index", ["chansons"=>$chansons,"active"=> "accueil","utilisateur"=>$user,"playlists"=>$playlists]);
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

    public function resetmdp(){
        return view("auth.passwords.reset");
    }

    public function favoris(){
        $chansons=Chanson::all(); //SELECT * FROM chansons
        $playlists=Playlist::all(); //SELECT * FROM playlist
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.favoris", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"playlists"=>$playlists]);
    }

    public function musiques(){
        $chansons=Chanson::all(); //SELECT * FROM chansons
        $playlists=Playlist::all(); //SELECT * FROM playlist
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.musiques", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"playlists"=>$playlists]);
    }

    public function musiquesuser($id){
        $chansons=Chanson::all(); //SELECT * FROM chansons
        $playlists=Playlist::all(); //SELECT * FROM playlist
        if(Auth::id()){
            $user=User::findOrFail(Auth::id());
            $userr=User::findOrFail($id);
            return view("firstcontroller.musiquesuser", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"userr"=>$userr,"playlists"=>$playlists]);
        }else{
            $userr=User::findOrFail($id);
            return view("firstcontroller.musiquesuser", ["chansons"=>$chansons,"active" => "favoris","userr"=>$userr,"playlists"=>$playlists]);
        }
    }

    public function playlist(){
        $playlists=Playlist::all();  //SELECT * FROM playlist
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.playlist", ["playlists"=>$playlists,"active" => "playlist","utilisateur"=>$user]);
    }

    public function nouvelleplaylist(){
        $playlists=Playlist::all();  //SELECT * FROM playlist
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.addPlaylist", ["active" => "playlist","playlists"=>$playlists,"utilisateur"=>$user]);
    }

    public function article($id){
        return view("firstcontroller.article", ['id' => $id, 'nom' => 'Florian']);
    }

    public function infosplaylist($id){
        $chansons=Chanson::all();
        $playlist=Playlist::findOrFail($id);  //SELECT * FROM playlist
        $playlists=Playlist::all();
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.infosplaylist", ["playlist"=>$playlist,"chansons"=>$chansons,"active" => "playlist","utilisateur"=>$user,"playlists"=>$playlists]);
    }

    public function utilisateur($id){
        $u = User::findOrFail($id);
        $playlists=Playlist::all();
        $chansons=Chanson::all();

        if(Auth::id()){
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.utilisateur", ['utilisateurr' => $u,"playlists"=>$playlists,"chansons"=>$chansons,"utilisateur"=>$user]);
        }else{
            return view("firstcontroller.utilisateur", ['utilisateurr' => $u,"playlists"=>$playlists,"chansons"=>$chansons,"utilisateur"=>'anonyme']);

        }
    }

    public function nouvellechanson(){
        $playlists=Playlist::all();
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.nouvelle",["playlists"=>$playlists,"utilisateur"=>$user]);
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

        $chansons=Chanson::all(); //SELECT * FROM chansons
        $playlists=Playlist::all(); //SELECT * FROM playlist
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.musiques", ["chansons"=>$chansons,"utilisateur"=>$user,"playlists"=>$playlists]);

    }

    public function suivre($id){
        Auth::user()->jeLesSuit()->toggle($id);
        return Redirect::to('utilisateur/'.$id);
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
        $idchanson= $request->input('idchanson');


        $c = new Playlist();
        $c-> nom = $request->input('nom');
        $c-> url_image = "/uploads/".Auth::id()."/".$name;
        $c-> user_id = Auth::id();
        $c->save();

        if($idchanson >  0){
            $idplaylist = Playlist::all()->last()->id;
            $this->ajoutplaylist($idplaylist,$idchanson);
            return redirect('/infosplaylist/'.$idplaylist);
        }else{
            return redirect("/");
        }
    }

    public function recherche(Request $request) {
        $s=$request->input('search');
        $users = User::WhereRaw("name LIKE CONCAT('%',?, '%')" ,[$s])->get();
        $chansons = Chanson::WhereRaw("nom LIKE CONCAT('%',?, '%')" ,[$s])->get();
        $playlists=Playlist::all();
        if(!Auth::user()){
            return view("firstcontroller.recherche", ['utilisateurs' =>$users , 'chansons'=>$chansons,'playlists'=>$playlists]);

        }else{
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.recherche", ['utilisateurs' =>$users , 'chansons'=>$chansons,'playlists'=>$playlists, "utilisateur"=>$user]);

        }
    }

    public function ajoutplaylist($idplaylist,$idchanson){
        Playlist::findOrFail($idplaylist)->aLaChanson()->toggle($idchanson);
        $playlist=Playlist::findOrFail($idplaylist);
        return redirect('/infosplaylist/'.$idplaylist);
    }

    public function newplaylistandadd($id){
        $playlists=Playlist::all();
        $user=User::findOrFail(Auth::id());
        return view("firstcontroller.addPlaylist", ["active" => "playlist", "idchanson"=>$id,"playlists"=>$playlists,"utilisateur"=>$user]);
    }
    public function supprimerchanson($idchanson){
        $chanson = Chanson::findOrFail($idchanson);
        if ($chanson->user_id == Auth::id()){

            $chansons=Chanson::all();
            $playlists=Playlist::all(); //SELECT * FROM playlist

            foreach ($chansons as $c){
                if (Chanson::findOrFail($idchanson)->elleEstLikee->contains($c->id)){
                    Chanson::findOrFail($idchanson)->elleEstLikee()->toggle($c->id);
                }
            }

            foreach ($playlists as $p){
                if (Playlist::findOrFail($p->id)->aLaChanson->contains($idchanson)){
                    Playlist::findOrFail($p->id)->aLaChanson()->toggle($idchanson);
                }
            }

            $chanson->delete();


            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.musiques", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"playlists"=>$playlists]);
        }else{
            $chansons=Chanson::all(); //SELECT * FROM chansons
            $playlists=Playlist::all(); //SELECT * FROM playlist
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.musiques", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"playlists"=>$playlists]);
        }
    }

    public function supprimerplaylist($idplaylist){
        $playlist = Playlist::findOrFail($idplaylist);
        if ($playlist->user_id == Auth::id()){

            $chanson = Chanson::all();
            foreach ($chanson as $c){
                if (Playlist::findOrFail($idplaylist)->aLaChanson->contains($c->id)){
                    Playlist::findOrFail($idplaylist)->aLaChanson()->toggle($c->id);
                }
            }

            $playlist->delete();

            $chansons=Chanson::all(); //SELECT * FROM chansons
            $playlists=Playlist::all(); //SELECT * FROM playlist
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.playlist", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"playlists"=>$playlists]);
        }else{
            $chansons=Chanson::all(); //SELECT * FROM chansons
            $playlists=Playlist::all(); //SELECT * FROM playlist
            $user=User::findOrFail(Auth::id());
            return view("firstcontroller.playlist", ["chansons"=>$chansons,"active" => "favoris","utilisateur"=>$user,"playlists"=>$playlists]);
        }
    }

    public function updateutilisateur(Request $request){
        $request->validate([
            'email' => 'required|min:3|max:255',
            'password' => 'required|min:3|max:255',
        ]);

        if($request->file('avatar')){
            $name= $request->file('avatar')->hashName();
            $request->file('avatar')->move("uploads/".Auth::id(), $name);
        }


        Auth::user()->email=$request->input('email');
        Auth::user()->password=bcrypt($request->input('password'));
        if($request->file('avatar')){
            Auth::user()->url_avatar="/uploads/".Auth::id()."/".$name;
        }
        Auth::user()->save();

        return back();
    }
    public function elleEstLikee(){
        return $this->belongsToMany("App\Chanson", "like", "chanson_id", "user_id");
    }

    public function erreur() {
        $playlists=Playlist::all();
        $user=User::findOrFail(Auth::id());
        return view('errors.404', ["utilisateur"=>$user,"playlists"=>$playlists]);

    }
}
