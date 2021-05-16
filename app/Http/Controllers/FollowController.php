<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\FollowServiceProvider;

class FollowController extends Controller
{
    public function getAll($userId) {
        return FollowServiceProvider::getAll($userId);
    }

    // Get data of users that are followed by current user
    // TODO: Update to get profile picture, online status
    public function getTopTen($userId) {
        return FollowServiceProvider::getTopTen($userId);
    }

    public function showFollowing($userId) {
        return view('following', [
            'userId' => $userId
        ]);
    }
}
