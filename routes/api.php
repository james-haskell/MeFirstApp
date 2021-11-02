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

// TODO: setup auth and middleware functionalities

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Follower Routes
Route::get('followers/{userId}/all', 'App\Http\Controllers\Api\FollowController@getAllFollowers');

// Following Routes
Route::get('following/{userId}/all', 'App\Http\Controllers\Api\FollowController@getAllFollowing');
Route::get('following/{userId}/topTen', 'App\Http\Controllers\Api\FollowController@getTopTen');

// Group Routes
Route::get('poop', 'App\Http\Controllers\Api\GroupController@poop');
Route::prefix('groups')->group(function () {
    Route::post('add/{userId}', 'App\Http\Controllers\Api\GroupController@add');
    Route::get('lfg', 'App\Http\Controllers\Api\GroupController@getGroupDataById');
    Route::get('mygroups/{userId}', 'App\Http\Controllers\Api\GroupController@getMyGroups');
    Route::put('join', 'App\Http\Controllers\Api\GroupController@joinGroup');
    Route::put('leave', 'App\Http\Controllers\Api\GroupController@leaveGroup');
});


Route::get('users/{userId}/data', 'App\Http\Controllers\UserController@getUserDataById');

