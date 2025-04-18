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
use App\Http\Controllers\AddressController;

Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');


// Admin Routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');


Route::get('/product/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('show', compact('product'));
});
//Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');


// Admin Authentication
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Product, Category, Subcategory Routes (Protected by auth:admin middleware)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::get('subcategories/{category_id}', [SubcategoryController::class, 'getSubcategories'])->name('subcategories.get');
    Route::get('/users', [UsersController::class, 'showUsers'])->name('users');
});

// User Product Routes
Route::get('/products', [ProductController::class, 'userProductList'])->name('product.list');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/product_list', [ProductController::class, 'userProductList'])->name('product.list');
Route::get('/filter-products', [ProductController::class, 'filterBySubcategory']);
Route::get('subcategories/{category_id}', [SubcategoryController::class, 'getSubcategories'])->name('subcategories.get');

// User Wishlist Routes (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.view');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::post('/cart/add-from-wishlist/{id}', [WishlistController::class, 'addToCartFromWishlist'])->name('cart.add.from.wishlist');
});

// Cart Routes (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'cartPage'])->name('cart.page');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
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

// Static Pages (User Side)
Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/feedback', function () { return view('feedback'); })->name('feedback');

// Routes for viewing products by category (User Side)
Route::get('/category/{categoryName}', [ProductController::class, 'showCategoryProducts'])->name('category.products');
