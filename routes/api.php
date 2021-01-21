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
    Route::get('kelurahan', 'Api\RefController@kelurahan');

    //PUSKESMAS
    //PASIEN    
    Route::get('pasien', 'Api\PasienController@index');
    Route::get('pasien/belumPe', 'Api\PasienController@belumPe');
    Route::get('pasien/sudahPe', 'Api\PasienController@sudahPe');
    //PE
    Route::post('pasien/pe', 'Api\PeController@store');
    Route::post('pasien/pe/lokasi', 'Api\PeController@storeLoc');
    Route::get('pasien/detail/{id}', 'Api\PeController@show');
    Route::put('pasien/pe/{id}', 'Api\PeController@update');
    //PJN
    Route::get('pjn', 'Api\PjnController@index');
    Route::post('pjn', 'Api\PjnController@store');
    Route::get('pjn/{id}', 'Api\PjnController@show');
    Route::put('pjn/{id}', 'Api\PjnController@update');
    Route::delete('pjn/{id}', 'Api\PjnController@destroy');
    // Laporan PJN
    Route::get('lap_pjn', 'Api\LapPjnController@index');
    Route::post('lap_pjn', 'Api\LapPjnController@store');
    Route::get('lap_pjn/{id}', 'Api\LapPjnController@show');
    Route::put('lap_pjn/{id}', 'Api\LapPjnController@update');
    Route::delete('lap_pjn/{id}', 'Api\LapPjnController@destroy');
    // PJR Gasurkes
    Route::get('pjg', 'Api\PjgController@index');
    Route::post('pjg', 'Api\PjgController@store');
    Route::get('pjg/{id}', 'Api\PjgController@show');
    Route::put('pjg/{id}', 'Api\PjgController@update');
    Route::delete('pjg/{id}', 'Api\PjgController@destroy');
    //PJB
    Route::get('pjb', 'Api\PjbController@index');
    Route::post('pjb', 'Api\PjbController@store');
    Route::get('pjb/{id}', 'Api\PjbController@show');
    Route::put('pjb/{id}', 'Api\PjbController@update');
    Route::delete('pjb/{id}', 'Api\PjbController@destroy');
    //Sicentik
    Route::get('sicentik', 'Api\SicentikController@index');
    Route::post('sicentik', 'Api\SicentikController@store');
    Route::get('sicentik/{id}', 'Api\SicentikController@show');
    Route::put('sicentik/{id}', 'Api\SicentikController@update');
    Route::delete('sicentik/{id}', 'Api\SicentikController@destroy');
    //SRSJ
    Route::get('srsj', 'Api\SrsjController@index');
    Route::post('srsj', 'Api\SrsjController@store');
    Route::get('srsj/{id}', 'Api\SrsjController@show');
    Route::put('srsj/{id}', 'Api\SrsjController@update');
    Route::delete('srsj/{id}', 'Api\SrsjController@destroy');
    // KADER
    //PJR
    Route::get('pjr', 'Api\PjrController@index');
    Route::post('pjr', 'Api\PjrController@store');
    Route::get('pjr/{id}', 'Api\PjrController@show');
    Route::put('pjr/{id}', 'Api\PjrController@update');
    Route::delete('pjr/{id}', 'Api\PjrController@destroy');
});