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
            <div class="min-h-screen flex justify-center items-center bg-gray-100 p-4">
            
                <div class="bg-blue-100 w-full max-w-lg p-6 rounded-lg shadow-lg flex flex-col">
        
            <form action="{{ route('createNoteSubmit') }}" method="POST">
                @csrf
                <label for="title">Title:</label>
                <input class="text-black" type="text" id="title" name="title" nullable ><br>

                <label for="description">Description:</label>
                <input class="text-black" type="text" id="description" name="description"nullable><br>

                <label for="body">Content:</label>
                <textarea class="text-black" id="body" name="body" cols="30" rows="10" placeholder="Write your note here..." required></textarea>

                <button class="bg-blue-400 p-2 rounded-full shadow-md text-white hover:bg-blue-500" type="submit">Add Note</button>
            </form> <br>

            <form action="{{ route('notes')}}" method="GET">
                <button class="bg-blue-400 p-2 rounded-full shadow-md text-white hover:bg-blue-500" type="submit">Back to Notes</button>
            </form>
            
        </div>
    
</body>
</html>