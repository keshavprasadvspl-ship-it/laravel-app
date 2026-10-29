<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SeoMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::latest();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->input('q') . '%');
        }

        $posts = $query->paginate(20)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image_url' => 'nullable|string',
        ]);

        $slug = $validated['slug'] ?: Str::slug($validated['title']);

        $post = Post::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'image_url' => $validated['image_url'],
        ]);

        SeoMeta::create([
            'seoable_type' => Post::class,
            'seoable_id' => $post->id,
            'meta_title' => $post->title . ' | SD International Blogs',
            'meta_description' => $post->excerpt,
            'canonical_url' => url('/blogs/' . $post->slug),
            'robots' => 'index,follow',
            'og_image' => $post->image_url,
        ]);

        return back()->with('success', 'Article created successfully!');
    }

    public function destroy(Post $post)
    {
        $post->seo()->delete();
        $post->delete();
        return back()->with('success', 'Article deleted successfully!');
    }
}
