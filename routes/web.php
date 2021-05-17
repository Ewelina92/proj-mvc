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
    return view('welcome');
});

Route::get('/tasks', function () {
    return view('tasks', [
        'tasks' => Task::all()
    ]);
});

Route::get('/task/{task}', function ($slug) {
    return view('task', [
        'task' => Task::find($slug)
    ]);
})->where('task', '[A-z0-9_\-]+');

