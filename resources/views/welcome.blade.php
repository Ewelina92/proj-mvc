<x-layout :user="$user" :titlePart='$titlePart'>

    
    <x-slot name="content">

        Welcome {{ $user->username ?? '' }} to the ToDo application.

        @if (!$user)
        <form method=POST action="{{url('/login') }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
            <p>Log in</p>
            <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="email@example.com" required>
            <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="password" required>
                <br><br>
                <input type="submit" value="Log in">
        </fieldset>
        </form>

            <a href="{{url('/register') }}">Register</a>
        @else
            <a href="{{url('/logout') }}">Logout</a>
        @endif

    </x-slot>
</x-layout>