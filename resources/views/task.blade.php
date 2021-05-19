<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 
    
    <x-slot name="content">

        <article class="one-task">
            <div class="task-info">
                <h1>{{ $task->title ?? '' }}</h1>
                <p>{{ $task->body ?? '' }}</p>
            </div>
            <div class="task-choices">
                <a href=#>Update</a> |
                <a href=#>Mark as done</a> |
                <a href=#>Delete</a> |
                <a href="{{url('/tasks') }}">Go Back</a>
            </div>
        </article>

    </x-slot>
</x-layout>