<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // PRODUCTS PAGE
    public function index(Request $request)
    {
        $query = Product::with('category');

        // SEARCH
        if ($request->search) {

            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // CATEGORY FILTER
        if ($request->category) {

            $query->where('category_id', $request->category);
        }

        // SORTING
        if ($request->sort == 'low-high') {

            $query->orderBy('price', 'ASC');

        } elseif ($request->sort == 'high-low') {

            $query->orderBy('price', 'DESC');

        } else {

            $query->latest();
        }

        // PRODUCTS
        $products = $query->paginate(6)->withQueryString();

        // CATEGORIES
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // SINGLE PRODUCT PAGE
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }
}