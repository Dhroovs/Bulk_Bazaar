<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // SHOW ALL CATEGORIES
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    // CREATE PAGE
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE CATEGORY
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageName = null;

        // Image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('categories'), $imageName);
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Category added successfully');
    }

    // EDIT PAGE
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE CATEGORY
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageName = $category->image;

        // Image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('categories'), $imageName);
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Category updated successfully');
    }

    // DELETE CATEGORY
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect('/admin/categories')
            ->with('success', 'Category deleted successfully');
    }
}