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
                <div onclick="showSection('notesListSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-journal"></i>
                    <span class="text-[15px] ml-4">My Notes</span>
                </div>
                <div onclick="showSection('favoritesSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-bookmark-fill"></i>
                    <span class="text-[15px] ml-4">Favorites</span>
                </div>
                <div onclick="showSection('trashbinSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-trash-fill"></i>
                    <span class="text-[15px] ml-4">Trash Bin</span>
                </div>
                <div onclick="showSection('archiveSection')" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-archive"></i>
                    <span class="text-[15px] ml-4">Archive</span>
                </div>
                <div onclick="showSection('createNoteSection')" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span class="text-[15px] ml-4">Create Note</span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content transition-all duration-300 flex-1 ml-[0px] lg:ml-[300px]">
        <header class="flex-col justify-center">
            <h1 class="text-2xl font-bold text-blue-300 p-4">My Notes</h1>
            <div class="-mt-5">
                <h3 class="text-sm italic text-blue-300">keep note everything</h3>
            </div>
        </header>

        <div id="notesListSection" class="note-list p-4">
            <div id="notesList"></div>
        </div>

        <div id="createNoteSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300 text-center">Create Note</h2>
            <form id="noteForm" class="flex flex-col items-center">
                <label for="title" class="text-blue-300 font-bold">Title:</label>
                <input type="text" id="title" name="title" class="border rounded p-2 mb-4 w-full max-w-md">
                <label for="description" class="text-blue-300 font-bold">Description:</label>
                <input type="text" id="description" name="description" class="border rounded p-2 mb-4 w-full max-w-md">
                <label for="content" class="text-blue-300 font-bold">Content:</label>
                <textarea id="content" name="content" class="border rounded p-2 mb-4 w-full max-w-md" required></textarea>
                <button type="submit" class="bg-blue-400 text-white rounded p-2">Create Note</button>
                <br>
                <button type="button" class="bg-blue-400 text-white rounded p-2 ml-2" onclick="showSection('notesListSection')">Cancel</button>
            </form>
        </div>

        <div id="archiveSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300">Archive</h2>
            <div id="archiveList"></div>
        </div>

        <div id="trashbinSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300">Trash Bin</h2>
            <div id="trashbinList"></div>
        </div>

        <div id="favoritesSection" class="hidden p-4">
            <h2 class="text-2xl font-bold mb-4 text-blue-300">Favorites</h2>
            <div id="favoritesList"></div>
        </div>
    </div>

    <script>
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
                    <button class="bg-yellow-500 text-white rounded px-4 py-2" onclick="unarchiveNote(${index})">Unarchive</button>
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
                    <button class="bg-yellow-500 text-white rounded px-4 py-2" onclick="recoverNote(${index})">Recover</button>
                    <button class="bg-red-500 text-white rounded px-4 py-2" onclick="permanentlyDelete(${index})">Delete Forever</button>
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
                    <button class="bg-red-500 text-white rounded px-4 py-2" onclick="removeFromFavorites(${index})">Remove from Favorites</button>
                `;
                favoritesList.appendChild(noteDiv);
            });
        }

        function createNoteDiv(note, index) {
            const noteDiv = document.createElement('div');
            noteDiv.className = 'note mb-4 p-4 border rounded bg-lightblue-200';
            noteDiv.innerHTML = `
                <h3 class="font-bold">${note.title || 'Untitled'}</h3>
                <p>${note.description}</p>
                <p>${note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content}</p>
                <button class="bg-yellow-500 text-white rounded px-4 py-2" onclick="editNote(${index})">Edit</button>
                <button class="bg-red-500 text-white rounded px-4 py-2" onclick="deleteNote(${index})">Delete</button>
                <button class="bg-blue-500 text-white rounded px-4 py-2" onclick="archiveNote(${index})">Archive</button>
                <button class="bg-green-500 text-white rounded px-4 py-2" onclick="addToFavorites(${index})">Add to Favorites</button>
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
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const archive = JSON.parse(localStorage.getItem('archive')) || [];
            const note = notes.splice(index, 1)[0];
            archive.push(note);
            localStorage.setItem('archive', JSON.stringify(archive));
            localStorage.setItem('notes', JSON.stringify(notes));
            loadNotes();
        };

        const deleteNote = (index) => {
            const notes = JSON.parse(localStorage.getItem('notes')) || [];
            const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];
            const note = notes.splice(index, 1)[0];
            trashbin.push(note);
            localStorage.setItem('trashbin', JSON.stringify(trashbin));
            localStorage.setItem('notes', JSON.stringify(notes));
            loadNotes();
        };

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

        const permanentlyDelete = (index) => {
            const trashbin = JSON.parse(localStorage.getItem('trashbin')) || [];
            trashbin.splice(index, 1);
            localStorage.setItem('trashbin', JSON.stringify(trashbin));
            loadTrashbin();
        };

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