<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 

    <x-slot name="content">
    
        <h1>All tasks</h1>
        @foreach ($tasks as $task)
            <article>
                <h2>
                    <a href="task/{{ $task->slug }}">
                        {{ $task->title ?? '' }}
                    </a>
                </h2>
                <div>
                    {{ $task->excerpt ?? '' }}
                </div>
            </article>
        @endforeach

    </x-slot>
</x-layout>