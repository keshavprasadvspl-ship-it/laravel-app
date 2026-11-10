@extends('admin.layout')

@section('title', 'Edit Page - ' . $page->title)

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Edit Page: {{ $page->title }}</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Update page content, URL slug, and SEO settings.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ url('/' . $page->slug) }}" target="_blank" class="btn btn-outline">View on Live Site ↗</a>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline">← Back to Pages</a>
    </div>
</div>

<form action="{{ route('admin.pages.update', $page) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
        <div>
            <!-- Page Content Card -->
            <div class="card">
                <div class="card-header">Page Details</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Page Title *</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-input" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Custom URL Slug *</label>
                        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">HTML / Page Content</label>
                        <textarea name="content" rows="20" class="form-textarea" style="font-family: monospace; font-size: 13.5px;">{{ old('content', $page->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SEO Card -->
            <div class="card">
                <div class="card-header">Search Engine Optimization (SEO)</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $page->seo->meta_title ?? '') }}" class="form-input">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-textarea">{{ old('meta_description', $page->seo->meta_description ?? '') }}</textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Focus Keyword</label>
                        <input type="text" name="focus_keyword" value="{{ old('focus_keyword', $page->seo->focus_keyword ?? '') }}" class="form-input">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Canonical URL</label>
                        <input type="text" name="canonical_url" value="{{ old('canonical_url', $page->seo->canonical_url ?? '') }}" class="form-input">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div>
            <div class="card">
                <div class="card-header">Save Changes</div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px;">Save Changes</button>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; margin-top: 10px;">Cancel</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Page Metadata</div>
                <div class="card-body" style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                    <p><strong>Page ID:</strong> #{{ $page->id }}</p>
                    @if($page->wp_id)
                        <p><strong>WordPress Post ID:</strong> #{{ $page->wp_id }}</p>
                    @endif
                    <p><strong>Created:</strong> {{ $page->created_at ? $page->created_at->format('M d, Y H:i') : '—' }}</p>
                    <p><strong>Last Updated:</strong> {{ $page->updated_at ? $page->updated_at->format('M d, Y H:i') : '—' }}</p>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

