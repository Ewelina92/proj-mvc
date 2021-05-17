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
            <?php foreach ($tasks as $task) : ?>
                <article>
                    <?= $task; ?>
                </article>
            <?php endforeach; ?>
            {{-- <article>
                <h1><a href="task/first-task">My first task</a></h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </article> --}}

            {{-- <article>
                <h1><a href="task/second-task">My second task</a></h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </article>

            <article>
                <h1><a href="task/third-task">My third task</a></h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </article> --}}
            <!--{{ $content ?? '' }}-->
        </main>
        <footer>
            <p>&copy; Ewelina Jankowska, endproject for MVC spring 2021.</p>
        </footer>
    </body>
</html>