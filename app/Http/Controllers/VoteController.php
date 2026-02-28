<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'votable_id' => 'required|integer',
            'votable_type' => 'required|in:post,comment',
            'value' => 'required|in:-1,1',
        ]);

        $modelClass = $request->votable_type === 'post'
            ? \App\Models\Post::class
            : \App\Models\Comment::class;

        $model = $modelClass::findOrFail($request->votable_id);

        $vote = Vote::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'votable_id' => $request->votable_id,
                'votable_type' => $modelClass,
            ],
            ['value' => $request->value]
        );

        $totalVotes = $model->votes()->sum('value');

        if ($request->votable_type === 'post') {
            $model->update(['votes_count' => $totalVotes]);
        }

        return back();
    }
}