<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminAuthorization;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::view('/about', 'about');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'loginUser']);

Route::get('/register', [PageController::class, 'register'])->name('register');

Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard')->middleware(AdminAuthorization::class);

Route::post('/register', [UserController::class, 'addUser']);

Route::post('/dashboard/{id}', [UserController::class, 'deleteUser'])->name('delete-user');

Route::get('/products', [PageController::class, 'products'])->name('products');
;
Route::get('/categories', [PageController::class, 'categories']);
;
