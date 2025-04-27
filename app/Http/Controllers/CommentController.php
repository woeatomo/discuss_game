<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Comment added successfully', 'comment' => $comment], 201);
    }

    public function index(Post $post)
    {
        return $post->comments()->with('user')->get();
    }
}