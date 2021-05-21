<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\MyGroup;
use App\Models\User;

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
        $memberNames = MyGroup::getGroupMemberNames($groupId)[0]->member_names;
        $newName = User::where('id', $userId)
            ->pluck('name');
        $isJoined = in_array($userId, $memberIds);

        if (!$isJoined) {
            array_push($memberIds, (int) $userId);
            array_push($memberNames, $newName[0]);

            MyGroup::find($groupId)->update([
                'member_ids' => $memberIds,
                'member_names' => $memberNames
            ]);
            return $memberNames;
        }
        return abort(404);
    }

    public static function leaveGroup($groupId, $userId) {
        $memberIds = MyGroup::getGroupMemberIds($groupId)[0]->member_ids;
        $memberNames = MyGroup::getGroupMemberNames($groupId)[0]->member_names;
        $isJoined = in_array($userId, $memberIds);

        if ($isJoined) {
            //Remove user's id from members array
            $index = array_search($userId, $memberIds);
            unset($memberIds[$index]);
            unset($memberNames[$index]);
            $memberIds = array_values($memberIds);
            $memberNames = array_values($memberNames);
            
            MyGroup::find($groupId)->update([
                'member_ids' => $memberIds,
                'member_names' => $memberNames
            ]);
            return $memberNames;
        }
        return abort(404);
    }
}
