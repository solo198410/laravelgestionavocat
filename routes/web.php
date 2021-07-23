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
Route::resource('avocats', 'AvocatController');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@welcome');
Route::get('/detail/{id}', 'HomeController@detail');


/*Route::get('/', function(){
    return view('welcome');
    //$e = Event::get();
    //$e= $e[0];

    /*dd($e->startDateTime->toDateTimeString());
    dd($e->summary);*/
    //dd($e);

//});*/


//'HomeController@index')->name('home');
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

Route::get('rendez_vous', 'SgcaController@rendez_vouss');
Route::get('affaire', 'SgcaController@index_');
Route::get('creances', 'SgcaController@creances');

// avocats annuaires

Route::get('/getdatavocat/{id}', 'AvocatController@getData');
Route::post('/addskill', 'AvocatController@addSkill');
Route::put('/updateskill', 'AvocatController@updateSkill');
Route::delete('/deleteskill/{id}', 'AvocatController@deleteSkill');

//details

Route::post('/adddetail', 'AvocatController@addDetail');
Route::put('/updatedetail', 'AvocatController@updateDetail');
Route::delete('/deletedetail/{id}', 'AvocatController@deleteDetail');

//Route::get('contact-us', 'ContactController@getContact');
//Route::post('contact-us', 'ContactController@saveContact');

/*Route::get('/contact-us', 'ContactUsController@index');
Route::post('/contact-us', 'ContactUsController@handleForm');*/

/*Route::get("message", "MessageController@formMessageGoogle");
Route::post("message", "MessageController@sendMessageGoogle")->name('send.message.google');*/

// Render in view
Route::get('/contact', [
    'uses' => 'ContactUsFormController@createForm'
]);

// Post form data
Route::post('/contact', [
    'uses' => 'ContactUsFormController@ContactUsForm',
    'as' => 'contact.store'
]);