<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 
    
    <x-slot name="content">

        <article>
            <h1>{{ $task->title ?? '' }}</h1>
            <div>
                {!! $task->body ?? '' !!}
            </div>
        </article>

        <a href="{{url('/tasks') }}">Go Back</a>

    </x-slot>
</x-layout>