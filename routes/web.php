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
Route::middleware('auth')->get('/menu', 'HomeController@menu')->name('menu');


Route::group(['middleware' => 'auth'], function ($route) {

    Route::get('/kasus/rekap_angka', 'RekapKasusController@rekapKasus')->name('kasus.rekapAngka');
    Route::get('/kasus/rekap_rs', 'RekapKasusController@rekapRs')->name('kasus.rekapRs');
    Route::get('/kasus/rekap_kecepatan_lapor', 'RekapKasusController@kecepatanLapor')->name('kasus.rekapKecepatan');

    Route::get('/kasus', 'KasusController@index')->name('kasus');
    Route::get('/kasus/tambah', 'KasusController@create')->name('kasus.create');
    Route::post('/kasus/tambah', 'KasusController@store')->name('kasus.store');
    Route::get('/kasus/{idk}', 'KasusController@show')->name('kasus.show');
    Route::get('/kasus/{idk}/edit', 'KasusController@edit')->name('kasus.edit');
    Route::put('/kasus/{idk}/edit', 'KasusController@update')->name('kasus.update');
    Route::get('/kasus/{idk}/verif', 'KasusController@verif')->name('kasus.verif');
    Route::put('/kasus/{idk}/verif', 'KasusController@verifSave')->name('kasus.verif.save');
    Route::delete('/kasus/{idk}', 'KasusController@destroy')->name('kasus.destroy');

    Route::get('/pe', 'PeController@index')->name('pe');
    Route::get('/pe/{idk}', 'PeController@create')->name('pe.create');
    Route::post('/pe/{idk}', 'PeController@store')->name('pe.store');
    Route::get('/pe/{idk}/edit', 'PeController@edit')->name('pe.edit');
    Route::put('/pe/{idk}/edit', 'PeController@update')->name('pe.update');
    Route::delete('/pe/{idk}', 'PeController@destroy')->name('pe.destroy');

    Route::get('/sicentik', 'SicentikController@index')->name('sicentik');
    Route::get('/sicentik/rekap', 'SicentikController@index')->name('sicentik.rekap');
    Route::get('/sicentik/tambah', 'SicentikController@create')->name('sicentik.create');
    Route::post('/sicentik/tambah', 'SicentikController@store')->name('sicentik.store');
    Route::get('/sicentik/{id}/edit', 'SicentikController@edit')->name('sicentik.edit');
    Route::put('/sicentik/{id}/edit', 'SicentikController@update')->name('sicentik.update');
    Route::delete('/sicentik/{id}', 'SicentikController@destroy')->name('sicentik.destroy');

    Route::get('/pjn', 'PjnController@index')->name('pjn');
    Route::get('/pjn/rekap', 'PjnController@index')->name('pjn.rekap');
    Route::get('/pjn/tambah', 'PjnController@create')->name('pjn.create');
    Route::post('/pjn/tambah', 'PjnController@store')->name('pjn.store');
    Route::get('/pjn/{id}/edit', 'PjnController@edit')->name('pjn.edit');
    Route::put('/pjn/{id}/edit', 'PjnController@update')->name('pjn.update');
    Route::delete('/pjn/{id}', 'PjnController@destroy')->name('pjn.destroy');

    Route::get('/monev_pjn', 'MonevPjnController@index')->name('monev_pjn');
    Route::get('/monev_pjn/rekap', 'MonevPjnController@index')->name('monev_pjn.rekap');
    Route::get('/monev_pjn/tambah', 'MonevPjnController@create')->name('monev_pjn.create');
    Route::post('/monev_pjn/tambah', 'MonevPjnController@store')->name('monev_pjn.store');
    Route::get('/monev_pjn/{id}/edit', 'MonevPjnController@edit')->name('monev_pjn.edit');
    Route::put('/monev_pjn/{id}/edit', 'MonevPjnController@update')->name('monev_pjn.update');
    Route::delete('/monev_pjn/{id}', 'MonevPjnController@destroy')->name('monev_pjn.destroy');

    Route::get('/srsj', 'SrsjController@index')->name('srsj');
    Route::get('/srsj/rekap', 'SrsjController@index')->name('srsj.rekap');
    Route::get('/srsj/tambah', 'SrsjController@create')->name('srsj.create');
    Route::post('/srsj/tambah', 'SrsjController@store')->name('srsj.store');
    Route::get('/srsj/{id}/edit', 'SrsjController@edit')->name('srsj.edit');
    Route::put('/srsj/{id}/edit', 'SrsjController@update')->name('srsj.update');
    Route::delete('/srsj/{id}', 'SrsjController@destroy')->name('srsj.destroy');
});

Route::get('test', 'TestWsController@test');
