<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Edit Note</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
   
</head>
<body>
    <h1>Edit Notes</h1>
   
    
                <form action="{{ route('updateNote', ['id'=>$note->id])}}" method="POST">
                    @csrf

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="{{ $note->title}}"> <br>

                    <label for="descrition">Description:</label>
                    <input type="text" id="description" name="description" value="{{ $note->description}}"><br>

                    <label for="body">Content:</label>
                    <textarea type="text" id="body" name="body" rows="10" required>{{ $note->body}}</textarea><br>

                    <button type="Submit">Update Note</button>

                </form> <br>
                
                <form action="{{ route('notes')}}" method="GET">
                    <button type="submit">Back to Notes</button>
                </form>

</body>
</html>