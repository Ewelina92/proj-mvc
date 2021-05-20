<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTasks(Request $request)
    {
        if (!$request->session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        $user = $request->session()->get('user');

        return view('tasks', [
            'titlePart' => '| All tasks',
            'tasks' => Task::all()->filter()
                ->where('user_id', $user->id)
                ->where('finished_at', null)
                ->sortByDesc('updated_at'),
            'user' => session()->get('user')
        ]);
    }

    public function showOneTask(Task $task)
    {
        if (!session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }

        return view('task', [
            'titlePart' => '| Current task',
            'task' => $task,
            'user' => session()->get('user')
        ]);
    }

    public function showFinishedTasks(Request $request)
    {
        if (!$request->session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        $user = $request->session()->get('user');

        return view('finished-tasks', [
            'titlePart' => '| Finished tasks',
            'tasks' => Task::all()->filter()
                ->where('user_id', $user->id)
                ->where('finished_at', '<>', null)->sortByDesc('finished_at'),
            'user' => session()->get('user')
        ]);
    }

    public function addTask(Request $request)
    {
        if (!$request->session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        $user = $request->session()->get('user');

        /** @phpstan-ignore-next-line */
        Task::create([
            'title' => $request->input("title"),
            'body' => $request->input("body"),
            'user_id' => $user->id
        ]);

        return redirect('/tasks');
    }

    public function addTaskForm(Request $request)
    {
        if (!$request->session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        $user = $request->session()->get('user');

        return view('new-task', [
            'titlePart' => '| Add a task',
            'user' => session()->get('user')
        ]);
    }

    public function updateTaskForm(Task $task, Request $request)
    {
        if (!session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }

        return view('update-task', [
            'titlePart' => '| Update a task',
            'user' => session()->get('user'),
            'task' => $task,
        ]);
    }

    public function updateTask(Task $task, Request $request)
    {
        if (!session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }

        $task->updateTask(
            $request->input('title'),
            $request->input('body')
        );

        return redirect('/tasks');
    }

    public function taskDone(Task $task)
    {
        if (!session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }

        $task->done();

        return redirect("/finished-tasks");
    }

    public function deleteTask(Task $task)
    {
        if (!session()->has('user')) {
            abort(403, 'You are not logged in.');
        }

        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }

        $task->delete();

        return redirect("/tasks");
    }
}
