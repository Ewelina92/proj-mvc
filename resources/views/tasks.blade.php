<x-layout :user="$user" :titlePart='$titlePart'>


    <x-slot name="content">
    
        <h1>To Do List</h1>
        <a href="{{url('/add-task') }}">Add a new task</a>
        @if ($tasks->count())
        @foreach ($tasks as $task)
            <article class="task-list">
                <div class="task-short">
                    <h2>
                        <a href="task/{{ $task->id }}">
                            {{ $task->title ?? '' }}
                        </a>
                    </h2>
                    <div>
                        <p>Created {{ $task->created_at->toFormattedDateString()?? '' }}</p>
                        <p>Updated {{ $task->updated_at->diffForHumans() ?? '' }}</p>
                    </div>
                </div>
                <div class="task-list-choices">
                    <a href="{{url("/task/$task->id/update") }}">Update</a>
                    <a href={{ url("/task/$task->id/done") }}>Mark as done</a>
                    <a href="{{ url("/task/$task->id/delete") }}">Delete</a>
                </div>
            </article>
        @endforeach
        @else
            <p>There are no tasks to do yet.</p>
        @endif

    </x-slot>
</x-layout>