<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::view('/', 'index');
Route::get('/', [UserController::class, 'test']);

Route::view('/about', 'about');
Route::view('/login','login');
Route::post('/login', [UserController::class, 'addUser']);


