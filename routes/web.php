<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;


use App\Http\Controllers\CartController;

use App\Http\Controllers\WishlistController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::get('/order/success', function () {
    return view('orders.success');
})->name('order.success');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard', [
        'totalProducts' => 3, 
        'totalUsers' => 5, 
        'totalOrders' => 19, 
        'totalRevenue' => 39288.00
    ]);
})->name('admin.dashboard');



 Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
 //Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
 Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');

Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');



// User Registration and Login Routes
// Route::get('/register', [UsersController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [UsersController::class, 'register'])->name('register.submit');

// Route::get('/login', function () {
//     return view('login');
// })->name('login');
// Route::post('/login', [UsersController::class, 'login'])->name('login');
// Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

// // Home Route (User Side)
// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth')->name('welcome');





Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsersController::class, 'login'])->name('login.submit');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/register', [UsersController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UsersController::class, 'register'])->name('register.submit');

Route::get('/users', [UsersController::class, 'showUsers'])->name('admin.users');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


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

Route::get('/category/{categoryName}', [ProductController::class, 'showCategoryProducts'])->name('category.products');
 //Route::get('/category/{name}', [ProductController::class, 'showCategoryProducts']);
 //Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');


 Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
 


//Route::get('/category/{categoryName}', [ProductController::class, 'showCategoryProducts']);

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