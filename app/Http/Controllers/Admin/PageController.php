<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::latest();

        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('slug', 'like', "%{$s}%");
            });
        }

        $pages = $query->paginate(20)->withQueryString();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'content' => 'nullable|string',
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
        while (Page::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $page = Page::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'] ?? '',
        ]);

        SeoMeta::create([
            'seoable_type' => Page::class,
            'seoable_id' => $page->id,
            'meta_title' => $validated['meta_title'] ?: ($page->title . ' | SD International'),
            'meta_description' => $validated['meta_description'] ?: substr(strip_tags($page->content), 0, 160),
            'focus_keyword' => $validated['focus_keyword'] ?? '',
            'canonical_url' => $validated['canonical_url'] ?: url('/' . $page->slug),
            'robots' => $validated['robots'] ?: 'index,follow',
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    }

    public function edit(Page $page)
    {
        $page->load('seo');
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:100',
        ]);

        $page->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'] ?? '',
        ]);

        $page->seo()->updateOrCreate(
            ['seoable_type' => Page::class, 'seoable_id' => $page->id],
            [
                'meta_title' => $validated['meta_title'] ?: ($page->title . ' | SD International'),
                'meta_description' => $validated['meta_description'] ?: substr(strip_tags($page->content), 0, 160),
                'focus_keyword' => $validated['focus_keyword'] ?? '',
                'canonical_url' => $validated['canonical_url'] ?: url('/' . $page->slug),
                'robots' => $validated['robots'] ?: 'index,follow',
            ]
        );

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
    }

    public function destroy(Page $page)
    {
        $page->seo()->delete();
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully!');
    }
}
