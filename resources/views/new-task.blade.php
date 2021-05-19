<x-layout :user="$user" :titlePart='$titlePart'>
    
    <x-slot name="content">

        <form method=POST action="{{url('/add-task') }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
            <p>Add a task to your To Do list</p>
            <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title" required>
            <label for="body">Description</label>
                <textarea name="body" id="body" placeholder="A description of your to-do task" required></textarea>
                <br><br>
                <input type="submit" value="Add task">
        </fieldset>
        </form>

    </x-slot>
</x-layout>