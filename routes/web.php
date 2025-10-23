<?php

use App\Http\Controllers\{
    DashboardController,
    NoteController,
    TagController,
    SettingsController,
    ProfileController,
    ActivityController,
    BackupController
};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function(){
    Route::get('/', fn() => redirect()->route('notes.index'));
    Route::resource('notes', NoteController::class)->except(['show','edit','create','update']);
    Route::patch('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::patch('/notes/{note}/pin', [NoteController::class, 'togglePin'])->name('notes.pin');


    // Core
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Route::resource('notes', NoteController::class);
    
    //archive n deletes
    //Route::get('/archived', [NoteController::class, 'archived'])->name('notes.archived');
    //Route::post('/notes/{id}/restore', [NoteController::class, 'restore'])->name('notes.restore');
    //Route::delete('/notes/{id}/force', [NoteController::class, 'forceDelete'])->name('notes.forceDelete');

    //trash
    Route::get('/trash', [NoteController::class, 'trash'])->name('notes.trash');
    Route::post('/notes/{id}/restore', [NoteController::class, 'restore'])->name('notes.restore');
    Route::delete('/notes/{id}/force', [NoteController::class, 'forceDelete'])->name('notes.forceDelete');

    //Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    // Utility
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/toggle', [SettingsController::class, 'toggleTheme'])->name('settings.toggle');

    Route::get('/account', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
    Route::get('/backup', [BackupController::class, 'index'])->name('backup');

    Route::post('/logout', function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

require __DIR__.'/auth.php';
