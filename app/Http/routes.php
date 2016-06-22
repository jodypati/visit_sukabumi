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

Route::resource('penginapan','PenginapanController');
Route::resource('bumper','BumperController');
Route::resource('user','UsersController');
Route::resource('restoran','RestoranController');
Route::resource('jenis','JenisController');
Route::resource('komentar','KomentarController');
Route::resource('rating','RatingController');
Route::resource('fasilitas','FasilitasController');
