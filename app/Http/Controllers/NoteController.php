<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function notes(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "")
        {
            $notes = Note::where('title', 'LIKE', "%$search%")->get();
        }else {
            $notes = Note::orderBy('created_at', 'desc')->get();
        }
     
        return view('notes', ['notes' => $notes, 'search' => $search]);
    }

    public function showNotes($id)
    {
        $note = Note::find($id); // finds the id of individual

        if (!$note)
        {
            return redirect()->route('notes')->with('error','Note not found');

        }

        return view('note', ['note' => $note]); //return note


    }

    public function createNote(Request $request)
    {
        return view('create-note');
    }

    public function createNoteSubmit(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'body' => 'required|string'

        ]);


    $note =new Note();
    $note->title = $validated['title'];
    $note->description = $validated['description'];
    $note->body = $validated['body'];
    $note->save();

    return redirect()->route('notes')->with('success','Note created Successfully.');
        
    }

    public function editNote($id)
    {
        $note = Note::find($id);

        if (!$note)
        {
            return redirect()->route('notes')->with('error','Note not found');
        }
        return view('edit-note', ['note' => $note]);
        
    }

    public function updateNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'content' => 'required|string',

        ]);

        $note = Note::find($request->id);

        if (!$note)
        {
            return redirect()->route('notes')->with('error','Note not found');
        }


        $note->title = $validated['title'];
        $note->description = $validated['description'];
        $note->body = $validated['content'];
        $note->save();

        return redirect()->route('showNotes', ['id' => $note->id])->with('success','Note updated Successfully.');
        
    }
}