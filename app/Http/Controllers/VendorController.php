<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\VendorProfile;

class VendorController extends Controller
{
    // SHOW REGISTRATION FORM
    public function create()
    {
        if (auth()->user()->isVendor()) {
            return redirect('/vendor/dashboard')->with('error', 'You are already registered as a vendor.');
        }
        return view('vendor.register');
    }

    // STORE REGISTRATION
    public function store(Request $request)
    {
        if (auth()->user()->isVendor()) {
            return redirect('/vendor/dashboard')->with('error', 'You are already registered as a vendor.');
        }

        $request->validate([
            'store_name' => 'required|string|max:255|unique:vendor_profiles,store_name',
            'store_description' => 'nullable|string',
            'store_logo' => 'nullable|image|max:2048',
            'store_banner' => 'nullable|image|max:2048',
        ]);

        $logoName = null;
        if ($request->hasFile('store_logo')) {
            $logo = $request->file('store_logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('vendors'), $logoName);
        }

        $bannerName = null;
        if ($request->hasFile('store_banner')) {
            $banner = $request->file('store_banner');
            $bannerName = 'banner_' . time() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('vendors'), $bannerName);
        }

        VendorProfile::create([
            'user_id' => auth()->id(),
            'store_name' => $request->store_name,
            'store_description' => $request->store_description,
            'store_logo' => $logoName,
            'store_banner' => $bannerName,
            'commission_rate' => 10.00,
            'earnings' => 0.00,
            'status' => 'pending' // pending, approved, rejected, suspended
        ]);

        return redirect('/dashboard')->with('success', 'Your vendor application has been submitted and is pending approval.');
    }

    // DASHBOARD
    public function dashboard()
    {
        $vendorId = auth()->id();
        $productsCount = Product::where('vendor_id', $vendorId)->count();
        $profile = auth()->user()->vendorProfile;
        
        // Vendor orders: orders that contain items of this vendor's products
        $orders = Order::whereHas('items.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->with(['items' => function($q) use ($vendorId) {
            $q->whereHas('product', function($sp) use ($vendorId) {
                $sp->where('vendor_id', $vendorId);
            });
        }, 'user'])->latest()->get();

        $ordersCount = $orders->count();

        // Calculate actual total sales revenue for the vendor
        $salesRevenue = 0;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $salesRevenue += $item->price * $item->quantity;
            }
        }

        return view('vendor.dashboard', compact('productsCount', 'ordersCount', 'salesRevenue', 'profile', 'orders'));
    }

    // LIST PRODUCTS
    public function products()
    {
        $products = Product::where('vendor_id', auth()->id())->with('category')->latest()->get();
        return view('vendor.products.index', compact('products'));
    }

    // CREATE PRODUCT PAGE
    public function createProduct()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    // STORE PRODUCT
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'nullable',
            'brand' => 'nullable',
            'discount_price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
            'tags' => 'nullable',
            'specifications' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'brand' => $request->brand,
            'discount_price' => $request->discount_price,
            'status' => $request->status,
            'tags' => $request->tags,
            'specifications' => $request->specifications,
            'image' => $imageName,
            'vendor_id' => auth()->id(),
        ]);

        return redirect('/vendor/products')->with('success', 'Product added successfully');
    }

    // EDIT PRODUCT PAGE
    public function editProduct($id)
    {
        $product = Product::where('vendor_id', auth()->id())->findOrFail($id);
        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    // UPDATE PRODUCT
    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('vendor_id', auth()->id())->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'nullable',
            'brand' => 'nullable',
            'discount_price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
            'tags' => 'nullable',
            'specifications' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'brand' => $request->brand,
            'discount_price' => $request->discount_price,
            'status' => $request->status,
            'tags' => $request->tags,
            'specifications' => $request->specifications,
            'image' => $imageName,
        ]);

        return redirect('/vendor/products')->with('success', 'Product updated successfully');
    }

    // DELETE PRODUCT
    public function deleteProduct($id)
    {
        $product = Product::where('vendor_id', auth()->id())->findOrFail($id);
        $product->delete();
        return redirect('/vendor/products')->with('success', 'Product deleted successfully');
    }

    // LIST ORDERS
    public function orders()
    {
        $vendorId = auth()->id();
        $orders = Order::whereHas('items.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->with(['items' => function($q) use ($vendorId) {
            $q->whereHas('product', function($sp) use ($vendorId) {
                $sp->where('vendor_id', $vendorId);
            });
        }, 'user'])->latest()->get();

        return view('vendor.orders.index', compact('orders'));
    }
}
