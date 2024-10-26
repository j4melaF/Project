<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>KeyNotes Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
</head>

<body class="bg-yellow-600 font-[Poppins]">
  <!-- Sidebar Toggle Button -->
  <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="Openbar()">
    <i class="bi bi-filter-left px-2 bg-yellow-900 rounded-md"></i>
  </span>

  <!-- Sidebar -->
  <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000 p-2 w-[300px] overflow-y-auto text-center bg-yellow-900 shadow h-screen">
    <div class="text-#fce700-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center rounded-md">
        <i class="bi bi-app-indicator px-2 py-1 bg-yellow-600 rounded-md"></i>
        <h1 class="text-[15px] ml-3 text-xl text-yellow-200 font-bold">KeyNotes</h1>
        <i class="bi bi-x ml-auto cursor-pointer lg:hidden" onclick="Openbar()"></i>
      </div>
      <hr class="my-2 text-yellow-600">

      <!-- Sidebar Options -->
      <div>
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-yellow-700">
          <i class="bi bi-search text-sm"></i>
          <input class="text-[15px] ml-4 w-full bg-yellow focus:outline-none" placeholder="Search" />
        </div>

        <div onclick="showSection('notesListSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-yellow-600">
          <i class="bi bi-journal"></i>
          <span class="text-[15px] ml-4 text-gray-200">My Notes</span>
        </div>
        <div onclick="showSection('favoritesSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-yellow-600">
          <i class="bi bi-bookmark-fill"></i>
          <span class="text-[15px] ml-4 text-gray-200">Favorites</span>
        </div>
        <div onclick="showSection('trashBinSection')" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-yellow-600">
          <i class="bi bi-trash-fill"></i>
          <span class="text-[15px] ml-4 text-gray-200">Trash Bin</span>
        </div>
        <div onclick="showSection('archiveSection')" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-yellow-600">
          <i class="bi bi-archive"></i>
          <span class="text-[15px] ml-4 text-gray-200">Archive</span>
        </div>
        <div onclick="showSection('createNoteSection')" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-yellow-600">
          <i class="bi bi-plus-circle-fill"></i>
          <span class="text-[15px] ml-4 text-gray-200">Create Note</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div id="mainContent" class="main-content p-6 ml-[-300px] transition-all duration-500">
  <h1 class="text-4xl font-bold mb-4">KeyNotes</h1>

    <!-- Notes List Section -->
    <div id="notesListSection">
      <div id="notesList" class="mb-4"></div>
    </div>

    <!-- Create Note Form Section -->
    <div id="createNoteSection" class="hidden">
      <h2 class="text-2xl font-bold mb-4 text-white">Create Note</h2>
      <form id="noteForm">
        <label for="title" class="text-white">Title:</label>
        <input type="text" id="title" name="title" class="border rounded p-2 mb-4 w-full">

        <label for="description" class="text-white">Description:</label>
        <input type="text" id="description" name="description" class="border rounded p-2 mb-4 w-full">

        <label for="content" class="text-white">Content:</label>
        <textarea id="content" name="content" class="border rounded p-2 mb-4 w-full" required></textarea>

        <button type="submit" id="submitNoteButton" class="bg-yellow-500 text-white rounded p-2">Create Note</button>
        <button id="updateNoteButton" type="button" class="bg-yellow-500 text-white rounded p-2 hidden">Update Note</button>
        <button id="cancelCreateNote" type="button" class="bg-yellow-500 text-white rounded p-2 ml-2">Cancel</button>
      </form>
    </div>

    <!-- Favorites Section -->
    <div id="favoritesSection" class="hidden">
      <h2 class="text-2xl font-bold mb-4 text-white">Favorites</h2>
      <div id="favoritesList" class="note-container"></div>
    </div>

    <!-- Archive Section -->
    <div id="archiveSection" class="hidden">
      <h2 class="text-2xl font-bold mb-4 text-white">Archive</h2>
      <div id="archiveList" class="note-container"></div>
    </div>

    <!-- Trash Bin Section -->
    <div id="trashBinSection" class="hidden">
      <h2 class="text-2xl font-bold mb-4 text-ffc107">Trash Bin</h2>
      <div id="trashBinList" class="note-container"></div>
    </div>
  </div>

  <script>
    let sidebarOpen = false; // Track sidebar state

    function Openbar() {
      sidebarOpen = !sidebarOpen;
      document.querySelector('.sidebar').classList.toggle('left-[-300px]');
    }

    function showSection(sectionId) {
      const sections = ['notesListSection', 'favoritesSection', 'createNoteSection', 'archiveSection', 'trashBinSection'];
      sections.forEach(id => {
        document.getElementById(id).classList.add('hidden');
      });
      document.getElementById(sectionId).classList.remove('hidden');
      // Close sidebar after selecting a section
      if (sidebarOpen) {
        Openbar();
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      loadNotes();

      document.getElementById('noteForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const title = document.getElementById('title').value || 'Untitled'; // Set default title
        const description = document.getElementById('description').value;
        const content = document.getElementById('content').value;

        const notes = JSON.parse(localStorage.getItem('notes')) || [];
        notes.push({ title, description, content });
        localStorage.setItem('notes', JSON.stringify(notes));
        loadNotes();
        showSection('notesListSection');
        document.getElementById('noteForm').reset();
      });

      document.getElementById('cancelCreateNote').addEventListener('click', function () {
        showSection('notesListSection');
      });
    });

    function loadNotes() {
      const notesList = document.getElementById('notesList');
      notesList.innerHTML = '';
      const notes = JSON.parse(localStorage.getItem('notes')) || [];
      notes.forEach((note, index) => {
        const noteDiv = document.createElement('div');
        noteDiv.className = 'note mb-4 p-4 border rounded bg-gray-100';

        // Handle "Read More" and "Read Less" functionality
        const contentPreview = note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content;
        const readMoreHtml = note.content.length > 100 ? 
          `<span class="content-preview">${contentPreview}</span>
           <a href="#" class="read-more text-blue-500">Read More</a>
           <span class="full-content hidden">${note.content}</span>
           <a href="#" class="read-less text-blue-500 hidden">Read Less</a>` : 
          `<span class="content-preview">${contentPreview}</span>`;

        noteDiv.innerHTML = `
          <h3 class="font-bold">${note.title}</h3>
          <p>${note.description}</p>
          <div>${readMoreHtml}</div>
          <button class="archive-btn bg-green-500 text-white rounded p-2 mt-2">Archive</button>
            <button class="button mt-2">
                <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
            </button>
        `;

        // Add event listeners for "Read More" and "Read Less"
        noteDiv.querySelector('.read-more')?.addEventListener('click', function (e) {
          e.preventDefault();
          noteDiv.querySelector('.content-preview').classList.add('hidden');
          noteDiv.querySelector('.full-content').classList.remove('hidden');
          noteDiv.querySelector('.read-more').classList.add('hidden');
          noteDiv.querySelector('.read-less').classList.remove('hidden');
        });

        noteDiv.querySelector('.read-less')?.addEventListener('click', function (e) {
          e.preventDefault();
          noteDiv.querySelector('.content-preview').classList.remove('hidden');
          noteDiv.querySelector('.full-content').classList.add('hidden');
          noteDiv.querySelector('.read-more').classList.remove('hidden');
          noteDiv.querySelector('.read-less').classList.add('hidden');
        });

        // Archive the note
        noteDiv.querySelector('.archive-btn').addEventListener('click', function () {
          const archive = JSON.parse(localStorage.getItem('archive')) || [];
          archive.push(note);
          localStorage.setItem('archive', JSON.stringify(archive));
          loadNotes();
        });

        // Delete the note
        noteDiv.querySelector('.delete-btn').addEventListener('click', function () {
          notes.splice(index, 1);
          localStorage.setItem('notes', JSON.stringify(notes));
          loadNotes();
        });

        notesList.appendChild(noteDiv);
      });
    }
  </script>
</body>
</html>
