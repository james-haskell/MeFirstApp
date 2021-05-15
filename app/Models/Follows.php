<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Follows extends Model
{
    use HasFactory;

    // TODO: Create system to pick top 10 people following
    public static function getTopTen($userId) {
        $followingIds = DB::table('follows')
            ->where('follower_id', $userId)
            ->inRandomOrder()
            ->limit(10)
            ->pluck('following_id');
        
        $followingData = [];
        for ($i=0; $i<count($followingIds); $i++) {
            $name = DB::table('users')
                ->where('id', $followingIds[$i])
                ->pluck('name');
            $followingData[$i] = (object)[
                'id' => $followingIds[$i],
                'name' => $name[0],
                'profilePic' => null,
                'onlineStatus' => null,
            ];
        }

        return $followingData;
    }

    public function user() {
        return $this->belongsTo(User::class);
     }
}
