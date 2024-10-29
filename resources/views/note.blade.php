<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Show Notes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
   
</head>
<body>
    <h1>NOTE</h1>

    <div class="p-4 bg-blue-200 min-h-screen flex-center items-center">

        <div class="bg-blue-300 p-4 rounded-md shadow-md w-100">
        
            <div class="bg-blue-100 p-4 rounded-md shadow-sm">    

                <div><b>Title:</b> {{ $note->title}}</div>
                <div><b>Description:</b> {{ $note->description}}</div>
                <div><b>Content:</b> {{ $note->body}}</div> <br>

                <form action="{{ route('editNote', ['id' => $note->id])}}" method="GET">
                        <button class="bg-blue-400 p-2 rounded-full shadow-md text-white hover:bg-blue-500" type="submit">Edit Note</button>
                </form> <br>

                <form action="{{ route('deleteNote', ['id' => $note->id])}}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this note?');">
                    @csrf
                    <button class="bg-blue-400 p-2 rounded-full shadow-md text-white hover:bg-blue-500" type="submit">Delete Note</button>
                </form> <br>


                <form action="{{ route('notes') }}" method="GET">
                    <button class="bg-blue-400 p-2 rounded-full shadow-md text-white hover:bg-blue-500" type="submit">Back to Notes</button>
                </form>
    
</body>
</html>