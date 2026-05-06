<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // SHOW PRODUCTS
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    // CREATE PAGE
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    // STORE PRODUCT
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
        ]);

        $imageName = null;

        // IMAGE UPLOAD
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
            'image' => $imageName,
        ]);

        return redirect('/admin/products')
            ->with('success', 'Product added successfully');
    }

    // EDIT PAGE
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
        ]);

        $imageName = $product->image;

        // NEW IMAGE
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
            'image' => $imageName,
        ]);

        return redirect('/admin/products')
            ->with('success', 'Product updated successfully');
    }

    // DELETE PRODUCT
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/admin/products')
            ->with('success', 'Product deleted successfully');
    }
}