<x-layout :user="$user" :titlePart='$titlePart'>
    
    <x-slot name="content">

        <article class="one-task">
            <div class="task-info">
                <h1>{{ $task->title ?? '' }}</h1>
                <p>{{ $task->body ?? '' }}</p>
            </div>
            <div class="task-choices">
                <a href="{{url("/task/$task->id/update") }}">Update</a> |
                <a href="{{ url("/task/$task->id/done") }}">Mark as done</a> |
                <a href="{{ url("/task/$task->id/delete") }}">Delete</a> |
                <a href="{{url('/tasks') }}">Go Back</a>
            </div>
        </article>

    </x-slot>
</x-layout>