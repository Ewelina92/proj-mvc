<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 

    <x-slot name="content">
    
        <h1>To Do List</h1>
        <button>New task</button>
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
                    <a href=#>Update</a>
                    <a href=#>Mark as done</a>
                    <a href=#>Delete</a>
                </div>
            </article>
        @endforeach
        @else
            <p>There are no tasks to do yet.</p>
        @endif

    </x-slot>
</x-layout>