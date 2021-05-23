<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Function checking if a user is currently logged in.
     *
     * @return void
     */
    private function checkIfLoggedIn()
    {
        if (!session()->has('user')) {
            abort(403, 'You are not logged in.');
        }
    }

    /**
     * Function checking if a task belongs to logged in user.
     *
     * @var Task
     * @return void
     */
    private function checkIfTaskBelongsToUSer(Task $task)
    {
        if ($task->user_id != session()->get('user')->id) {
            abort(403, 'You are not authorized to see this task.');
        }
    }

    /**
     * Function to show all tasks belonging to the user.
     *
     * @var Request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    /**
     * Function to showing one tasks belonging to the user.
     *
     * @var Task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showOneTask(Task $task)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer($task);

        return view('task', [
            'titlePart' => '| Current task',
            'task' => $task,
            'user' => session()->get('user')
        ]);
    }
/**
     * Function to show all finsihed tasks belonging to the user.
     *
     * @var Request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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
     * Function adding a new task.
     *
     * @var Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

    /**
     * Function to allow logged in users to add a new task.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addTaskForm()
    {
        $this->checkIfLoggedIn();

        return view('new-task', [
            'titlePart' => '| Add a task',
            'user' => session()->get('user')
        ]);
    }

    /**
     * Function to allow logged in users to access the update a task form.
     *
     * @var Task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateTaskForm(Task $task)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer($task);

        return view('update-task', [
            'titlePart' => '| Update a task',
            'user' => session()->get('user'),
            'task' => $task,
        ]);
    }

     /**
     * Function to allow logged in users to update a task.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateTask(Task $task, Request $request)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer($task);

        $task->updateTask(
            $request->input('title'),
            $request->input('body')
        );

        return redirect('/tasks');
    }

     /**
     * Function to allow logged in users to mark a task as finished.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function taskDone(Task $task)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer($task);

        $task->done();

        return redirect("/finished-tasks");
    }

     /**
     * Function to allow logged in users to delete a task.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteTask(Task $task)
    {
        $this->checkIfLoggedIn();

        $this->checkIfTaskBelongsToUSer($task);

        $task->delete();

        return redirect("/tasks");
    }
}
