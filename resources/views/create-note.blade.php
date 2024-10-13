<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Note</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="app-container">
        <header>
            <h1>Note App</h1>
        </header>

        <div class="note-input">
            <textarea id="note-text" placeholder="Write your note here..."></textarea>
            <button id="add-note-btn">Add Note</button>
        </div>

        <div class="notes-section">
            <h2>Your Notes</h2>
            <div id="notes-list"></div>
        </div>
    </div>

    <script src="app.js"></script>
    
</body>
</html>