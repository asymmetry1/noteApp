<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function index()
    {
        return view('pages.dashboard'); // or match your folder (e.g., pages/settings)
    }
}
