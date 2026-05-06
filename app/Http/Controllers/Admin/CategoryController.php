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
            'name' => 'required|unique:categories'
        ]);

        Category::create([
            'name' => $request->name
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
            'name' => 'required|unique:categories,name,' . $id
        ]);

        $category->update([
            'name' => $request->name
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