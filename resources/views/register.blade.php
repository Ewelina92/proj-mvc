<x-layout :user="$user" :titlePart='$titlePart'>
    
    <x-slot name="content">

        <form method=POST action="{{url('/register') }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
            <p>Register for an account</p>
            <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="username" required>
            <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email@example.com" required>
            <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password" required>
                <br><br>
                <input type="submit" value="Register">
        </fieldset>
        </form>

    </x-slot>
</x-layout>