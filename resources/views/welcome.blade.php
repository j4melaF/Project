<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KeyNotes Sidebar</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins] flex">
    <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="Openbar()">
        <i class="bi bi-filter-left px-2 bg-yellow-900 rounded-md"></i>
    </span>

    <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-300 p-2 w-[300px] overflow-y-auto text-center bg-#9cc5ed-400 shadow ">
        <div class="text-#fce700-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center rounded-md">
                <i class="bi bi-app-indicator px-2 py-1 bg-white-600 rounded-md text-white"></i>
                <h1 class="text-[15px] ml-3 text-xl text-#9cc5ed-200 font-bold">KeyNotes</h1>
                <i class="bi bi-x ml-auto cursor-pointer lg" onclick="Openbar()"></i>
            </div>

            <hr class="my-2 text-black-600">
            <input type="text" id="searchInput" placeholder="Search Notes..." class="p-2 w-full mb-4 rounded" onkeyup="searchNotes()">
            <div>
                <div onclick="showSection('createNoteSection')" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span class="text-[15px] ml-4">Create Note</span>
                </div>
                <div onclick="showSection('notesListSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-journal"></i>
                    <span class="text-[15px] ml-4">My Notes</span>
                </div>
                <div onclick="showSection('favoritesSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-heart-fill"></i>
                    <span class="text-[15px] ml-4">Favorites</span>
                </div>
                <div onclick="showSection('trashbinSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-500 text-white">
                    <i class="bi bi-trash-fill"></i>
                    <span class="text-[15px] ml-4">Trash</span>
                </div>
                <div onclick="showSection('archiveSection')" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-archive"></i>

                    <span class="text-[15px] ml-4">Archive</span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content transition-all duration-300 flex-1 ml-[0px] lg:ml-[300px]">
        <header class="flex-col justify-center">
            <h1 class="text-3xl font-bold text-blue-300 p-4">My Notes</h1>
            <div class="-mt-5">
                <h3 class="text-sm italic text-gray-500">keep note everything...</h3>
            </div>
        </header>

        <div id="notesListSection" class="note-list p-4">
            <div id="notesList"></div>
            
        </div>

        <div id="createNoteSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300 text-center">Create Note</h2>
            <form id="noteForm" class="flex flex-col items-center" onsubmit="return validateNote()">
                <label for="title" class="text-blue-300 font-bold">Title:</label>
                <input type="text" id="title" name="title" class="border rounded p-2 mb-4 w-full max-w-md">
                
                <label for="description" class="text-blue-300 font-bold">Description:</label>
                <input type="text" id="description" name="description" class="border rounded p-2 mb-4 w-full max-w-md">
                
                <label for="content" class="text-blue-300 font-bold">Content:</label>
                <textarea id="content" name="content" class="border rounded p-2 mb-2 w-full max-w-md" required oninput="checkWordCount()"></textarea>
                
                <!-- Error Message -->
                <p id="errorMessage" class="text-red-500 hidden">The content is required and should not exceed the 10,000-word limit.</p>
                <div class="flex flex-row space-x-4 mt-4">
                    <button type="submit" class="bg-blue-400 text-white rounded p-2 ml-2 hover:bg-blue-500" id="saveButton">Create Note</button>
                    <br>
                    <button type="button" class="bg-blue-400 text-white rounded p-2 ml-2 hover:bg-blue-600" onclick="showSection('notesListSection')">Cancel</button>
                </div>
            </form>
        </div>

        <div id="archiveSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300">Archive</h2>
            <div id="archiveList"></div>
        </div>

        <div id="trashbinSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300">Trash</h2>
            <div id="trashbinList"></div>
        </div>

        <div id="favoritesSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300">Favorites</h2>
            <div id="favoritesList"></div>
        </div>
    </div>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this note?</p>
            <button id="confirmDelete" class="button hover:bg-red-600">Yes, delete</button>
            <button id="cancelDelete" class="button button-cancel hover:bg-blue-500">Cancel</button>
        </div>
    </div>

    <div id="permanentDeleteModal" class="modal">
        <div class="modal-content">
            <p>Are you absolutely sure you want to permanently delete this note? This action cannot be undone.</p>
            <button id="confirmPermanentDelete" class="button button-danger hover:bg-red-600">Yes, permanently delete</button>
            <button id="cancelPermanentDelete" class="button button-cancel bg-blue-300 hover:bg-blue-500">Cancel</button>
        </div>
    </div>

    <div id="notification" class="notification"></div>    

    <div id="archiveModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to archive this note?</p>
            <button id="confirmArchive" class="button hover:bg-green-400">Yes, archive</button>
            <button id="cancelArchive" class="button button-cancel hover:bg-blue-500">Cancel</button>
        </div>
    </div>
    
    

    <script>
        function checkWordCount() {
            const content = document.getElementById("content").value;
            const wordCount = content.trim().split(/\s+/).filter(word => word.length > 0).length;
            const errorMessage = document.getElementById("errorMessage");
            const saveButton = document.getElementById("saveButton");

            if (wordCount === 0 || wordCount > 10000) {
                errorMessage.classList.remove("hidden"); // Show error message
                saveButton.disabled = true; // Disable save button
            } else {
                errorMessage.classList.add("hidden"); // Hide error message
                saveButton.disabled = false; // Enable save button
            }
        }

        function validateNote() {
            const content = document.getElementById("content").value;
            const wordCount = content.trim().split(/\s+/).filter(word => word.length > 0).length;
            
            // Check if content is empty or exceeds 10,000 words
            if (wordCount === 0) {
                alert("Content is required.");
                return false;
            } else if (wordCount > 10000) {
                alert("The content exceeds the 10,000-word limit.");
                return false;
            }
            return true; // Allow form submission if valid
        }

        const sidebarWidth = 300;
        const Openbar = () => {
            const sidebar = document.querySelector(".sidebar");
            const mainContent = document.querySelector(".main-content");
            sidebar.classList.toggle("left-0");
            sidebar.classList.toggle("left-[-300px]");

            if (sidebar.classList.contains("left-0")) {
                mainContent.style.marginLeft = `${sidebarWidth}px`;
            } else {
                mainContent.style.marginLeft = `0px`;
            }
        };

        const showSection = (sectionId) => {
            const sections = document.querySelectorAll(".main-content > div");
            sections.forEach(section => section.classList.add("hidden"));
            document.getElementById(sectionId).classList.remove("hidden");
            loadNotes(); // Load notes when displaying notes list
            if (sectionId === 'trashbinSection') loadTrashbin();
            if (sectionId === 'archiveSection') loadArchive();
            if (sectionId === 'favoritesSection') loadFavorites();
        };

        function loadNotes() {
            const notesList = document.getElementById('notesList');
            notesList.innerHTML = '';
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            notes.forEach((note, index) => {
                const noteDiv = createNoteDiv(note, index);
                notesList.appendChild(noteDiv);
            });
        }

        function loadArchive() {
            const archiveList = document.getElementById('archiveList');
            archiveList.innerHTML = '';
            const archive = JSON.parse(localStorage.getItem('archive')) || [];
            archive.forEach((note, index) => {
                const noteDiv = document.createElement('div');
                noteDiv.className = 'note mb-4 p-4 border rounded bg-lightblue-200';
                noteDiv.innerHTML = `
                    <h3 class="font-bold">${note.title || 'Untitled'}</h3>
                    <p>${note.description}</p>
                    <p>${note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content}</p>
                    <button class="bg-blue-400 text-white rounded px-4 py-2" onclick="unarchiveNote(${index})"><i class="bi bi-archive-fill"></i></button>
                `;
                archiveList.appendChild(noteDiv);
            });
        }

        function loadTrashbin() {
            const trashbinList = document.getElementById('trashbinList');
            trashbinList.innerHTML = '';
            const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];
            trashbin.forEach((note, index) => {
                const noteDiv = document.createElement('div');
                noteDiv.className = 'note mb-4 p-4 border rounded bg-lightblue-200';
                noteDiv.innerHTML = `
                    <h3 class="font-bold">${note.title || 'Untitled'}</h3>
                    <p>${note.description}</p>
                    <p>${note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content}</p>
                    <button class="bg-blue-500 text-white rounded px-4 py-2" onclick="recoverNote(${index})"><i class="bi bi-arrow-clockwise"></i></button>
                    <button class="bg-blue-400 text-white rounded px-4 py-2" onclick="permanentlyDelete(${index})"><i class="bi bi-trash3-fill"></i></button>
                `;
                trashbinList.appendChild(noteDiv);
            });
        }

        function loadFavorites() {
            const favoritesList = document.getElementById('favoritesList');
            favoritesList.innerHTML = '';
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites.forEach((note, index) => {
                const noteDiv = document.createElement('div');
                noteDiv.className = 'note mb-4 p-4 border rounded bg-lightblue-200';
                noteDiv.innerHTML = `
                    <h3 class="font-bold">${note.title || 'Untitled'}</h3>
                    <p>${note.description}</p>
                    <p>${note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content}</p>
                    <button class="bg-blue-400 text-white rounded px-4 py-2" onclick="removeFromFavorites(${index})"><i class="bi bi-heart-half"></i></button>
                `;
                favoritesList.appendChild(noteDiv);
            });
        }
