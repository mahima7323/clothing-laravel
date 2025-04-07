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

// Admin Dashboard Route
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Order Success Page
Route::get('/order/success', function () {
    return view('orders.success');
})->name('order.success');

Route::get('/admin/orders', function () {
    return 'Orders Page Coming Soon!';
})->name('admin.orders.index');





// Cart Routes
Route::middleware('auth')->group(function () {
    Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'cartPage'])->name('cart.page');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    //Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
});





// Wishlist Routes

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.view');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
   // Route::post('/cart/add-from-wishlist/{id}', [CartController::class, 'addFromWishlist'])->name('cart.add.from.wishlist');
    Route::post('/cart/add-from-wishlist/{id}', [WishlistController::class, 'addToCartFromWishlist'])->name('cart.add.from.wishlist');

});



// Order Routes (Protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');
});

// User Registration and Login Routes
Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsersController::class, 'login'])->name('login.submit');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/register', [UsersController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UsersController::class, 'register'])->name('register.submit');

// User Profile Route (Protected by auth middleware)
Route::get('/user/profile', [UsersController::class, 'showUserData'])->middleware('auth')->name('user.profile');

// Home Route
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

// Route for viewing products by category
Route::get('/category/{categoryName}', [ProductController::class, 'showCategoryProducts'])->name('category.products');

// Route for viewing product details
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');