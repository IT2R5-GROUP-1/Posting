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

    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully.']);
    }

    public function search(Request $request)
{
    // Get the search term from the query parameters
    $searchTerm = $request->get('q');
    
    // Search in 'title' and 'content' columns
    $posts = Post::where('title', 'LIKE', '%' . $searchTerm . '%')
                 ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
                 ->get();

    if ($posts->isEmpty()) {
        return response()->json(['message' => 'No posts found.'], 404);
    }

    return response()->json($posts);
}

}
