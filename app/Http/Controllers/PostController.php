<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'community'])->latest()->paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    public function store(Request $request, Community $community)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        $community->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'url' => $request->url,
        ]);

        return redirect()->route('communities.show', $community)->with('success', 'Пост создан!');
    }

    public function show(Community $community, Post $post)
    {
        $comments = $post->comments()->with('user')->whereNull('parent_id')->latest()->get();
        return view('posts.show', compact('community', 'post', 'comments'));
    }

    public function destroy(Community $community, Post $post)
    {
        $post->delete();
        return redirect()->route('communities.show', $community)->with('success', 'Пост удалён!');
    }

    public function edit(Community $community, Post $post) {}
    public function update(Request $request, Community $community, Post $post) {}
}