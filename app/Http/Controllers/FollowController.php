<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\FollowServiceProvider;

class FollowController extends Controller
{
    public function getAllFollowers($userId) {
        return FollowServiceProvider::getAllFollowers($userId);
    }

    public function getAllFollowing($userId) {
        return FollowServiceProvider::getAllFollowing($userId);
    }

    // Get data of users that are followed by current user
    // TODO: Update to get profile picture, online status
    public function getTopTen($userId) {
        return FollowServiceProvider::getTopTen($userId);
    }

    public function showFollowers($userId) {
        return view('followers', [
            'userId' => $userId
        ]);
    }

    public function showFollowing($userId) {
        return view('following', [
            'userId' => $userId
        ]);
    }
}
