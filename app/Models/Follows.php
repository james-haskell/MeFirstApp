<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Follows extends Model
{
    use HasFactory;

    public static function getAllFollowerIds($userId) {
        $followerIds = DB::table('follows')
            ->where('following_id', $userId)
            ->pluck('follower_id');

        return $followerIds;
    }

    // TODO: Add more data to all following page
    public static function getAllFollowingIds($userId) {
        $followingIds = DB::table('follows')
            ->where('follower_id', $userId)
            ->pluck('following_id');

        return $followingIds;
    }

    // TODO: Create system to pick top 10 people following
    public static function getTopTenIds($userId) {
        $topTenIds = DB::table('follows')
            ->where('follower_id', $userId)
            ->inRandomOrder()
            ->limit(10)
            ->pluck('following_id');
        
        return $topTenIds;
    }

    public function user() {
        return $this->belongsTo(User::class);
     }
}
