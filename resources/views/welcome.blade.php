{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Create a Note</title>
</head>
<body class="antialiased">
<div class="container">
    <h1 class="text-4xl font-bold mb-4">KeyNotes</h1>

    <!-- Notes List Section -->

    <div id="notesListSection">
        <div id="notesList" class="mb-4"></div>
        <button id="showCreateNoteForm" class="bg-violet-500 text-white rounded p-2">Create New Note</button>
    </div>

    <!-- Create Note Form Section (Initially Hidden) -->
    <div id="createNoteSection" class="hidden">
        <h2 class="text-2xl font-bold mb-4">Create a New Note</h2>
        <form id="noteForm">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="border rounded p-2 mb-4 w-full">

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" class="border rounded p-2 mb-4 w-full">

            <label for="content">Content:</label>
            <textarea id="content" name="content" class="border rounded p-2 mb-4 w-full" required></textarea>

            <button type="submit" class="bg-violet-500 text-white rounded p-2">Create Note</button>
            <button id="cancelCreateNote" type="button" class="bg-gray-500 text-white rounded p-2 ml-2">Cancel</button>
        </form>
    </div>
</div>

<script>
    function loadNotes() {
        const notesList = document.getElementById('notesList');
        notesList.innerHTML = ''; // Clear the notes list

        const notes = JSON.parse(localStorage.getItem('notes')) || [];

        notes.forEach((note, index) => {
            const noteDiv = document.createElement('div');
            noteDiv.className = 'note mb-4 p-4 border rounded bg-gray-100';

            const isLongNote = note.content.length > 100;
            const displayedContent = isLongNote ? note.content.slice(0, 100) + '...' : note.content;

            noteDiv.innerHTML = `
                <strong>${note.title || 'Untitled'}</strong>
                <p><em>${note.description}</em></p>
                <p class="noteContent">${displayedContent}</p>
                <button class="edit-btn bg-violet-500 text-white rounded p-2 ml-">Edit</button>
                <button class="delete-btn bg-violet-500 text-white rounded p-2 ml-2">Delete</button>
            `;

            // Read more / Read less functionality
            if (isLongNote) {
                // Create Read More link
                const readMoreLink = document.createElement('span');
                readMoreLink.className = 'readMore text-violet-500 cursor-pointer mt-2';
                readMoreLink.textContent = 'Read More';

                readMoreLink.addEventListener('click', function() {
                    noteDiv.querySelector('.noteContent').textContent = note.content; // Show full content

                    // Create Read Less link
                    const readLessLink = document.createElement('span');
                    readLessLink.className = 'readLess text-blue-500 cursor-pointer mt-2 ml-2';
                    readLessLink.textContent = 'Read Less';

                    // Add click event for Read Less link
                    readLessLink.addEventListener('click', function() {
                        noteDiv.querySelector('.noteContent').textContent = displayedContent; // Show truncated content
                        this.remove(); // Remove Read Less link
                        readMoreLink.style.display = ''; // Show Read More link again
                    });

                    noteDiv.appendChild(readLessLink); // Add Read Less link to the note
                    this.style.display = 'none'; // Hide Read More link
                });

                noteDiv.appendChild(readMoreLink); // Add Read More link to the note
            }

            // Edit button functionality
            noteDiv.querySelector('.edit-btn').addEventListener('click', function() {
                document.getElementById('title').value = note.title; // Set title to input for editing
                document.getElementById('description').value = note.description; // Set description to input for editing
                document.getElementById('content').value = note.content; // Set content to input for editing
                notes.splice(index, 1); // Remove the note from the array for re-adding
                localStorage.setItem('notes', JSON.stringify(notes)); // Update local storage
                loadNotes(); // Reload notes
                notesListSection.classList.add('hidden'); // Hide notes section
                createNoteSection.classList.remove('hidden'); // Show create section
            });

            // Delete button functionality
            noteDiv.querySelector('.delete-btn').addEventListener('click', function() {
                const confirmed = confirm("Are you sure you want to delete this note?");
                if (confirmed) {
                    notes.splice(index, 1); // Remove the note from the array
                    localStorage.setItem('notes', JSON.stringify(notes)); // Update local storage
                    loadNotes(); // Reload notes
                }
            });

            // Append the new note to the list
            notesList.appendChild(noteDiv);
        });
    }

    // Initial load of notes
    window.onload = function() {
        loadNotes();
    };

    // Show Create Note Form when button is clicked
    document.getElementById('showCreateNoteForm').addEventListener('click', function() {
        document.getElementById('notesListSection').classList.add('hidden');
        document.getElementById('createNoteSection').classList.remove('hidden');
    });

    // Cancel creating note and go back to the notes list
    document.getElementById('cancelCreateNote').addEventListener('click', function() {
        document.getElementById('createNoteSection').classList.add('hidden');
        document.getElementById('notesListSection').classList.remove('hidden');
        // Clear input fields
        document.getElementById('title').value = '';
        document.getElementById('description').value = '';
        document.getElementById('content').value = '';
    });

    // Handle form submission for creating a new note
    document.getElementById('noteForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        const titleInput = document.getElementById('title');
        const descriptionInput = document.getElementById('description');
        const contentInput = document.getElementById('content');

        let title = titleInput.value.trim() || "Untitled";
        let description = descriptionInput.value.trim();
        let content = contentInput.value.trim();

        if (content) {
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const note = { title, description, content };
            notes.push(note); // Add new note to array

            // Save notes back to localStorage
            localStorage.setItem('notes', JSON.stringify(notes));

            // Reload the notes list and switch back to the notes list section
            loadNotes();
            createNoteSection.classList.add('hidden');
            notesListSection.classList.remove('hidden');

            // Clear input fields
            titleInput.value = '';
            descriptionInput.value = '';
            contentInput.value = '';
        } else {
            alert("Content is required to create a note."); // Optional: Alert if content is missing
        }
    });
</script>
</body>
</html> --}}