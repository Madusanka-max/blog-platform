<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate(['content' => 'required|string|max:500']);
        
        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Comment added!');
    }
}