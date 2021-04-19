<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(Request $request, Post $post) {
        $posts = $post->whereIn('user_id', $request->user()->following()
                        ->pluck('users.id')
                        ->push($request->user()->id))
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->take($request->get('limit', 10)) // TODO: increase limit to see all posts, but don't load them unless the user scrolls
                        ->get();

        return response()->json($posts);
    }

    public function store(Request $request, Post $post) {
        $newPost = $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return response()->json($post->with('user')->find($newPost->id));
    }
}
