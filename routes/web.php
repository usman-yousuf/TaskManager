<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskManagementController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login.user');
Route::get('/register-view', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/index', [TaskManagementController::class, 'taskList'])->name('task.list');
Route::get('/create-task-view', [TaskManagementController::class, 'createTaskView'])->name('create.task.view');
Route::post('/store-task', [TaskManagementController::class, 'store'])->name('store.task');

Route::get('/edit-task-view/{task}', [TaskManagementController::class, 'editTaskView'])->name('edit.task.view');
Route::post('/update-task/{task}', [TaskManagementController::class, 'updateTask'])->name('update.task');

Route::get('/show-task/{task}', [TaskManagementController::class, 'showTask'])->name('show.task');
Route::post('/delete-task/{task}', [TaskManagementController::class, 'deleteTask'])->name('delete.task');

Route::get('/bin-task', [TaskManagementController::class, 'binTask'])->name('bin.task');
Route::post('/resotre-task/{task}', [TaskManagementController::class, 'restoreTask'])->name('resotre.task');


Route::post('destroy-task/{task}', [TaskManagementController::class, 'destroy'])->name('destroy.task');


