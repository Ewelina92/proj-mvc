<x-layout :user="$user" :titlePart='$titlePart'>

    <x-slot name="content">
    
        <h1>Finished tasks</h1>
        @if ($tasks->count())
        <article class="finished">
        @foreach ($tasks as $task)
            <ul class="finished-task">
                <li>
                    <h3>{{ $task->title ?? '' }}</h3>
                        <ul>
                        <li class="small-info">Finished {{ $task->updated_at->diffForHumans() ?? '' }} (Created {{ $task->created_at->toFormattedDateString() ?? '' }})
                        </li>
                        </ul>
                </li>
            </ul>
        @endforeach
         </article>
        @else
            <p>You haven't finished any tasks yet.</p>
        @endif

    </x-slot>
</x-layout>