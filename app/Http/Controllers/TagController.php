<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function index() {
        $tags = Tag::where('user_id', auth()->id())->get();
        return view('pages.tags', compact('tags'));
    }

    public function store(Request $r) {
        $r->validate(['name' => 'required|string|unique:tags,name']);

        Tag::create([
            'name' => $data['name'],
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Tag $tag) {
        abort_unless($tag->user_id === auth()->id(), 403);
        $tag->delete();
        return back();
    }
}
