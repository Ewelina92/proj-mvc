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
            <p><a href="{{ url('/welcome') }}">Homepage</a></p>
            <p><a href="{{url('/tasks') }}">Tasks</a></p>
        </header>
        <main>
            {{ $content }}
        </main>
        <footer>
            <p>&copy; Ewelina Jankowska, endproject for MVC spring 2021.</p>
        </footer>
    </body>
</html>

