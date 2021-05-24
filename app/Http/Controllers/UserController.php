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

    public function show(User $user) {
            return view('user')->with('user', $user)->with('userId', $user->id);
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
