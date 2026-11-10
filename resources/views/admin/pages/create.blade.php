@extends('admin.layout')

@section('title', 'Add New CMS Page')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Create New CMS Page</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Add a new informational or landing page with custom SEO metadata.</p>
    </div>
    <div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline">← Back to Pages</a>
    </div>
</div>

<form action="{{ route('admin.pages.store') }}" method="POST">
    @csrf

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
        <div>
            <!-- Page Content Card -->
            <div class="card">
                <div class="card-header">Page Details</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Page Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-input" placeholder="e.g. Quality Control & Analytical Laboratory" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Custom URL Slug (Leave blank to auto-generate)</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-input" placeholder="e.g. quality-control-laboratory">
                    </div>

                    <div class="form-group">
                        <label class="form-label">HTML / Page Content</label>
                        <textarea name="content" rows="18" class="form-textarea" placeholder="Enter page content or HTML markup..." style="font-family: monospace; font-size: 13.5px;">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SEO Card -->
            <div class="card">
                <div class="card-header">Search Engine Optimization (SEO)</div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-input" placeholder="Title for Google search results">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-textarea" placeholder="Brief summary for Google search snippet (150-160 characters)">{{ old('meta_description') }}</textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Focus Keyword</label>
                        <input type="text" name="focus_keyword" value="{{ old('focus_keyword') }}" class="form-input" placeholder="Primary keyword target">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Canonical URL</label>
                        <input type="text" name="canonical_url" value="{{ old('canonical_url') }}" class="form-input" placeholder="https://sdinternational.com/...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div>
            <div class="card">
                <div class="card-header">Publishing</div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px;">Publish Page</button>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; margin-top: 10px;">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

