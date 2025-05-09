<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CommentController extends BaseController
{
    public function comment($postId, Request $request)
    {
        $post = Post::findOrFail($postId);

        $comment = new Comment([
            'username' => 'User_' . substr(md5(rand()), 0, 9),
            'text' => $request->text,
        ]);

        $post->comments()->save($comment);

        return response()->json($comment, 201);
    }

    public function reply($commentId, Request $request)
    {
        $parent = Comment::findOrFail($commentId);

        $reply = new Comment([
            'username' => 'User_' . substr(md5(rand()), 0, 9),
            'text' => $request->text,
            'parent_id' => $parent->id,
        ]);

        $parent->replies()->save($reply);

        return response()->json($reply, 201);
    }
}
