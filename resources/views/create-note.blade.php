<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Create Note</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="app-container">
        <header>
            <h1>New Note</h1>
        </header>

        <div class="note-input">
        
            <form action="{{ route('createNoteSubmit') }}" method="POST">
                @csrf
                <label for="title">Title:</label>
                <input type="text" id="title" name="title"><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description"><br>

                <label for="body"></label>
                <textarea id="body" name="body" cols="30" rows="10" placeholder="Write your note here..."></textarea>

                <button type="submit">Add Note</button>
            </form> <br>

            <form action="{{ route('notes')}}" method="GET">
                <button type="submit">Back to Notes</button>
            </form>
            
            <!-- <button id="add-note-btn">Add Note</button> -->
        </div>
    
</body>
</html>