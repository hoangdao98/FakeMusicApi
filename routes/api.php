<?php

use Illuminate\Http\Request;

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

Route::apiResource('/albums', 'AlbumController');

Route::group(['prefix'=>'albums'], function(){
	Route::apiResource('/{album}/audio', 'AudioController');
});

Route::apiResource('/audios', 'AudioController');
