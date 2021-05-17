<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function showAddForm($userId) {
        return view('add-group', [
            'userId' => $userId
        ]);
    }
}
