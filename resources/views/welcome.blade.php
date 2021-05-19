<x-layout>
    <x-slot name="titlePart"> 

        {{ $titlePart ?? '' }}
        
    </x-slot> 
    
    <x-slot name="content">

        Welcome to the ToDo application.
        To get started log in by using one of the following two:

        <form method="GET" action="#">
            <label for="email">Log in using your email</label>
            <input type="email" name="email" placeholder="email@example.com">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="Log in">
        </form>
        
        <button style="background-color: salmon;">Register NOT AVAILABLE</button>

    </x-slot>
</x-layout>