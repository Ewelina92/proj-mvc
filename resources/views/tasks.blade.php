<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 

    <x-slot name="content">
    
        <h1>All tasks</h1>
        @foreach ($tasks as $task)
            <article>
                <h2>
                    <a href="task/{{ $task->id }}">
                        {{ $task->title ?? '' }}
                    </a>
                </h2>
                <div>
                    <p>Created at: {{ $task->created_at ?? '' }}</p>
                </div>
            </article>
        @endforeach

    </x-slot>
</x-layout>