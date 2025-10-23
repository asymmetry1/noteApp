<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $total = Note::count();
        $pinned = Note::where('is_pinned', true)->count();
        $trashed = Note::onlyTrashed()->count();

        return view('pages.dashboard', compact('total', 'pinned', 'trashed'));
    }
}
