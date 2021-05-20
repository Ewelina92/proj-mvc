<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private function checkIfLoggedIn() {
        if (!$request->session()->has('user')) {
            abort(403, 'You are not logged in.');
        }
    }

    private function checkIfTaskBelongsToUSer() {
        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }
    }

    public function showTasks(Request $request)
    {
        $this->checkIfLoggedIn();

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
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer();

        return view('task', [
            'titlePart' => '| Current task',
            'task' => $task,
            'user' => session()->get('user')
        ]);
    }

    public function showFinishedTasks(Request $request)
    {
        $this->checkIfLoggedIn();

        $user = $request->session()->get('user');

        return view('finished-tasks', [
            'titlePart' => '| Finished tasks',
            'tasks' => Task::all()->filter()
                ->where('user_id', $user->id)
                ->where('finished_at', '<>', null)->sortByDesc('finished_at'),
            'user' => session()->get('user')
        ]);
    }

    /**
     * Add a new task.
     *
     * @var Request
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function addTask(Request $request)
    {
        $this->checkIfLoggedIn();

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
        $this->checkIfLoggedIn();

        return view('new-task', [
            'titlePart' => '| Add a task',
            'user' => session()->get('user')
        ]);
    }

    public function updateTaskForm(Task $task)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer();

        return view('update-task', [
            'titlePart' => '| Update a task',
            'user' => session()->get('user'),
            'task' => $task,
        ]);
    }

    public function updateTask(Task $task, Request $request)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer();

        $task->updateTask(
            $request->input('title'),
            $request->input('body')
        );

        return redirect('/tasks');
    }

    public function taskDone(Task $task)
    {
        $this->checkIfLoggedIn();

        // if ($task->user_id != session()->get('user')->id) {
        //     abort(403, 'You are not authorized to see this task.');
        // }
        $this->checkIfTaskBelongsToUSer();

        $task->done();

        return redirect("/finished-tasks");
    }

    public function deleteTask(Task $task)
    {
        $this->checkIfLoggedIn();

        // if ($task->user_id != session()->get('user')->id) {
        //     abort(403, 'You are not authorized to see this task.');
        // }
        $this->checkIfTaskBelongsToUSer();

        $task->delete();

        return redirect("/tasks");
    }
}
