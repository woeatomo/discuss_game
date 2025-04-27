<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Ambil 10 post per halaman
        $posts = Post::latest()->paginate(10);

        // Jika request adalah AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json($posts);
        }

        // Kembalikan tampilan awal untuk non-AJAX
        return view('posts.index', compact('posts'));
    }
}