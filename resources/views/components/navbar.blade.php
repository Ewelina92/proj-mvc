<nav>
    <a href="{{ url('/welcome') }}">Home</a>
@if ($user)
    <a href="{{url('/tasks') }}">To Do List</a>
    <a href="{{url('/finished-tasks') }}">Finished Tasks</a>
@endif
</nav>