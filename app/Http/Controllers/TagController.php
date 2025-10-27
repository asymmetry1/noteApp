<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $tags = \App\Models\Tag::withCount(['notes' => function($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->where('user_id', $userId)
        ->orderBy('name')
        ->get();

        return view('pages.tags', compact('tags'));
    }

    public function store(Request $r)
    {
        $data = $r->validate(['name' => 'required|string|max:255']);

        Tag::create([
            'name' => $data['name'],
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Tag $tag)
    {
        abort_unless($tag->user_id === auth()->id(), 403);
        $tag->delete();
        return back();
    }
}

