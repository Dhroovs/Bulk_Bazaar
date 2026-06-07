<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $userId = auth()->id();

        // 1. Check if user already reviewed this product
        $existing = Review::where('product_id', $product->id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already submitted a review for this product.');
        }

        // 2. Check if user actually purchased this product
        $purchased = Order::where('user_id', $userId)
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        if (!$purchased) {
            return redirect()->back()->with('error', 'Only verified purchasers of this product can submit reviews.');
        }

        // 3. Validate request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 4. Create review (verified purchase true since they purchased it)
        Review::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'active',
            'is_verified_purchase' => true
        ]);

        return redirect()->back()->with('success', 'Your review has been successfully published!');
    }
}
