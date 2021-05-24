<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

//Home Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// Auth Routes
Route::middleware(['auth'])->group(function () {
    // User Profile Routes
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show')->name('user.show');

    // Follow Routes -> TODO: these should be api routes since they just send and change data
    Route::get('users/{user}/follow', 'App\Http\Controllers\UserController@follow')->name('user.follow');
    Route::get('users/{user}/unfollow', 'App\Http\Controllers\UserController@unFollow')->name('user.unfollow');

    

    // Follower Routes
    Route::get('followers/{userId}/all', 'App\Http\Controllers\FollowController@showFollowers')->name('followers.all');

    // Following Routes
    Route::get('following/{userId}/all', 'App\Http\Controllers\FollowController@showFollowing')->name('following.all');

    // Group Routes
    Route::get('groups/{userId}/add', 'App\Http\Controllers\GroupController@showAddForm');
    Route::get('groups/{groupId}', 'App\Http\Controllers\GroupController@showGroupPage')->name('group.show');

    // Post Routes
    Route::get('posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
    Route::post('posts/post', 'App\Http\Controllers\PostController@store');   
});






