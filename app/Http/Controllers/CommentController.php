<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Комментарий добавлен!');
    }
}