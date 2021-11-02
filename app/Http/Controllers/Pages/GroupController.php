<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\UserServiceProvider;

class GroupController extends Controller
{
    public function showAddForm(Request $request) {
        $userId = $request['id'];
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
