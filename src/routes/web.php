<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [PageController::class, 'index']);

Route::view('/about', 'about');

Route::view('/login', [PageController::class, 'login']);

Route::get('/register', [PageController::class, 'register']);

Route::get('/logout', [PageController::class, 'logout'])->name('logout');


Route::post('/register', [UserController::class, 'addUser']);