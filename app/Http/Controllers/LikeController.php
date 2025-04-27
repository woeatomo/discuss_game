<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like removed']);
        } else {
            $post->likes()->create(['user_id' => auth()->id()]);
            return response()->json(['message' => 'Like added']);
        }
    }

    public function countLikes(Post $post)
    {
        return response()->json(['likes_count' => $post->likes()->count()]);
    }
}