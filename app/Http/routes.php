<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', 'Auth\AuthController@LoginPage');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' =>'Auth\PasswordController',
]);

Route::get('user/verification/error', 'Auth\AuthController@getVerificationError');
Route::get('user/verification/{token}', 'Auth\AuthController@getVerification');
Route::post('user/register','APIController@signup');
Route::post('user/authenticate','APIController@authenticate');
Route::post('user/{id}/upload','UsersController@upload');

Route::post('penginapan/{id}/komentar/add','PenginapanController@komentar');
Route::get('penginapan/{id}/komentar','PenginapanController@getKomentar');
Route::get('penginapan/{id}/rating','PenginapanController@getRating');
Route::post('penginapan/{id}/rating/add','PenginapanController@rating');
Route::post('penginapan/{id}/upload','PenginapanController@upload');

Route::post('restoran/{id}/komentar/add','RestoranController@komentar');
Route::get('restoran/{id}/komentar','RestoranController@getKomentar');
Route::get('restoran/{id}/rating','RestoranController@getRating');
Route::post('restoran/{id}/rating/add','RestoranController@rating');
Route::post('restoran/{id}/upload','RestoranController@upload');

Route::post('bumper/{id}/komentar/add','BumperController@komentar');
Route::get('bumper/{id}/komentar','BumperController@getKomentar');
Route::get('bumper/{id}/rating','BumperController@getRating');
Route::post('bumper/{id}/rating/add','BumperController@rating');
Route::post('bumper/{id}/upload','BumperController@upload');

Route::post('belanja/{id}/upload','BelanjaController@upload');
Route::post('aktivitas/{id}/upload','AktivitasController@upload');
Route::post('unggulan/{id}/upload','UnggulanController@upload');
Route::post('transportasi/{id}/upload','TransportasiController@upload');
Route::post('senibudaya/{id}/upload','SeniBudayaController@upload');
Route::post('pelayananpublik/{id}/upload','PelayananPublikController@upload');
Route::post('objekwisata/{id}/upload','ObjekWisataController@upload');

Route::get('unggulan/{id}/penginapan/{id2}/add','UnggulanController@penginapan');
Route::get('unggulan/{id}/penginapan/{id2}','UnggulanController@showPenginapan');

Route::resource('penginapan','PenginapanController');
Route::resource('bumper','BumperController');
Route::resource('user','UsersController');
Route::resource('restoran','RestoranController');
Route::resource('unggulan','UnggulanController');
Route::resource('komentar','KomentarController');
Route::resource('rating','RatingController');
Route::resource('transportasi','TransportasiController');
Route::resource('senibudaya','SeniBudayaController');
Route::resource('pelayananpublik','PelayananPublikController');
Route::resource('objekwisata','ObjekWisataController');
Route::resource('belanja','BelanjaController');
Route::resource('aktivitas','AktivitasController');
