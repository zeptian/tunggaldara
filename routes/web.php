<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/menu', 'HomeController@menu')->name('menu');


Route::group(['middleware' => 'auth'], function ($route) {
    Route::get('/kasus', 'KasusController@index')->name('kasus');
    Route::get('/kasus/tambah', 'KasusController@create')->name('kasus.create');
    Route::post('/kasus/tambah', 'KasusController@store')->name('kasus.store');
    Route::get('/kasus/{idk}', 'KasusController@show')->name('kasus.show');
    Route::get('/kasus/{idk}/edit', 'KasusController@edit')->name('kasus.edit');
    Route::put('/kasus/{idk}/edit', 'KasusController@update')->name('kasus.update');
    Route::delete('/kasus/{idk}', 'KasusController@destroy')->name('kasus.destroy');

    Route::get('/pe', 'PeController@index')->name('pe');
    Route::get('/pe/{idk}', 'PeController@create')->name('pe.create');
    Route::post('/pe/{idk}', 'PeController@store')->name('pe.store');
    Route::get('/pe/{idk}/edit', 'PeController@edit')->name('pe.edit');
    Route::put('/pe/{idk}/edit', 'PeController@update')->name('pe.update');
    Route::delete('/pe/{idk}', 'PeController@destroy')->name('pe.destroy');

    Route::get('/sicentik', 'SicentikController@index')->name('pe');
    Route::get('/sicentik/rekap', 'SicentikController@index')->name('pe.rekap');
    Route::get('/sicentik/tambah', 'SicentikController@create')->name('pe.create');
    Route::post('/sicentik/tambah', 'SicentikController@store')->name('pe.store');
    Route::get('/sicentik/{id}/edit', 'SicentikController@edit')->name('pe.edit');
    Route::put('/sicentik/{id}/edit', 'SicentikController@update')->name('pe.update');
    Route::delete('/sicentik/{id}', 'SicentikController@destroy')->name('pe.destroy');
});



Route::get('test', 'TestWsController@test');
