<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'titlePart' => '| Home'
        ]); 
    }

    public function showTasks()
    {
        return view('tasks', [
            'titlePart' => '| All tasks',
            'tasks' => Task::all()->filter()->where('user_id', 2)->sortByDesc('created_at')
        ]);
    }

    public function showOneTask(Task $task)
    {
        return view('task', [
            'titlePart' => '| Current task',
            'task' => $task
        ]);
    }

    public function showFinishedTasks()
    {
        return view('finished-tasks', [
            'titlePart' => '| Finished tasks',
            'tasks' => Task::all()->filter()->where('finished_at', '<>', null)->sortByDesc('created_at')
        ]);
    }
}
