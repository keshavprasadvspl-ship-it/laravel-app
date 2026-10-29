<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SeoMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('categories')->latest();

        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('cas_number', 'like', "%{$s}%")
                  ->orWhere('ci_number', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->input('category_id'));
            });
        }

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'brand' => 'nullable|string|max:100',
            'cas_number' => 'nullable|string|max:50',
            'ci_number' => 'nullable|string|max:50',
            'relative_name' => 'nullable|string|max:255',
            'molecular_formula' => 'nullable|string|max:100',
            'molecular_weight' => 'nullable|string|max:50',
            'physical_appearance' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|string|max:255',
            'status' => 'required|string|in:publish,draft',
            'categories' => 'nullable|array',
            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:100',
        ]);

        $slug = $validated['slug'] ?: Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $imageUrl = $validated['image_url'] ?? null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/products', 'public');
            $imageUrl = '/uploads/products/' . basename($path);
        }

        $product = Product::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'brand' => $validated['brand'] ?: 'S D International',
            'cas_number' => $validated['cas_number'],
            'ci_number' => $validated['ci_number'],
            'relative_name' => $validated['relative_name'],
            'molecular_formula' => $validated['molecular_formula'],
            'molecular_weight' => $validated['molecular_weight'],
            'physical_appearance' => $validated['physical_appearance'],
            'packaging' => $validated['packaging'],
            'short_description' => $validated['short_description'],
            'content' => $validated['content'],
            'image_url' => $imageUrl,
            'status' => $validated['status'],
        ]);

        if (!empty($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        }

        // Save SEO
        SeoMeta::create([
            'seoable_type' => Product::class,
            'seoable_id' => $product->id,
            'meta_title' => $validated['meta_title'] ?: ($product->title . ' | SD International'),
            'meta_description' => $validated['meta_description'] ?: $product->short_description,
            'focus_keyword' => $validated['focus_keyword'] ?? '',
            'canonical_url' => $validated['canonical_url'] ?: url('/' . $product->slug),
            'robots' => $validated['robots'] ?: 'index,follow',
            'og_image' => $product->image_url,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $product->load(['categories', 'seo']);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'brand' => 'nullable|string|max:100',
            'cas_number' => 'nullable|string|max:50',
            'ci_number' => 'nullable|string|max:50',
            'relative_name' => 'nullable|string|max:255',
            'molecular_formula' => 'nullable|string|max:100',
            'molecular_weight' => 'nullable|string|max:50',
            'physical_appearance' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|string|max:255',
            'status' => 'required|string|in:publish,draft',
            'categories' => 'nullable|array',
            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:100',
        ]);

        $imageUrl = $validated['image_url'] ?? $product->image_url;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/products', 'public');
            $imageUrl = '/uploads/products/' . basename($path);
        }

        $product->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'brand' => $validated['brand'] ?: 'S D International',
            'cas_number' => $validated['cas_number'],
            'ci_number' => $validated['ci_number'],
            'relative_name' => $validated['relative_name'],
            'molecular_formula' => $validated['molecular_formula'],
            'molecular_weight' => $validated['molecular_weight'],
            'physical_appearance' => $validated['physical_appearance'],
            'packaging' => $validated['packaging'],
            'short_description' => $validated['short_description'],
            'content' => $validated['content'],
            'image_url' => $imageUrl,
            'status' => $validated['status'],
        ]);

        if (isset($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        }

        // Update SEO
        $product->seo()->updateOrCreate(
            ['seoable_type' => Product::class, 'seoable_id' => $product->id],
            [
                'meta_title' => $validated['meta_title'] ?: ($product->title . ' | SD International'),
                'meta_description' => $validated['meta_description'] ?: $product->short_description,
                'focus_keyword' => $validated['focus_keyword'] ?? '',
                'canonical_url' => $validated['canonical_url'] ?: url('/' . $product->slug),
                'robots' => $validated['robots'] ?: 'index,follow',
                'og_image' => $product->image_url,
            ]
        );

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->seo()->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
