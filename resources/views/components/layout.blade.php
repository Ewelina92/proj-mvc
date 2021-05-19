<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDo {{ $titlePart ?? '' }}</title>

        <!-- Fonts & Styles -->
        <link rel="stylesheet" href="{{ asset('test.css') }}">
    </head>
    <body>
        <header>
        <h1>ToDo Application</h1>

        <nav>
        @if ( $user ?? '' )
            <a href="{{url('/tasks') }}">To Do List</a>
            <a href="{{url('/finished-tasks') }}">Finished Tasks</a>
            <a href="{{url('/logout') }}">Logout</a>
        @else
            <a href="{{ url('/welcome') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        @endif
        </nav>

        </header>
        <main>
            {{ $content }}
        </main>
        <footer>
            <p>&copy; Ewelina Jankowska, ending project for MVC spring 2021.</p>
        </footer>
    </body>
</html>

