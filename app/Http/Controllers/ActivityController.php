<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index() {
        $recent = Note::orderBy('updated_at','desc')->take(10)->get();
        return view('pages.activity', compact('recent'));
    }
}
