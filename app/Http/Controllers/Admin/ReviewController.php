<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // LIST ALL REVIEWS
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // UPDATE REVIEW STATUS
    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $allowed = ['active', 'hidden', 'deleted'];

        if (!in_array($status, $allowed)) {
            return redirect('/admin/reviews')->with('error', 'Invalid review status');
        }

        $review = Review::findOrFail($id);
        $review->status = $status;
        $review->save();

        return redirect('/admin/reviews')->with('success', 'Review status updated successfully');
    }
}
