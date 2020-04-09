<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FirstController@index');

Route::get('/home', 'FirstController@index')->name('home');

Route::get('/connexion', 'FirstController@connexion');

Route::get('/inscription', 'FirstController@inscription');

Route::get('/favoris', 'FirstController@favoris');

Route::get('/playlist', 'FirstController@playlist');

Route::get('/article/{id}', 'FirstController@article')->where ('id', '[0-9]+');

Route::get('/utilisateur/{id}','FirstController@utilisateur')->where ('id', '[0-9]+');

Route::get('/chanson/nouvelle', 'FirstController@nouvellechanson')->middleware('auth');

Route::get('/playlist/nouvelle', 'FirstController@nouvelleplaylist')->middleware('auth');

Route::get('/playlist/nouvelle/{idchanson}', 'FirstController@newplaylistandadd')->where ('idchanson', '[0-9]+')->middleware('auth');

Route::get('/playlist/update/{idplaylist}/{idchanson}', 'FirstController@ajoutplaylist')->where ('id', '[0-9]+')->middleware('auth');

Route::get('/infosplaylist/{id}', 'FirstController@infosplaylist')->where ('id', '[0-9]+')->middleware('auth');

Route::get('/suivre/{id}', 'FirstController@suivre')->where ('id', '[0-9]+')->middleware('auth');

Route::get('/like/{id}', 'FirstController@like')->where ('id', '[0-9]+')->middleware('auth');

Route::get('/recherche/{s}','FirstController@recherche');

Route::post('/chanson/create', 'FirstController@creerchanson');

Route::post('/playlist/create', 'FirstController@creerplaylist');

Route::post('/', 'FirstController@index');

Auth::routes();

Route::get('/{any}', 'FirstController@erreur')->where('any', '.*');
