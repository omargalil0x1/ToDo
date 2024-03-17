<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\TaskController;

use App\Http\Controllers\ErrorHandler;

use App\Http\Controllers\RegisterController;


//this is needed for 'auth' in order to be redirected to it.
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');


Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');


Route::post('/login', [LoginController::class, 'login'])->name('login.login')->middleware('guest');


Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');


Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware('auth');


Route::post('/task/create', [TaskController::class, 'create'])->name('task.create')->middleware('auth');


Route::get('/task/finish/{task_id}', [TaskController::class, 'finish'])->name('task.finish')->middleware('auth');


Route::post('/task/delete/{task_id}', [TaskController::class, 'delete'])->name('task.delete')->middleware('auth');


Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
                                                                         
Route::post('/register', [RegisterController::class, 'register'])->name('register.register');


Route::fallback([ErrorHandler::class, 'handler']);
