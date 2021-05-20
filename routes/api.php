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
Route::get('followers/{userId}/all', 'App\Http\Controllers\FollowController@getAllFollowers');

// Following Routes
Route::get('following/{userId}/all', 'App\Http\Controllers\FollowController@getAllFollowing');
Route::get('following/{userId}/topTen', 'App\Http\Controllers\FollowController@getTopTen');

// Group Routes
Route::get('groups/{user}/add', 'App\Http\Controllers\GroupController@add');
Route::get('groups/lfg', 'App\Http\Controllers\GroupController@getGroupDataById');
Route::get('groups/{groupId}/join/{userId}', 'App\Http\Controllers\GroupController@joinGroup');

Route::get('users/{userId}/data', 'App\Http\Controllers\UserController@getUserDataById');

