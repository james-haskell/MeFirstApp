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

Route::get('test', 'App\Http\Controllers\TestController@testGet');
Route::post('test/{post}', 'App\Http\Controllers\TestController@testPost');

Route::get('following/{userId}/all', 'App\Http\Controllers\FollowController@getAll');
Route::get('following/{userId}/topTen', 'App\Http\Controllers\FollowController@getTopTen');

