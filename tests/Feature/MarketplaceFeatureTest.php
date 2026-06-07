<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\VendorProfile;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

test('non-purchasers are blocked from submitting product reviews', function () {
    $category = Category::create([
        'name' => 'Tech Electronics',
        'description' => 'Test category',
        'image' => 'tech.jpg',
        'status' => 'active'
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Aura Phone',
        'sku' => 'AURA-P',
        'price' => 1000,
        'stock' => 10,
        'status' => 'active'
    ]);

    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@test.com',
        'password' => Hash::make('password'),
        'is_admin' => false
    ]);

    $response = $this->actingAs($user)->post("/product/{$product->id}/review", [
        'rating' => 5,
        'title' => 'Awesome!',
        'description' => 'I love this phone!'
    ]);

    $response->assertRedirect();
    $this->assertDatabaseMissing('reviews', [
        'product_id' => $product->id,
        'user_id' => $user->id
    ]);
});

test('verified purchasers can submit reviews', function () {
    $category = Category::create([
        'name' => 'Tech Electronics',
        'description' => 'Test category',
        'image' => 'tech.jpg',
        'status' => 'active'
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Aura Phone',
        'sku' => 'AURA-P',
        'price' => 1000,
        'stock' => 10,
        'status' => 'active'
    ]);

    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@test.com',
        'password' => Hash::make('password'),
        'is_admin' => false
    ]);

    // Create a purchase order
    $order = Order::create([
        'user_id' => $user->id,
        'total_price' => 1000,
        'status' => 'pending'
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 1,
        'price' => 1000
    ]);

    $response = $this->actingAs($user)->post("/product/{$product->id}/review", [
        'rating' => 5,
        'title' => 'Awesome!',
        'description' => 'I love this phone!'
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('reviews', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'rating' => 5,
        'is_verified_purchase' => true
    ]);
});

test('vendor status change triggers notification', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin_test@test.com',
        'password' => Hash::make('password'),
    ]);
    $admin->is_admin = true;
    $admin->save();

    $vendorUser = User::create([
        'name' => 'Vendor User',
        'email' => 'vendor_test@test.com',
        'password' => Hash::make('password'),
    ]);

    $profile = VendorProfile::create([
        'user_id' => $vendorUser->id,
        'store_name' => 'Apex Test Store',
        'status' => 'pending',
        'commission_rate' => 10.00,
        'earnings' => 0.00
    ]);

    $response = $this->actingAs($admin)->post("/admin/vendors/{$profile->id}/status", [
        'status' => 'approved'
    ]);

    $response->assertRedirect();
    expect($profile->fresh()->status)->toBe('approved');
    
    // Check notification exists in DB
    $this->assertDatabaseHas('notifications', [
        'notifiable_id' => $vendorUser->id,
        'type' => 'App\Notifications\VendorStatusNotification'
    ]);
});
