<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::view('/', 'index');
Route::view('/about', 'about');

Route::get('/login', [PageController::class, 'login']);

