<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\AdminAuthorization;
use App\Http\Middleware\ShareAuthenticatedUser;
use App\Mail\leadAcquired;

Route::middleware(AdminAuthorization::class)->group(function () {
    Route::get('/leads', [LeadController::class, 'index'])->name('leads');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});

Route::get('/', [PageController::class, 'index'])->name('home');
Route::post('/save-lead', [LeadController::class, 'store'])->name('save_lead');
Route::post('/lead-delete/{id}', [LeadController::class, 'destroy'])->name('delete_lead');
Route::get('/lead/{id}', [LeadController::class, 'edit'])->name('edit_lead');
Route::post('/lead/{id}', [LeadController::class, 'update']);

Route::view('/about', 'about');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'loginUser']);

Route::get('/register', [PageController::class, 'register'])->name('register');

Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'addUser']);

Route::post('/dashboard/{id}', [UserController::class, 'destroy'])->name('delete_user');

Route::get('/products', [PageController::class, 'products'])->name('products');

Route::get('/product/{id}', [PageController::class, 'product'])->name('product');

Route::get('/category/{id}', [PageController::class, 'category'])->name('category');

Route::get('/categories', [PageController::class, 'categories'])->name('categories');

Route::post('/download-csv/{entityName}', [PageController::class, 'downloadCsv'])->name('download_csv');

Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit_product');
Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit_category');

Route::post('/edit-product/{id}', [ProductController::class, 'update']);
Route::post('/edit-category/{id}', [CategoryController::class, 'update']);

Route::post('/products/{id}', [ProductController::class, 'destroy'])->name('delete_product');
Route::post('/categories/{id}', [CategoryController::class, 'destroy'])->name('delete_category');

Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit_user');
Route::post('/edit-user/{id}', [UserController::class, 'update']);
Route::post('/permission-delete/{id}', [UserController::class, 'destroy'])->name('delete_permission');

Route::get('/edit-permission/{id}', [PermissionController::class, 'edit'])->name('edit_permission');
Route::post('/edit-permission/{id}', [PermissionController::class, 'update']);
Route::post('/permission-delete/{id}', [PermissionController::class, 'destroy'])->name('delete_permission');

Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit_role');
Route::post('/edit-role/{id}', [RoleController::class, 'update']);
Route::post('/role-delete/{id}', [RoleController::class, 'destroy'])->name('delete_role');

Route::post('/product/{id}', [ProductController::class, 'store'])->name('products_store');

Route::get('/checkout', [PageController::class, 'checkout']);
Route::get('/user/{id}', [UserController::class, 'show'])->name('show_user');