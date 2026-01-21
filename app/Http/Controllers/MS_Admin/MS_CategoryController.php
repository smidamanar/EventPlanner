<?php

namespace App\Http\Controllers\MS_Admin;

use App\Http\Controllers\Controller;
use App\Models\MS_Category;
use Illuminate\Http\Request;

class MS_CategoryController extends Controller
{
    public function index()
    {
        $categories = MS_Category::latest()->paginate(10);
        return view('MS_Admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('MS_Admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        MS_Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(MS_Category $category)
    {
        return view('MS_Admin.categories.edit', compact('category'));
    }

    public function update(Request $request, MS_Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(MS_Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}