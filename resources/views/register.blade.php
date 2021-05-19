<x-layout :titlePart='$titlePart'>
    
    <x-slot name="content">

        <h1 class="center">Create new account</h1>
        <p>After you've created your account, you will be automatically
        logged in. All fields must be filled out, and only one account can be
        made per email address.</p>

        <form method=POST action="{{url('/register') }}">
        @csrf <!-- prevent 419 page expired -->
        <fieldset>
        <div class=form-input>
            <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="username" required>
            <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="email@example.com" required>
            <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="password" required>
                <br><br>
                <input class="form-button" type="submit" value="Register">
        </div>
        </fieldset>
        </form>

    </x-slot>
</x-layout>