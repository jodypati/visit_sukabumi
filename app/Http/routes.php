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

Route::post('user/register','APIController@signup');
Route::post('user/authenticate','APIController@authenticate');
Route::post('penginapan/{id}/komentar/add','PenginapanController@komentar');
Route::post('penginapan/{id}/rating/add','PenginapanController@rating');
Route::post('restoran/{id}/komentar/add','RestoranController@komentar');
Route::post('restoran/{id}/rating/add','RestoranController@rating');
Route::resource('penginapan','PenginapanController');
Route::resource('jenis','JenisController');
