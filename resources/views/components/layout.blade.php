<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDo {{ $titlePart }}</title>

        <!-- Fonts & Styles -->
        <link rel="stylesheet" href="{{ asset('test.css') }}">
    </head>
    <body>
        <header>
        <h1>ToDo</h1>
        <nav>
            <a href="{{ url('/welcome') }}">Home</a>
            <a href="{{url('/tasks') }}">To Do List</a>
            <a href="{{url('/finished-tasks') }}">Finished Tasks</a>
        </nav>
        </header>
        <main>
            {{ $content }}
        </main>
        <footer>
            <p>&copy; Ewelina Jankowska, endproject for MVC spring 2021.</p>
        </footer>
    </body>
</html>

