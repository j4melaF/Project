<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Ede">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources.css.app">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    @vite('resources/css/app.css')
    <title>Notes</title>
</head>
<body class="antialiased">

    <div class="p-4 bg-blue-200 min-h-screen flex-center items-center">

        <div class="bg-blue-300 p-4 rounded-md shadow-md w-100">
        
            <div class="bg-blue-100 p-4 rounded-md shadow-sm">  
                <h2 class="text-xl font-bold mb-4">My Notes</h2>

                <form action="/create" method="GET">
                    <button type="submit">Create Note</button>
                </form> <br>

                <div class="container">
                    <div class="row m-2">
                        <form action="{{ route('notes')}}" class="col-9" method="GET">
                            <div class="form-group">
                                <input type="search" name="search" id="search" class="form-control" placeholder="Search note" value="{{$search}}">
                            </div>
                            <button class="btn btn-primary">Search</button>
                        </form>

                    </div>
                        
                @foreach ($notes as $note)
                                        
                <form action="{{ route('showNotes', ['id' => $note->id])}}"  method="GET"> 
                    <button type="submit">
                        <div><h3>Title: {{ $note->title}}</h3></div>
                        <div class="space-y-3">
                        <div><textarea>Description: {{ $note->description}}</textarea></div>
                        <div> {{ $note->body}}</div> <br>
                        
                    </button>
                
                </form>  

                @endforeach   
                <hr>     
                    



                </div>
                
            

                    <form action="/create" method="GET">
                        <button class="bg-blue-400 p-3 rounded-full shadow-md text-white hover:bg-blue-500" type="submit">
                            <i class="fas fa-plus"></i>
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                            </svg>

                        </button>
                    </form>

            

        

</body>
</html>