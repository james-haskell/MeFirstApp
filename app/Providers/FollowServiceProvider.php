<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Follows;

class FollowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getAll($userId) {
        $followingIds = Follows::getAllFollowingIds($userId);
        return Self::getFollowingDataFromIds($followingIds);
    }

    public static function getTopTen($userId) {
        $followingIds = Follows::getTopTenIds($userId);
        return Self::getFollowingDataFromIds($followingIds);
    }

    public static function getFollowingDataFromIds($followingIds) {
        $followingData = [];
        for ($i=0; $i<count($followingIds); $i++) {
            $name = DB::table('users')
                ->where('id', $followingIds[$i])
                ->pluck('name');
            
            $profilePic = null;

            $onlineStatus = null;

            $followingData[$i] = (object)[
                'id' => $followingIds[$i],
                'name' => $name[0],
                'profilePic' => $profilePic,
                'onlineStatus' => $onlineStatus,
            ];
        }

        return $followingData;
    }
}
