@extends('layouts.app')

@section('content')
<style>
    .blog-hero {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 45px 0;
        margin-bottom: 45px;
    }
    .blog-hero h1 {
        font-size: 32px;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        padding-bottom: 70px;
    }
    .blog-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    }
    .blog-card-img {
        height: 200px;
        background: #f1f5f9;
        overflow: hidden;
    }
    .blog-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .blog-card-body {
        padding: 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .blog-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .blog-card-title:hover {
        color: var(--primary);
    }
    .blog-card-excerpt {
        font-size: 14px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .blog-card-link {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--primary);
    }
</style>

<div class="blog-hero">
    <div class="container">
        <h1>Blogs & Industry Insights</h1>
        <p style="color: #64748b;">Technical articles, manufacturer rankings, dye selection guides, and chemical industry updates.</p>
    </div>
</div>

<div class="container">
    <div class="blog-grid">
        @foreach($posts as $post)
        <div class="blog-card">
            <div class="blog-card-img">
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
                @else
                    <img src="https://sdinternational.com/wp-content/uploads/2020/07/5ddb74a20df98509a8e6f174_shutterstock_1443613712-1-1.jpg" alt="{{ $post->title }}" style="object-fit: cover;">
                @endif
            </div>
            <div class="blog-card-body">
                <div>
                    <a href="{{ url('/blogs/' . $post->slug) }}" class="blog-card-title">{{ $post->title }}</a>
                    <p class="blog-card-excerpt">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 120) }}
                    </p>
                </div>
                <div>
                    <a href="{{ url('/blogs/' . $post->slug) }}" class="blog-card-link">Read Full Article →</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="display: flex; justify-content: center; margin-bottom: 60px;">
        {{ $posts->links() }}
    </div>
</div>
@endsection
