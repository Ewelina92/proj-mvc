<x-layout :user="$user" :titlePart='$titlePart'>

    
    <x-slot name="content">
        @if (!$user)
        <h1 class="center">Welcome to this ToDo application!</h1>
        <p>You can get started by logging in below by using one of the emails
        WRITE@WRITE or WRITE@WRTIE with the password "test". Each user has a couple of
        pending tasks for you to try and update, mark as finished (or delete )to try out
        the functionality of the page. You can also add new tasks.<br><br>
        If you prefer to start at with an empty account, you can register 
        <a href="{{url('/register') }}">>> here <<</a> (or through the navigation menu) instead.</p>

        <form method=POST action="{{url('/login') }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
            <div class=form-input>
                <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="email@example.com" required>
                <label for="password">Password: </label>
                    <input type="password" name="password" id="password" placeholder="password" required>
                <br><br>
                <input class="form-button" type="submit" value="Log in">
            <div>
        </fieldset>
        </form>
        @endif

    </x-slot>
</x-layout>