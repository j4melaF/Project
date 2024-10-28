{{-- @extends('layouts.app')

@section('content')
<div id="noteApp">
    <form id="noteForm" onsubmit="submitNoteForm(event)">
        <!-- Add fields for title, description, content -->
    </form>

    <button onclick="showSection('notesList')">Notes</button>
    <button onclick="showSection('archive')">Archive</button>
    <button onclick="showSection('trashbin')">Trashbin</button>
    <button onclick="showSection('favorites')">Favorites</button>

    <div id="notesList"></div>
</div>

<script>
    async function submitNoteForm(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        await fetch('/notes', { method: 'POST', body: data });
        loadNotes();
    }

    async function archiveNote(id) {
        await fetch(`/notes/${id}/archive`, { method: 'POST' });
        loadNotes();
    }

    // Define similar async functions for other actions: trashNote, recoverNote, deleteNote, favoriteNote
</script>
@endsection --}}
