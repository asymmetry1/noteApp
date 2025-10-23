<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function index() {
        $tags = Tag::withCount('notes')->get();
        return view('pages.tags', compact('tags'));
    }

    public function store(Request $r) {
        $r->validate(['name' => 'required|string|unique:tags,name']);
        Tag::create(['name' => $r->name]);
        return back();
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        return back();
    }
}
