<?php

use App\Models\Task;
use App\Http\Controllers\{
    TaskController,
    UserController
};
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

// needed to work locally + student-server
Route::get('/', function () {
    return redirect('/welcome');
});

Route::get('/welcome', [UserController::class, 'index']);

// login, logout, register
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);

// show task collections
Route::get('/tasks', [TaskController::class, 'showTasks']);
Route::get('/finished-tasks', [TaskController::class, 'showFinishedTasks']);

// show single task
Route::get('/task/{task}', [TaskController::class, 'showOneTask']);

// finish, update, delete a single task
Route::get('/task/{task}/done', [TaskController::class, 'taskDone']);
Route::get('/task/{task}/delete', [TaskController::class, 'deleteTask']);
Route::get('/task/{task}/update', [TaskController::class, 'updateTaskForm']);
Route::post('/task/{task}/update', [TaskController::class, 'updateTask']);

// add a new task
Route::get('/add-task', [TaskController::class, 'addTaskForm']);
Route::post('/add-task', [TaskController::class, 'addTask']);
