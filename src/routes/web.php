<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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

Route::post('/dashboard/{id}', [UserController::class, 'deleteUser'])->name('delete_user');

Route::get('/products', [PageController::class, 'products'])->name('products');

Route::get('/product/{id}', [PageController::class, 'product'])->name('product');

Route::get('/category/{id}', [PageController::class, 'category'])->name('category');

Route::get('/categories', [PageController::class, 'categories']);

Route::post('/download-csv/{entityName}', [PageController::class, 'downloadCsv'])->name('download_csv');

Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit_product');
Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit_category');

Route::post('/edit-product/{id}', [ProductController::class, 'update']);
Route::post('/edit-category/{id}', [CategoryController::class, 'update']);

Route::post('/products/{id}', [ProductController::class, 'destroy'])->name('delete_product');
Route::post('/categories/{id}', [CategoryController::class, 'destroy'])->name('delete_category');