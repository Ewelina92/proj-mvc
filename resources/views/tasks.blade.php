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
                    Created at: {{ $task->created_at ?? '' }}
                </div>
            </article>
        @endforeach

    </x-slot>
</x-layout>