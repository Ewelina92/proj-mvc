<x-layout :user="$user" :titlePart='$titlePart'>
    
    <x-slot name="content">

        <h1 class="center">Add a new task</h1>

        <form method=POST action="{{url('/add-task') }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
        <div class=form-input>
            <label for="title">Title:</label>
                <input type="text" name="title" id="title" placeholder="Title" required>
            <label for="body">Description:</label>
                <textarea name="body" id="body" placeholder="A description of your to-do task" required></textarea>
                <br><br>
                <input class="form-button" type="submit" value="Add task">
                <a class="center" href="{{ url("/tasks") }}">Go back</a>
        </div>
        </fieldset>
        </form>

    </x-slot>
</x-layout>