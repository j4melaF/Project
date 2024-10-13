<?php

namespace App\Http\Controllers;
use App\Models\Note;

use Illuminate\Http\Request;

class NoteController extends Controller
{


    public function index()
    {
        $notes = Note::orderBy('created_at', 'asc')->get();
        return view('notes', ['notes' => $notes]);
    }

    public function showNotes($id)
    {
        $note = Note::find($id); // finds the id of individual

        if (!$note)
        {
            return redirect()->route('index')->with('error','Note not found');

        }

        return view('note', ['note' => $note]); //return note


    }

    public function createNote()
    {
        return view('create-note');
    }

    public function createNoteSubmit(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'body' => 'required|string',

        ]);


    $note =new Note();
    $note->title = $validated['title'];
    $note->description = $validated['description'];
    $note->body = $validated['body'];
    $note->save();

    return redirect()->route('index')->with('success','Note created Successfully.');
        
    }

    public function editNote($id)
    {
        $note = Note::find($id);

        if (!$note)
        {
            return redirect()->route('index')->with('error','Note not found');
        }
        return view('edit-note', ['note' => $note]);
        
    }

    public function updateNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'body' => 'required|string',

        ]);

        $note = Note::find($request->id);

        if (!$note)
        {
            return redirect()->route('index')->with('error','Note not found');
        }


        $note->title = $validated['title'];
        $note->description = $validated['description'];
        $note->body = $validated['body'];
        $note->save();

        return redirect()->route('showNote', ['id' => $note->id])->with('success','Note updated Successfully.');
        
    }

    public function deleteNote(Request $request)
    {
        $note = Note::find($request->id);

        if ($note)
        {
            $note->delete();
        }
        return redirect()->route('index')->with('success','Note deleted successfully.');

    }







}
