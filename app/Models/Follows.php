<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Follows extends Model
{
    use HasFactory;

    public static function getAllFollowing($userId) {
        $followingIds = DB::table('follows')
            ->where('follower_id', $userId)
            ->pluck('following_id');
        //return $followingIds;
        $followingData = [];
        for ($i=0; $i<count($followingIds); $i++) {
            $name = DB::table('users')
                ->where('id', $followingIds[$i])
                ->pluck('name');
            $followingData[$i] = (object)[
                'id' => $followingIds[$i],
                'name' => $name[0]
            ];
        }

        return $followingData;
    }

    public function user() {
        return $this->belongsTo(User::class);
     }
}
