<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
</head>
<body class="antialiased">
    <h1>NOTES</h1>
    <form action="/create" method="GET">
        <button type="submit">Create Note</button>
    </form> <br>

    @foreach ($notes as $note)
        <div><b>Title:</b> {{ $note->title}}</div>
        <div><b>Description:</b> {{ $note->description}}</div>
        <div><b>Body:</b> {{ $note->body}}</div> <br>

        <form action="{{ route('showNotes', ['id' => $note->id])}}" method="GET"> 
            <button type="submit">Show Notes</button>
        </form>
        <hr>

    @endforeach


    
</body>
</html>