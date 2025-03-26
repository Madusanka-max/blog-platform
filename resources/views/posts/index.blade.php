@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @foreach($posts as $post)
    <div class="bg-white rounded-lg shadow mb-4 p-6">
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>
        <p class="text-gray-600">{{ Str::limit($post->content, 200) }}</p>
        <div class="mt-4 text-sm text-gray-500">
            Posted by {{ $post->user->name }}
        </div>
    </div>
    @endforeach
</div>
@endsection