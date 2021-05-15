<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Follows;

class FollowController extends Controller
{
    // Get data of users that are followed by current user
    // TODO: Update to get profile picture, online status
    public function getAllFollowing($userId) {
        return Follows::getAllFollowing($userId);
    }
}
