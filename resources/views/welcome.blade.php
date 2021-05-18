<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 
    
    <x-slot name="content">

        Welcome to the ToDo application.
        To get started log in by using one of the following two:

        <button>Log in</button>
        <button style="background-color: salmon;">Register NOT AVAILABLE</button>

    </x-slot>
</x-layout>