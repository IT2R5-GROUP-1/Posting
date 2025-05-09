<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class PostController extends BaseController
{
    // Create a new post
    public function create(Request $request)
    {
        // Validate incoming request
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create new post
        $post = Post::create([
            'username' => 'User_' . substr(md5(rand()), 0, 9),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Return the created post as JSON
        return response()->json($post, 201);
    }

    // Get all posts
    public function getAll()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Get post by ID
    public function getById($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }
}
