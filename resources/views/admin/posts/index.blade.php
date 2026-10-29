@extends('admin.layout')

@section('title', 'Manage Blog Articles')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Blog & Technical Articles ({{ $posts->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Technical guides, manufacturer lists, and dye selection guides.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 25px;">
    <!-- Add Article Form -->
    <div>
        <div class="card">
            <div class="card-header">Publish New Article</div>
            <div class="card-body">
                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="title">Article Title *</label>
                        <input type="text" name="title" id="title" class="form-input" placeholder="e.g. Top 10 Vat Dyes Manufacturers in India" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="slug">Slug (Optional)</label>
                        <input type="text" name="slug" id="slug" class="form-input" placeholder="e.g. top-10-vat-dyes-manufacturers-in-india">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="image_url">Featured Image URL</label>
                        <input type="text" name="image_url" id="image_url" class="form-input" placeholder="/uploads/...">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="excerpt">Short Summary Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="2" class="form-textarea" placeholder="Brief summary..."></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label" for="content">Article Body Content *</label>
                        <textarea name="content" id="content" rows="6" class="form-textarea" placeholder="HTML or text article body..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Publish Article</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Articles List Table -->
    <div>
        <div class="card">
            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>
                                    <strong>{{ $post->title }}</strong>
                                    <div style="font-size: 12px; color: var(--text-muted);">/blogs/{{ $post->slug }}</div>
                                </td>
                                <td style="white-space: nowrap; font-size: 12.5px;">{{ optional($post->created_at)->format('M d, Y') }}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ url('/blogs/' . $post->slug) }}" target="_blank" class="btn btn-outline btn-sm">View ↗</a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 25px; color: var(--text-muted);">No articles found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="margin-top: 15px; display: flex; justify-content: center;">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
