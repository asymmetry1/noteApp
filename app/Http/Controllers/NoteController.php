<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('tags')->orderBy('is_pinned','desc')->latest()->get();
        $tags  = Tag::all();

    return view('notes.index', compact('notes','tags'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'=>'required|string|max:255',
            'content'=>'nullable|string',
            'tags'=>'array'
        ]);

        $note = Note::create($data);
        if($r->filled('tags')) $note->tags()->sync($r->tags);

        return $r->wantsJson() ? response()->json($note->load('tags'),201) : back();
    }

    public function update(Request $r, Note $note)
    {
        $data = $r->validate([
            'title'=>'required|string',
            'content'=>'nullable|string',
            'is_pinned'=>'nullable|boolean',
            'tags'=>'array'
        ]);

        $note->update($data);
        $note->tags()->sync($r->tags ?? []);

        return $r->wantsJson() ? response()->json($note->load('tags')) : back();
    }

    public function togglePin(Note $note)
    {
        $note->is_pinned = !$note->is_pinned;
        $note->save();

        return redirect()->back();
    }


    public function destroy(Note $note)
    {
        $note->delete();
        return back();
    }

    public function archived()
    {
        // Show all soft-deleted (archived) notes
        $notes = \App\Models\Note::onlyTrashed()->orderByDesc('deleted_at')->get();
        return view('notes.archived', compact('notes'));
    }

    public function restore($id)
    {
        $note = \App\Models\Note::onlyTrashed()->findOrFail($id);
        $note->restore();
        return back();
    }

    public function forceDelete($id)
    {
        $note = \App\Models\Note::onlyTrashed()->findOrFail($id);
        $note->forceDelete();
        return back();
    }

    public function trash()
    {
        $notes = \App\Models\Note::onlyTrashed()
            ->orderByDesc('deleted_at')
            ->get();

        return view('notes.trash', compact('notes'));
    }
}
