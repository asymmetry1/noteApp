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
        $current = Session::get('theme', 'light');
        $new = $current === 'light' ? 'dark' : 'light';
        Session::put('theme', $new);

        return back();
    }
}
