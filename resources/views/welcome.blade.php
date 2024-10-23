<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Create a Note</title>
</head>
<body class="antialiased">
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Create a Note</h1>

        <form id="noteForm">
            <label for="title" class="block mb-2 text-2xl">Title:</label>
            <input type="text" id="title" name="title" class="border rounded p-2 mb-4 w-full">

            <label for="description" class="block mb-2 text-xl">Description:</label>
            <input type="text" id="description" name="description" class="border rounded p-2 mb-4 w-full">

            <label for="content" class="block mb-2 text-xl">Content:</label>
            <textarea id="content" name="content" class="border rounded p-2 mb-4 w-full" required></textarea>

            <button type="submit" class="bg-violet-500 text-white rounded p-2">Create Note</button>
        </form>

        <h2 class="text-xl font-bold mt-8">Your Notes:</h2>
        <div id="notesList" class="mt-4"></div>
    </div>

    <script>
    // Load notes from localStorage when the page loads
    window.onload = function() {
        loadNotes();
    };

    document.getElementById('noteForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const titleInput = document.getElementById('title');
        const descriptionInput = document.getElementById('description');
        const contentInput = document.getElementById('content');

        let title = titleInput.value.trim() || "Untitled";
        let description = descriptionInput.value.trim();
        let content = contentInput.value.trim();

        if (content) {
            const note = { title, description, content };

            // Save note to localStorage
            saveNoteToLocalStorage(note);

            // Clear the form inputs
            titleInput.value = '';
            descriptionInput.value = '';
            contentInput.value = '';

            // Load notes again to refresh the list
            loadNotes();
        } else {
            alert("Please enter some content for the note.");
        }
    });

    // Function to save notes to localStorage
    function saveNoteToLocalStorage(note) {
        const notes = JSON.parse(localStorage.getItem('notes')) || [];
        notes.push(note);
        localStorage.setItem('notes', JSON.stringify(notes));
    }

    // Function to load and display notes from localStorage
    function loadNotes() {
        const notesList = document.getElementById('notesList');
        notesList.innerHTML = ''; // Clear existing notes

        const notes = JSON.parse(localStorage.getItem('notes')) || [];
        notes.forEach((note, index) => {
            const noteDiv = document.createElement('div');
            noteDiv.className = 'note mb-4 p-4 border rounded bg-gray-100';

            const contentSnippet = note.content.split(' '); // Split content into words
            let displayContent;
            let readMoreHtml = '';

            if (contentSnippet.length > 100) {
                displayContent = contentSnippet.slice(0, 100).join(' ') + '...'; // Show first 100 words
                readMoreHtml = `<span class="read-more text-violet-500 cursor-pointer">Read More</span>`;
            } else {
                displayContent = note.content; // Show full content if less than 100 words
            }

            noteDiv.innerHTML = `
                <strong>${note.title}</strong>
                <p><em>${note.description}</em></p>
                <p class="noteContent">${displayContent} ${readMoreHtml}</p>
                <button class="editButton bg-violet-500 text-white rounded p-1 mt-2">Edit</button>
                <button class="deleteButton bg-violet-500 text-white rounded p-1 mt-2">Delete</button>
            `;

            // Add read more/less functionality
            if (contentSnippet.length > 100) {
                const noteContentEl = noteDiv.querySelector('.noteContent');
                noteContentEl.addEventListener('click', function(e) {
                    if (e.target.classList.contains('read-more')) {
                        noteContentEl.innerHTML = `${note.content} <span class="read-less text-violet-500 cursor-pointer">Read Less</span>`;
                    } else if (e.target.classList.contains('read-less')) {
                        noteContentEl.innerHTML = `${displayContent} ${readMoreHtml}`;
                    }
                });
            }

            // Add edit button functionality
            noteDiv.querySelector('.editButton').addEventListener('click', function() {
                document.getElementById('title').value = note.title;
                document.getElementById('description').value = note.description;
                document.getElementById('content').value = note.content;
                notesList.removeChild(noteDiv); // Remove the note from the list
                notes.splice(index, 1); // Remove from localStorage
                localStorage.setItem('notes', JSON.stringify(notes));
            });

            // Add delete button functionality
            noteDiv.querySelector('.deleteButton').addEventListener('click', function() {
                const confirmed = confirm("Are you sure you want to delete this note?");
                if (confirmed) {
                    notesList.removeChild(noteDiv); // Remove the note from the list
                    notes.splice(index, 1); // Remove from localStorage
                    localStorage.setItem('notes', JSON.stringify(notes));
                }
            });

            notesList.appendChild(noteDiv); // Append note to the list
        });
    }
    </script>
</body>
</html>
