@extends('admin.layout')

@section('title', 'Manage CMS Pages')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">CMS Pages ({{ $pages->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Manage informational, corporate, compliance, and application pages.</p>
    </div>

    <div>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">+ Add New Page</a>
    </div>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 15px 20px;">
        <form action="{{ route('admin.pages.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ request('q') }}" class="form-input" placeholder="Search pages by Title or Slug..." style="flex: 1; min-width: 280px;">
            <button type="submit" class="btn btn-primary">Search</button>
            @if(request('q'))
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline">Clear</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Page Title</th>
                        <th>Slug & URL</th>
                        <th>Last Updated</th>
                        <th style="text-align: right; width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td><strong>#{{ $page->id }}</strong></td>
                        <td>
                            <strong>{{ $page->title }}</strong>
                            @if($page->wp_id)
                                <span class="badge badge-info" style="font-size: 11px; margin-left: 6px;">WP #{{ $page->wp_id }}</span>
                            @endif
                        </td>
                        <td>
                            <code>/{{ $page->slug }}</code>
                            <a href="{{ url('/' . $page->slug) }}" target="_blank" style="margin-left: 6px; font-size: 12px; text-decoration: none; color: var(--accent);">↗</a>
                        </td>
                        <td style="color: var(--text-muted); font-size: 12.5px;">
                            {{ $page->updated_at ? $page->updated_at->format('M d, Y') : '—' }}
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete page: {{ addslashes($page->title) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                            No pages found matching your search.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
        <div style="padding: 20px; border-top: 1px solid var(--border);">
            {{ $pages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

