<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Notes</title>
</head>
<body>
    <h1>NOTE</h1>

    <div><b>Title:</b> {{ $note->title}}</div>
    <div><b>Description:</b> {{ $note->description}}</div>
    <div><b>Body:</b> {{ $note->body}}</div> <br>

    <form action="{{ route('editNote', ['id' => $note->id])}}" method="GET">
            <button type="submit">Edit Note</button>
    </form> <br>

    <form action="{{ route('deleteNote', ['id' => $note->id])}}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this note?');">
        @csrf
        <button type="submit">Delete Note</button>
    </form> <br>


    <form action="{{ route('notes') }}" method="GET">
        <button type="submit">Back to Notes</button>
    </form>
    
</body>
</html>