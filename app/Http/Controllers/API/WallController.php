<?php

namespace App\Http\Controllers\API;

use App\Post;
use App\Http\Requests\Wall\NewPost;
use App\Http\Controllers\Controller;

class WallController extends Controller
{
    /**
     * Retrieve wall posts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json(compact('posts'), 200);
    }

    /**
     * Create a new post for the wall
     *
     * @param NewPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewPost $request)
    {
        $post = $request->user()->posts()->create([
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        return response()->json(compact('post'), 201);
    }
}
