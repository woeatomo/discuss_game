<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::latest()->get();
        return view('discussion.index', compact('discussions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $discussion = Discussion::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('discussion.index')->with('success', 'Discussion created successfully!');
    }
}