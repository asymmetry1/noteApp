<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();

        $totalNotes = Note::where('user_id', $userId)->count();
        $pinnedNotes = Note::where('user_id', $userId)->where('is_pinned', true)->count();
        $deletedNotes = Note::onlyTrashed()->where('user_id', $userId)->count();

        return view('pages.dashboard', compact('totalNotes', 'pinnedNotes', 'deletedNotes'));
    }
}