// bdgasbdjasd
        function createNoteDiv(note, index) {
            const noteDiv = document.createElement('div');
            noteDiv.className = 'note mb-4 p-4 border rounded bg-lightblue-200';
            noteDiv.innerHTML = `
                <h3 class="font-bold">${note.title || 'Untitled'}</h3>
                <p>${note.description}</p>
                <p>${note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content}</p>
                <button class="bg-blue-300 text-white rounded px-4 py-2" onclick="editNote(${index})"><i class="bi bi-pencil-square"></i></button>
                <button class="bg-blue-500 text-white rounded px-4 py-2" onclick="deleteNote(${index})"><i class="bi bi-trash"></i></button>
                <button class="bg-blue-500 text-white rounded px-4 py-2" onclick="archiveNote(${index})"><i class="bi bi-archive"></i></button>
                <button class="bg-blue-400 text-white rounded px-4 py-2" onclick="addToFavorites(${index})"><i class="bi bi-heart-fill"></i></button>
            `;
            return noteDiv;
        }

        const addToFavorites = (index) => {
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            const note = notes.splice(index, 1)[0];
            favorites.push(note);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            localStorage.setItem('notes', JSON.stringify(notes));
            loadNotes();
        };

        const archiveNote = (index) => {
            const archiveModal = document.getElementById('archiveModal');
            const confirmArchiveButton = document.getElementById('confirmArchive');
            const cancelArchiveButton = document.getElementById('cancelArchive');

            // Show the modal
            archiveModal.style.display = 'flex';

            // Handle archive confirmation
            confirmArchiveButton.onclick = () => {
                const notes = JSON.parse(localStorage.getItem('notes')) || [];
                const archive = JSON.parse(localStorage.getItem('archive')) || [];

                // Move the note from notes to archive
                const note = notes.splice(index, 1)[0];
                archive.push(note);

                // Update localStorage
                localStorage.setItem('archive', JSON.stringify(archive));
                localStorage.setItem('notes', JSON.stringify(notes));

                // Reload notes display
                loadNotes();

                // Hide the modal
                archiveModal.style.display = 'none';
            };

            // Handle archive cancellation
            cancelArchiveButton.onclick = () => {
                // Hide the modal
                archiveModal.style.display = 'none';
            };
        };


        // const archiveNote = (index) => {
        //     const notes = JSON.parse(localStorage.getItem('notes')) || [];
        //     const archive = JSON.parse(localStorage.getItem('archive')) || [];
        //     const note = notes.splice(index, 1)[0];
        //     archive.push(note);
        //     localStorage.setItem('archive', JSON.stringify(archive));
        //     localStorage.setItem('notes', JSON.stringify(notes));
        //     loadNotes();
        // };

        function editNote(index) {
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const note = notes[index];

            // Populate form fields with the note data
            document.getElementById('title').value = note.title;
            document.getElementById('description').value = note.description;
            document.getElementById('content').value = note.content;

            // Change the button text to "Update Note"
            const saveButton = document.getElementById('saveButton');
            saveButton.textContent = "Update Note";
            saveButton.dataset.index = index; // Set a data attribute to store the index of the note being edited

            showSection('createNoteSection'); // Show the note editing section
        }

        function saveNote() {
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const index = document.getElementById('saveButton').dataset.index;

            // Create a note object from the form inputs
            const note = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                content: document.getElementById('content').value
            };

            if (index !== undefined && index !== '') {
                // If editing, update the existing note at the specified index
                notes[index] = note;
            } else {
                // If creating, add the new note to the array
                notes.push(note);
            }

            // Update localStorage
            localStorage.setItem('notes', JSON.stringify(notes));

            // Reset form and button text
            document.getElementById('title').value = '';
            document.getElementById('description').value = '';
            document.getElementById('content').value = '';
            const saveButton = document.getElementById('saveButton');
            saveButton.textContent = "Create Note"; // Reset button text
            delete saveButton.dataset.index; // Remove the index attribute

            // Refresh the notes list display and go back to the notes list section
            loadNotes(); // Make sure this loads your updated notes list
            showSection('notesListSection'); // Navigate back to the notes list section
        }


        

        // function editNote(index) {
        //     const notes = JSON.parse(localStorage.getItem('notes')) || [];
        //     const note = notes[index];
        //     document.getElementById('title').value = note.title;
        //     document.getElementById('description').value = note.description;
        //     document.getElementById('content').value = note.content;

        //     notes.splice(index, 1);
        //     localStorage.setItem('notes', JSON.stringify(notes));
        //     showSection('createNoteSection');
        // };
        
        const deleteNote = (index) => {
            const confirmationModal = document.getElementById('confirmationModal');
            const confirmDeleteButton = document.getElementById('confirmDelete');
            const cancelDeleteButton = document.getElementById('cancelDelete');

            // Show the modal
            confirmationModal.style.display = 'flex';

            // Handle confirmation
            confirmDeleteButton.onclick = () => {
                const notes = JSON.parse(localStorage.getItem('notes')) || [];
                const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];

                // Remove the note from notes array and add to trashbin
                const note = notes.splice(index, 1)[0];
                trashbin.push(note);

                // Update localStorage with new data
                localStorage.setItem('trashbin', JSON.stringify(trashbin));
                localStorage.setItem('notes', JSON.stringify(notes));

                // Reload the notes display
                loadNotes();

                // Hide the modal
                confirmationModal.style.display = 'none';
            };

            // Handle cancellation
            cancelDeleteButton.onclick = () => {
                // Hide the modal
                confirmationModal.style.display = 'none';
            };
        };



        // const deleteNote = (index) => {
        //     const notes = JSON.parse(localStorage.getItem('notes')) || [];
        //     const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];
        //     const note = notes.splice(index, 1)[0];
        //     trashbin.push(note);
        //     localStorage.setItem('trashbin', JSON.stringify(trashbin));
        //     localStorage.setItem('notes', JSON.stringify(notes));
        //     loadNotes();

        // };
    

        const recoverNote = (index) => {
            const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const note = trashbin.splice(index, 1)[0];
            notes.push(note);
            localStorage.setItem('notes', JSON.stringify(notes));
            localStorage.setItem('trashbin', JSON.stringify(trashbin));
            loadTrashbin();
            loadNotes();
        };

        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.display = 'block';

            // Hide notification after 3 seconds
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        function permanentlyDelete(index) {
            const permanentDeleteModal = document.getElementById('permanentDeleteModal');
            const confirmPermanentDeleteButton = document.getElementById('confirmPermanentDelete');
            const cancelPermanentDeleteButton = document.getElementById('cancelPermanentDelete');

            // Show the modal
            permanentDeleteModal.style.display = 'flex';

            // Handle permanent delete confirmation
            confirmPermanentDeleteButton.onclick = () => {
                const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];

                // Remove the note from the trashbin array
                trashbin.splice(index, 1);

                // Update localStorage with the modified trashbin array
                localStorage.setItem('trashbin', JSON.stringify(trashbin));

                // Reload the trashbin display
                loadTrashbin();

                // Hide the modal
                permanentDeleteModal.style.display = 'none';

                // Show custom notification for successful deletion
                showNotification("Note has been permanently deleted.");
            };

            // Handle permanent delete cancellation
            cancelPermanentDeleteButton.onclick = () => {
                // Hide the modal
                permanentDeleteModal.style.display = 'none';

                // Show custom notification for canceled action
                showNotification("Permanent deletion canceled.");
            };
        }


        



        // const permanentlyDelete = (index) => {
        //     const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];
        //     trashbin.splice(index, 1);
        //     localStorage.setItem('trashbin', JSON.stringify(trashbin));
        //     loadTrashbin();
        // };

        const unarchiveNote = (index) => {
            const archive = JSON.parse(localStorage.getItem('archive')) || [];
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const note = archive.splice(index, 1)[0];
            notes.push(note);
            localStorage.setItem('notes', JSON.stringify(notes));
            localStorage.setItem('archive', JSON.stringify(archive));
            loadArchive();
            loadNotes();
        };

        const removeFromFavorites = (index) => {
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const note = favorites.splice(index, 1)[0];
            notes.push(note);
            localStorage.setItem('notes', JSON.stringify(notes));
            localStorage.setItem('favorites', JSON.stringify(favorites));
            loadFavorites();
            loadNotes();
        };

        document.getElementById('noteForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;
            const content = document.getElementById('content').value;

            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            notes.push({ title, description, content });
            localStorage.setItem('notes', JSON.stringify(notes));
            this.reset();
            showSection('notesListSection');
        });

        const searchNotes = () => {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const notesList = document.getElementById('notesList');
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            notesList.innerHTML = '';
            notes.forEach((note, index) => {
                if (note.title.toLowerCase().includes(input) || note.description.toLowerCase().includes(input)) {
                    const noteDiv = createNoteDiv(note, index);
                    notesList.appendChild(noteDiv);
                }
            });
        };
    </script>
  
</body>

</html> 