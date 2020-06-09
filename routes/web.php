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
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/registerNote', 'RegisterNoteController@registerNote');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//test用
// Route::get('get/everyoneNote', 'Api\EveryoneNoteController@getAllNotes');


