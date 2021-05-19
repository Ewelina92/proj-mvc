<?php

use App\Models\Task;
use App\Http\Controllers\TaskController;
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

// Route::get('/welcome', function () {
//     return view('welcome', [
//         'titlePart' => '| Home'
//     ]);
// });

Route::get('/welcome', [TaskController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'showTasks']);
Route::get('/task/{task}', [TaskController::class, 'showOneTask']);
Route::get('/finished-tasks', [TaskController::class, 'showFinishedTasks']);

// id is the default to look for, it has to be the same name
//{task::uniquecolumnname} gives Task::where('uniquecolumnname', $task)->firstOrFail();
// Route::get('/task/{task}', function (Task $task) { // instead of $id ROUTE MODEL BINDING
//     return view('task', [
//         'titlePart' => '| Current task',
//         'task' => $task //Task::findOrFail($id)
//     ]);
// });

// Route::get('/finished-tasks', function () {
//     return view('finished-tasks', [
//         'titlePart' => '| Finished tasks',
//         'tasks' => Task::all()->sortByDesc('created_at')
//     ]);
// });

