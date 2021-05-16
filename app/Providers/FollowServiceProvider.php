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

    public static function getAllFollowers($userId) {
        $followerIds = Follows::getAllFollowerIds($userId);
        return Self::getDataFromIds($followerIds);
    }

    public static function getAllFollowing($userId) {
        $followingIds = Follows::getAllFollowingIds($userId);
        return Self::getDataFromIds($followingIds);
    }

    public static function getTopTen($userId) {
        $followingIds = Follows::getTopTenIds($userId);
        return Self::getDataFromIds($followingIds);
    }

    public static function getDataFromIds($ids) {
        $data = [];
        for ($i=0; $i<count($ids); $i++) {
            $name = DB::table('users')
                ->where('id', $ids[$i])
                ->pluck('name');
            
            $profilePic = null;

            $onlineStatus = null;

            $data[$i] = (object)[
                'id' => $ids[$i],
                'name' => $name[0],
                'profilePic' => $profilePic,
                'onlineStatus' => $onlineStatus,
            ];
        }

        return $data;
    }
}
