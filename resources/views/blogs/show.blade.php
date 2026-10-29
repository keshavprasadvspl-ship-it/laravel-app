@extends('layouts.app')

@section('content')
<style>
    .article-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 45px;
        padding: 45px 0 80px;
    }
    .article-header {
        margin-bottom: 30px;
    }
    .article-header h1 {
        font-size: 32px;
        color: #0f172a;
        line-height: 1.3;
        margin-bottom: 12px;
    }
    .article-meta {
        color: #64748b;
        font-size: 13.5px;
        display: flex;
        gap: 20px;
    }
    .article-featured-image {
        margin-bottom: 30px;
        border-radius: 8px;
        overflow: hidden;
        max-height: 420px;
    }
    .article-featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .article-body {
        font-size: 16px;
        line-height: 1.8;
        color: #334155;
    }
    .article-body h2 {
        font-size: 24px;
        margin: 30px 0 15px;
        color: #0f172a;
    }
    .article-body h3 {
        font-size: 20px;
        margin: 25px 0 12px;
        color: #0f172a;
    }
    .article-body p {
        margin-bottom: 20px;
    }
    .article-body ul, .article-body ol {
        margin: 0 0 20px 24px;
    }
    .article-body li {
        margin-bottom: 8px;
    }
    .recent-post-link {
        display: block;
        padding: 10px 0;
        border-bottom: 1px dashed #e2e8f0;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }
    .recent-post-link:hover {
        color: var(--primary);
    }
    @media (max-width: 900px) {
        .article-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <div class="article-layout">
        <!-- Main Article -->
        <article>
            <div class="article-header">
                <h1>{{ $post->title }}</h1>
                <div class="article-meta">
                    <span>✍️ Written by Technical Editorial Team</span>
                    <span>📅 {{ optional($post->created_at)->format('F d, Y') ?? 'Published' }}</span>
                </div>
            </div>

            @if($post->image_url)
                <div class="article-featured-image">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="article-body">
                {!! $post->content !!}
            </div>
        </article>

        <!-- Sidebar -->
        <aside>
            <div class="sidebar-widget">
                <h3 class="widget-title">Recent Articles</h3>
                @foreach($recentPosts as $r)
                    <a href="{{ url('/blogs/' . $r->slug) }}" class="recent-post-link">
                        {{ $r->title }}
                    </a>
                @endforeach
            </div>

            <div class="sidebar-contact-card">
                <h4>Looking for High Grade Dyes?</h4>
                <p style="font-size: 13.5px; color: #4b5563; margin-bottom: 15px;">
                    SD International manufactures over 600 dyes and pigment formulations.
                </p>
                <button type="button" class="btn-quote-large" style="width: 100%;" onclick="openQuoteModal()">Get Product Catalog</button>
            </div>
        </aside>
    </div>
</div>
@endsection
