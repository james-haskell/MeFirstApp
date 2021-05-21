<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\GroupServiceProvider;
use App\Providers\UserServiceProvider;
use App\Models\MyGroup;
use App\Models\User;

class GroupController extends Controller
{
    public function add(Request $request, User $user) {
        $response = MyGroup::add($request, $user);
        
        if ($response) {
            return redirect()->route('home');
        }
    }

    public function getGroupDataById(Request $request) {
        $groupId = $request->groupId;
        return GroupServiceProvider::getGroupDataById($groupId);
    }

    public function joinGroup(Request $request, $groupId) {
        $userId = $request->userId;
        return GroupServiceProvider::joinGroup($groupId, $userId);
    }

    public function leaveGroup(Request $request, $groupId) {
        $userId = $request->userId;
        return GroupServiceProvider::leaveGroup($groupId, $userId);
    }

    public function showAddForm($userId) {
        return view('add-group', [
            'userId' => $userId
        ]);
    }

    public function showGroupPage(Request $request, $groupId) {
        $userId = UserServiceProvider::getUserId($request);
        return view('groups.group', [
            'groupId' => $groupId,
            'userId' => $userId
        ]);
    }
}
