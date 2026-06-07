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
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\NotificationController;


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

    Route::get('/order/cancel/{id}', [OrderController::class, 'cancel']);
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

/*
|--------------------------------------------------------------------------
| VENDOR & MARKETPLACE SYSTEM ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/vendor/register', [VendorController::class, 'create']);
    Route::post('/vendor/register', [VendorController::class, 'store']);
});

Route::middleware(['auth', 'is_approved_vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard']);
    Route::get('/vendor/products', [VendorController::class, 'products']);
    Route::get('/vendor/products/create', [VendorController::class, 'createProduct']);
    Route::post('/vendor/products/store', [VendorController::class, 'storeProduct']);
    Route::get('/vendor/products/edit/{id}', [VendorController::class, 'editProduct']);
    Route::post('/vendor/products/update/{id}', [VendorController::class, 'updateProduct']);
    Route::get('/vendor/products/delete/{id}', [VendorController::class, 'deleteProduct']);
    Route::get('/vendor/orders', [VendorController::class, 'orders']);
});

/*
|--------------------------------------------------------------------------
| ADMIN VENDOR & ANALYTICS EXTENSIONS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/vendors', [AdminVendorController::class, 'index']);
    Route::post('/admin/vendors/{id}/status', [AdminVendorController::class, 'updateStatus']);
    Route::get('/admin/analytics', [AnalyticsController::class, 'adminIndex']);
    Route::get('/admin/analytics/export/{format}', [AnalyticsController::class, 'adminExport']);
});

/*
|--------------------------------------------------------------------------
| REVIEWS & RATINGS ROUTES
|--------------------------------------------------------------------------
*/

Route::post('/product/{id}/review', [ReviewController::class, 'store'])->middleware('auth');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/reviews', [AdminReviewController::class, 'index']);
    Route::post('/admin/reviews/{id}/status', [AdminReviewController::class, 'updateStatus']);
});

/*
|--------------------------------------------------------------------------
| NOTIFICATIONS SYSTEM ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll']);
    Route::get('/notifications/{id}/read', [NotificationController::class, 'read']);
});

Route::get('/dev/switch/{role}', function ($role) {
    auth()->logout();
    $email = $role === 'admin' ? 'admin@bulkbazaar.com' : ($role === 'vendor' ? 'vendor@bulkbazaar.com' : 'customer@bulkbazaar.com');
    $user = \App\Models\User::where('email', $email)->first();
    if (!$user && $role === 'vendor') {
        $user = \App\Models\User::create([
            'name' => 'Vendor User',
            'email' => 'vendor@bulkbazaar.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_admin' => false,
        ]);
        \App\Models\VendorProfile::create([
            'user_id' => $user->id,
            'store_name' => 'Apex Digital Solutions',
            'store_description' => 'Premium next-gen technology and digital items.',
            'status' => 'approved',
            'commission_rate' => 10.00,
            'earnings' => 45000.00
        ]);
    }
    if ($user) {
        auth()->login($user);
        return redirect('/dashboard')->with('success', 'Logged in as ' . ucfirst($role) . ' (Dev Switcher)');
    }
    return redirect('/')->with('error', 'User not found');
});