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

Route::group(['middleware' => ['api']], function () {
    Route::get('/get/allNote', 'Api\EveryoneNoteController@getAllNotes');
    Route::get('/get/allFavoriteNotes', 'Api\EveryoneNoteController@getAllFavoriteNotes');

    Route::get('get/myNote', 'Api\MyNoteController@getMyNotes');
    Route::get('get/myFavoriteNotes', 'Api\MyNoteController@getMyFavoriteNotes');

    Route::get('get/searchNote', 'Api\SearchNoteController@searchNote');
    Route::get('get/searchMyNote', 'Api\SearchNoteController@searchMyNote');

    Route::post('get/registerNote', 'Api\RegisterNoteController@registerNote');

    Route::post('post/switchFavorite', 'Api\SwitchFavoriteNoteController@switchFavorite');

    Route::post('delete/deleteNote', 'Api\DeleteMyNoteController@deleteNote');
    Route::post('update/updateNote', 'Api\UpdateMyNoteController@updateNote');
});
