<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDo application</title>

        <!-- Fonts & Styles -->
        <link rel="stylesheet" href="test.css">
        <!-- here you can add a JS script, explanation in laracastvideo "include css and JS"-->
    </head>
    <body>
        <header>
            <p><a href="welcome">Homepage</a></p>
            <p><a href="tasks">Tasks</a></p>
        </header>
        <main>
        This is the welcoming page to the todo application
            <!--{{ $content ?? '' }}-->
        </main>
        <footer>
            <p>&copy; Ewelina Jankowska, endproject for MVC spring 2021.</p>
        </footer>
    </body>
</html>