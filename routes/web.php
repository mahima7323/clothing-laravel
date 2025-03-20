<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;

// User Registration and Login Routes
Route::get('/register', [UsersController::class, 'index'])->name('register');
Route::post('/register', [UsersController::class, 'store'])->name('store');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UsersController::class, 'log'])->name('log');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

// Home Route (User Side)
Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

// User Side - Product List
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product_list', [ProductController::class, 'userProductList'])->name('product.list');

// Static Pages (User Side)
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/feedback', function () {
    return view('feedback');
})->name('feedback');

// Admin Authentication Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Dashboard Route
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');

// Admin Routes (Product, Category, Subcategory)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Product Routes
    Route::resource('products', ProductController::class);
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/create', [ProductController::class, 'store'])->name('products.store');

    // Category Routes
    Route::resource('categories', CategoryController::class);

    // Subcategory Routes
    Route::resource('subcategories', SubcategoryController::class);

    // Route to get subcategories based on the selected category (Ajax)
    Route::get('/subcategories/{category_id}', [SubcategoryController::class, 'getSubcategories'])->name('subcategories.get');

    // Admin User Management
    Route::get('/users', [UsersController::class, 'showUsers'])->name('users');
});

// User Profile Route
Route::get('/user/profile', [UsersController::class, 'showUserData'])->middleware('auth')->name('user.profile');

Route::get('/admin/subcategories/{subcategory}', [SubcategoryController::class, 'show']);
// Remove this line
// Route::get('/admin/subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');


// Remove duplicate routes
// This was previously duplicated and needs to be removed
// Route::get('/admin/subcategories/get/{category_id}', [SubcategoryController::class, 'getSubcategories'])->name('subcategories.get');
// Route::get('/admin/get-subcategories/{category_id}', [SubcategoryController::class, 'getSubcategories'])->name('subcategories.get');

// Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
//     Route::resource('products', ProductController::class);
// });

// Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');

// Route::prefix('admin')->group(function () {
//     Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
// });