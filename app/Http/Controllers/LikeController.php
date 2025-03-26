<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if($like) {
            $like->delete();
            return back()->with('success', 'Post unliked!');
        }

        $post->likes()->create(['user_id' => auth()->id()]);
        return back()->with('success', 'Post liked!');
    }
}