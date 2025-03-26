<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::with('user')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048'
    ]);

    if($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        
        // Resize image
        Image::make(public_path("storage/{$imagePath}"))
            ->fit(1200, 630)
            ->save();

        $validated['image'] = $imagePath;
    }

    $request->user()->posts()->create($validated);

    return redirect()->route('posts.index');
}
}