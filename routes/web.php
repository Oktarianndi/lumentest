<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group([

    'prefix' => 'api'

], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user-profile', 'AuthController@me');

});

Route::group([ 
    'middleware'=> 'auth',
    'prefix' => 'api'
], function ($router) {
    Route::get('me', 'AuthController@me');
});

Route::group([ 
    'middleware'=> 'auth',
    'prefix' => 'data'
], function ($router) {
    Route::get('pegawai', 'PegawaiController@index');
    Route::get('pegawai/{$nip}', 'PegawaiController@show');
    Route::post('pegawai/save', 'PegawaiController@store');
    Route::post('pegawai/{id}/update', 'PegawaiController@update');
    Route::post('pegawai/{id}/delete', 'PegawaiController@destroy');
});







