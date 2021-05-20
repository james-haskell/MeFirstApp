<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\MyGroup;

class GroupServiceProvider extends ServiceProvider
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

    public static function getGroupDataById($groupId) {
        $groupData = MyGroup::getGroupDataById($groupId);
        if (count($groupData) !== 0) {
            return response()->json(
                $groupData[0]
            );
        }

        return response()->json([
            'error' => 'There is no group with ID of ' . $groupId
        ]);
    }

    public static function joinGroup($groupId, $userId) {
        $memberIds = MyGroup::getGroupMemberIds($groupId)[0]->member_ids;
        
        if (true) { //TODO: Check if user is already joined -> similar to follow system?
            array_push($memberIds, (int) $userId);

            MyGroup::find($groupId)->update(['member_ids' => $memberIds]);
            return $memberIds;
        }
        //TODO: Add error handling
    }
}
