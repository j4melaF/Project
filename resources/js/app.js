// const mix = require('laravel-mix');

// mix.js('resources/js/app.js', 'public/js')
//    .postCss('resources/css/app.css', 'public/css', [
//        require('tailwindcss'),
//    ]);

//    const sidebarWidth = 300;

//     const Openbar = () => {
//         const sidebar = document.getElementById("sidebar");
//         const mainContent = document.getElementById("mainContent");
//         sidebar.classList.toggle("left-0");
//         sidebar.classList.toggle("left-[-300px]");

//         if (sidebar.classList.contains("left-0")) {
//             mainContent.style.marginLeft = `${sidebarWidth}px`;
//         } else {
//             mainContent.style.marginLeft = `0px`;
//         }
//     };

//     const showSection = (sectionId) => {
//         const sections = document.querySelectorAll(".main-content > div");
//         sections.forEach(section => section.classList.add("hidden"));
//         document.getElementById(sectionId).classList.remove("hidden");
//         if (sectionId === 'trashbinSection') loadTrashbin();
//         if (sectionId === 'archiveSection') loadArchive();
//         if (sectionId === 'favoritesSection') loadFavorites();
//         if (sectionId === 'notesListSection') loadNotes();
//     };

//     function loadNotes() {
//         const notesList = document.getElementById('notesList');
//         notesList.innerHTML = '';
//         const notes = JSON.parse(localStorage.getItem('notes')) || [];
//         notes.forEach((note, index) => {
//             const noteDiv = createNoteDiv(note, index);
//             notesList.appendChild(noteDiv);
//         });
//     }

//     function createNoteDiv(note, index) {
//         const noteDiv = document.createElement('div');
//         noteDiv.className = 'note';
//         noteDiv.innerHTML = `
//             <h3>${note.title || 'Untitled'}</h3>
//             <p>${note.description}</p>
//             <p>${note.content.length > 100 ? note.content.substring(0, 100) + '...' : note.content}</p>
//             <button class="bg-yellow-500" onclick="editNote(${index})">Edit</button>
//             <button class="bg-red-500" onclick="deleteNote(${index})">Delete</button>
//             <button class="bg-blue-500" onclick="archiveNote(${index})">Archive</button>
//             <button class="bg-green-500" onclick="addToFavorites(${index})">Add to Favorites</button>
//         `;
//         return noteDiv;
//     }

// // Implement loadArchive, loadTrashbin, loadFavorites, addToFavorites, archiveNote, deleteNote, etc.
// // They should follow the same pattern as loadNotes and createNoteDiv.
