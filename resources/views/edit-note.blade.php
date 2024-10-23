<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
</head>
<body>
    <h1>Edit Notes</h1>
    
    <form action="{{ route('updateNote', ['id'=>$note->id])}}" method="POST">
        @csrf

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $note->title}}"> <br>

        <label for="descrition">Description:</label>
        <input type="text" id="description" name="description" value="{{ $note->description}}"><br>

        <label for="body">Body:</label>
        <textarea type="text" id="body" name="body" rows="10" required>{{ $note->body}}</textarea><br>

        <button type="Submit">Update Note</button>

    </form> <br>
    
    <form action="{{ route('notes')}}" method="GET">
        <button type="submit">Back to Notes</button>
    </form>
    
</body>
</html>