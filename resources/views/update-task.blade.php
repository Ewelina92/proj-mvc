<x-layout :user="$user" :titlePart='$titlePart'>
    
    <x-slot name="content">

        <form method=POST action="{{url("/task/$task->id/update") }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
            <p>Update task</p>
            <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $task->title ?? ''}}" placeholder="Title" required>
            <label for="body">Description</label>
                <textarea name="body" id="body" placeholder="A description of your to-do task" required>{{ $task->body ?? '' }}</textarea>
                <br><br>
                <a href="{{ url("/task/$task->id") }}">Go back</a>
                <input type="submit" value="Save update">
        </fieldset>
        </form>

    </x-slot>
</x-layout>