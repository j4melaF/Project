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

    <form action="{{ route('notes') }}" method="GET">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search notes...">
            <button type="submit">Search</button>
        </form>

        @if($notes->isEmpty())
            <p>No notes found.</p>
        @else
        <ul>
            @foreach($notes as $note)
                <li>{{ $note->title }}</li>
            @endforeach
        </ul>
        @endif


    @foreach ($notes as $note)
        <div><b>Title:</b> {{ $note->title}}</div>
        <div><b>Description:</b> {{ $note->description}}</div>
        <div><b>Content:</b> {{ $note->body}}</div> <br>

        <form action="{{ route('showNotes', ['id' => $note->id])}}" method="GET"> 
            <button type="submit">Show Notes</button>
        </form>
        <hr>
    @endforeach
</body>
</html>