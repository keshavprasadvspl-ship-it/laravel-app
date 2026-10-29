<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('products')->orderBy('name');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->input('q') . '%')
                  ->orWhere('slug', 'like', '%' . $request->input('q') . '%');
        }

        $categories = $query->paginate(25)->withQueryString();
        $parentCategories = Category::where('parent_id', 0)->orderBy('name')->get();

        return view('admin.categories.index', compact('categories', 'parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $slug = $validated['slug'] ?: Str::slug($validated['name']);

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'parent_id' => $validated['parent_id'] ?? 0,
            'description' => $validated['description'] ?? null,
        ]);

        return back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return back()->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->products()->detach();
        $category->delete();
        return back()->with('success', 'Category deleted successfully!');
    }
}
