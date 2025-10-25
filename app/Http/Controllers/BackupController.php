<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackupController extends Controller
{
    //
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->with('tags')->get();
        $filename = 'backup-notes-'.now()->format('Ymd_His').'.json';
        return response()->streamDownload(function() use ($notes){
            echo $notes->toJson(JSON_PRETTY_PRINT);
        }, $filename);
    }
}
