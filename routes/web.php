<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { // needed to work locally + student-server
    return redirect('/welcome');
});

Route::get('/welcome', function () {
    return view('welcome', [
        'titlePart' => '| Home'
    ]);
});

Route::get('/tasks', function () {
    return view('tasks', [
        'titlePart' => '| All tasks',
        'tasks' => Task::all()->sortByDesc('created_at')
    ]);
});

// id is the default to look for, it has to be the same name
//{task::uniquecolumnname} gives Task::where('uniquecolumnname', $task)->firstOrFail();
Route::get('/task/{task}', function (Task $task) { // instead of $id ROUTE MODEL BINDING
    return view('task', [
        'titlePart' => '| Current task',
        'task' => $task //Task::findOrFail($id)
    ]);
});

