<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', [NoteController::class, 'notes'])->name('notes');
Route::get('/note/{id}', [NoteController::class, 'showNotes'])->name('showNotes');
Route::get('/create', [NoteController::class, 'createNote'])->name('createNote');
Route::post('/note/create', [NoteController::class, 'createNoteSubmit'])->name('createNoteSubmit');
Route::get('/note/edit/{id}', [NoteController::class, 'editNote'])->name('editNote');
Route::post('/note/update/{id}', [NoteController::class, 'updateNote'])->name('updateNote');
Route::post('/note/delete/{id}', [NoteController::class, 'deleteNote'])->name('deleteNote');