<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $recent = Note::where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('pages.activity', compact('recent'));
    }
}
