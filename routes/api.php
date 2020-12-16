<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function ($router) {
    //AUTH
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::get('me', 'Api\AuthController@me');

    //PUSKESMAS
    //PASIEN    
    Route::get('pasien', 'Api\PasienController@index');
    Route::get('pasien/belumPe', 'Api\PasienController@belumPe');
    Route::get('pasien/sudahPe', 'Api\PasienController@sudahPe');
    //PE
    Route::post('pasien/pe', 'Api\PeController@store');
    //PJN
    Route::get('pjn', 'Api\PjnController@index');
    Route::post('pjn', 'Api\PjnController@store');
    Route::get('pjn/{id}', 'Api\PjnController@show');
    Route::put('pjn/{id}', 'Api\PjnController@update');
    Route::delete('pjn/{id}', 'Api\PjnController@destroy');

    // KADER
    //PJR
    Route::get('pjr', 'Api\PjrController@index');
    Route::post('pjr', 'Api\PjrController@store');
    Route::get('pjr/{id}', 'Api\PjrController@show');
    Route::put('pjr/{id}', 'Api\PjrController@update');
    Route::delete('pjr/{id}', 'Api\PjrController@destroy');
});