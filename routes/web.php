<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


/*
|--------------------------------------------------------------------------
| HOME PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $products = Product::with('category')
        ->latest()
        ->take(8)
        ->get();

    $categories = Category::all();

    return view('home', compact('products', 'categories'));

});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

// PRODUCTS PAGE
Route::get('/products', [ProductController::class, 'index']);

// SINGLE PRODUCT PAGE
Route::get('/product/{id}', [ProductController::class, 'show']);

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index']);

Route::get('/cart/add/{id}', [CartController::class, 'add']);

Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

Route::get('/cart/increase/{id}', [CartController::class, 'increase']);

Route::get('/cart/decrease/{id}', [CartController::class, 'decrease']);

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/checkout', [OrderController::class, 'checkout']);

    Route::get('/my-orders', [OrderController::class, 'myOrders']);
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN PRODUCTS
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/products', [AdminProductController::class, 'index']);

    Route::get('/admin/products/create', [AdminProductController::class, 'create']);

    Route::post('/admin/products/store', [AdminProductController::class, 'store']);

    Route::get('/admin/products/edit/{id}', [AdminProductController::class, 'edit']);

    Route::post('/admin/products/update/{id}', [AdminProductController::class, 'update']);

    Route::get('/admin/products/delete/{id}', [AdminProductController::class, 'delete']);

    /*
|--------------------------------------------------------------------------
| ADMIN CATEGORIES
|--------------------------------------------------------------------------
*/

Route::get('/admin/categories', [AdminCategoryController::class, 'index']);

Route::get('/admin/categories/create', [AdminCategoryController::class, 'create']);

Route::post('/admin/categories/store', [AdminCategoryController::class, 'store']);

Route::get('/admin/categories/edit/{id}', [AdminCategoryController::class, 'edit']);

Route::post('/admin/categories/update/{id}', [AdminCategoryController::class, 'update']);

Route::get('/admin/categories/delete/{id}', [AdminCategoryController::class, 'delete']);

    /*
    |--------------------------------------------------------------------------
    | ADMIN ORDERS
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/orders', [AdminOrderController::class, 'index']);

    Route::get('/admin/orders/{id}/{status}', [AdminOrderController::class, 'updateStatus']);
});