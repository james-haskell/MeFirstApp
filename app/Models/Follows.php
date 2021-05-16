<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Follows extends Model
{
    use HasFactory;

    // TODO: Add more data to all following page
    public static function getAllFollowingIds($userId) {
        $followingIds = DB::table('follows')
            ->where('follower_id', $userId)
            ->pluck('following_id');

        return $followingIds;
    }

    // TODO: Create system to pick top 10 people following
    public static function getTopTenIds($userId) {
        $followingIds = DB::table('follows')
            ->where('follower_id', $userId)
            ->inRandomOrder()
            ->limit(10)
            ->pluck('following_id');
        
        return $followingIds;
    }

    public function user() {
        return $this->belongsTo(User::class);
     }
}
