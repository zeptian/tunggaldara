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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/menu', 'HomeController@menu')->name('menu');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin')->name('doLogin');

Route::get('/kasus', 'KasusController@index')->name('kasus');
Route::get('/kasus/tambah', 'KasusController@create')->name('kasus.tambah');

Route::get('test', 'TestWsController@test');