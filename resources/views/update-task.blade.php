<x-layout :user="$user" :titlePart='$titlePart'>
    
    <x-slot name="content">

        <h1 class="center">Update task</h1>

        <form method=POST action="{{url("/task/$task->id/update") }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
        <div class=form-input>
            <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $task->title ?? ''}}" placeholder="Title" required>
            <label for="body">Description</label>
                <textarea name="body" id="body" placeholder="A description of your to-do task" required>{{ $task->body ?? '' }}</textarea>
                <br><br>
                <input class="form-button" type="submit" value="Save update">
                <a class="center" href="{{ url("/task/$task->id") }}">Go back</a>
        </div>
        </fieldset>
        </form>

    </x-slot>
</x-layout>