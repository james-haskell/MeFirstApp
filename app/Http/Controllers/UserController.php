<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\UserServiceProvider;

class UserController extends Controller
{
    public function getRouteKeyName() {
        return 'name';
    }

    public function getUserDataById($userId) {
        return UserServiceProvider::getUserDataById($userId);
    }

    public function show(Request $request, User $user) {
        $isNot = 0;
        $isFollowing = 0;
        if ($request->user()->getUserId() !== $user->id) {
            $isNot = 1;
            if ($request->user()->isFollowing($user)) {
                $isFollowing = 1;
            }
        }
        return view('user')->with('user', $user)->with('isNot', $isNot)->with('isFollowing', $isFollowing);
    }

    public function follow(Request $request, User $user) {
        if ($request->user()->canFollow($user)) {
            $request->user()->following()->attach($user);
        }

        return redirect()->back();
    }

    public function unFollow(Request $request, User $user) {
        if ($request->user()->canUnFollow($user)) {
            $request->user()->following()->detach($user);
        }

        return redirect()->back();
    }
    
}
