<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Middleware\{
    AdminAuthorization,
    CartUserVisibility,
    EntranceToRegisteredUsers
};
use App\Http\Middleware\ShareAuthenticatedUser;
use App\Mail\leadAcquired;

Route::view('/', 'index')->name('home');
Route::view('/about', 'about');

Route::post('/download-csv/{entityName}', [PageController::class, 'downloadCsv'])->name('download_csv');

Route::middleware(AdminAuthorization::class)->group(function () {
    Route::get('/leads', [LeadController::class, 'index'])->name('leads');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginUser');
    Route::post('/register', 'addUser');
    Route::get('/register', 'register')->name('register');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/dashboard/{id}', 'destroy')->name('delete_user');
    Route::get('/user/{id}', 'show')->name('show_user');
    Route::get('/edit-user/{id}', 'edit')->name('edit_user');
    Route::post('/edit-user/{id}', 'update');
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('/edit-permission/{id}', 'edit')->name('edit_permission');
    Route::post('/edit-permission/{id}', 'update');
    Route::post('/permission-delete/{id}', 'destroy')->name('delete_permission');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/edit-role/{id}', 'edit')->name('edit_role');
    Route::post('/edit-role/{id}', 'update');
    Route::post('/role-delete/{id}', 'destroy')->name('delete_role');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'products')->name('products');
    Route::get('/product/{id}', 'product')->name('product');
    Route::post('/product/{id}', 'store')->name('products_store');
    Route::get('/edit-product/{id}', 'edit')->name('edit_product');
    Route::post('/edit-product/{id}', 'update');
    Route::post('/products/{id}', 'destroy')->name('delete_product');
    Route::post('/product/{id}/add-to-cart', 'addProductToCart')->name('add_to_cart');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/edit-category/{id}', 'edit')->name('edit_category');
    Route::post('/edit-category/{id}', 'update');
    Route::post('/categories/{id}', 'destroy')->name('delete_category');
    Route::get('/category/{id}', 'show')->name('category');
    Route::get('/categories', 'index')->name('categories');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart/{id}', 'showCart')->middleware(CartUserVisibility::class)->name('show_cart');
    Route::post('/cart/{id}', 'deleteCartItem')->name('delete_cart_item');
    Route::post('/cart/{id}/change-quantity', 'changeQuantityOfProduct')->name('change_quantity');
});

Route::controller(CheckOutController::class)->group(function () {
    Route::get('/checkout/{id}', 'checkout')->middleware(EntranceToRegisteredUsers::class)->name('checkout');
});

Route::controller(LeadController::class)->group(function () {
    Route::post('/save-lead', 'store')->name('save_lead');
    Route::post('/lead-delete/{id}', 'destroy')->name('delete_lead');
    Route::get('/lead/{id}', 'edit')->name('edit_lead');
    Route::post('/lead/{id}', 'update');
});
