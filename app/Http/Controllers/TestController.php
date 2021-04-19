<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    protected $item;

    public function testGet(Request $request, User $user) {
        return ['status' => 'success'];
    }

    public function testPost(Request $request, User $user) {
        return response()->json([
            'status' => $request->all()
        ]);
    }
}
