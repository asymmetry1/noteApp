<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
        $theme = Session::get('theme', 'light');
        return view('pages.settings', compact('theme'));
    }

    public function toggleTheme() {
        $theme = Session::get('theme', 'light') === 'light' ? 'dark' : 'light';
        Session::put('theme', $theme);
        return back();
    }
}
