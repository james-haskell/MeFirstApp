<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GroupServiceProvider;
use App\Providers\UserServiceProvider;
use App\Models\MyGroup;
use App\Models\User;

class GroupController extends Controller
{
    public function add(Request $request, $userId) {
        $user = User::find($userId);
        $response = MyGroup::add($request, $user);
        
        if ($response) {
            return redirect()->route('home');
        }
    }

    public function getGroupDataById(Request $request) {
        $groupId = $request->groupId;
        return GroupServiceProvider::getGroupDataById($groupId);
    }

    public function getMyGroups($userId) {
        return GroupServiceProvider::getMyGroups($userId);
    }

    public function joinGroup(Request $request) {
        $userId = $request->userId;
        $groupId = $request->groupId;
        return GroupServiceProvider::joinGroup($groupId, $userId);
    }

    public function leaveGroup(Request $request) {
        $userId = $request->userId;
        $groupId = $request->groupId;
        return GroupServiceProvider::leaveGroup($groupId, $userId);
    }
}