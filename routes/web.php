<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

//Home Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// Auth Routes
Route::middleware(['auth'])->group(function () {
    // User Profile Routes
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show')->name('user.show');

    // Follow Routes
    Route::get('users/{user}/follow', 'App\Http\Controllers\UserController@follow')->name('user.follow');
    Route::get('users/{user}/unfollow', 'App\Http\Controllers\UserController@unFollow')->name('user.unfollow');

    // Post Routes
    Route::get('posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
    Route::post('posts/post', 'App\Http\Controllers\PostController@store');   
});






