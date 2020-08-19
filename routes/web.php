<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('affaires', 'SgcaController@index');
Route::get('affaires/create', 'SgcaController@create');
Route::post('affaires', 'SgcaController@store');
Route::get('affaires/{id}/edit', 'SgcaController@edit');
Route::put('affaires/{id}', 'SgcaController@update');
Route::delete('affaires/{id}', 'SgcaController@destroy');*/

Route::resource('affaires', 'SgcaController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function(){
    return view('welcome'); 
});//'HomeController@index')->name('home');
//Route::get('/getclients/{id}', 'SgcaController@getClients');
Route::get('/getdata/{id}', 'SgcaController@getData');
Route::post('/addclient', 'SgcaController@addClient');
Route::put('/updateclient', 'SgcaController@updateClient');
Route::delete('/deleteclient/{id}', 'SgcaController@deleteClient');

// Adversaires
Route::post('/addadversaire', 'SgcaController@addAdversaire');
Route::put('/updateadversaire', 'SgcaController@updateAdversaire');
Route::delete('/deleteadversaire/{id}', 'SgcaController@deleteAdversaire');

// Séances
Route::post('/addseance', 'SgcaController@addSeance');
Route::put('/updateseance', 'SgcaController@updateSeance');
Route::delete('/deleteseance/{id}', 'SgcaController@deleteSeance');

// Décisions
Route::post('/adddecision', 'SgcaController@addDecision');
Route::put('/updatedecision', 'SgcaController@updateDecision');
Route::delete('/deletedecision/{id}', 'SgcaController@deleteDecision');

// Frais

Route::post('/addfrai', 'SgcaController@addFrai');
Route::put('/updatefrai', 'SgcaController@updateFrai');
Route::delete('/deletefrai/{id}', 'SgcaController@deleteFrai');

Route::get('rendez_vous', 'SgcaController@rendez_vous');
Route::get('affaire', 'SgcaController@index_');
Route::get('creances', 'SgcaController@creances');

Route::get('contact-us', 'ContactController@getContact');
Route::post('contact-us', 'ContactController@saveContact');