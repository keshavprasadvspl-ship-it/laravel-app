@extends('admin.layout')

@section('title', 'Product Categories')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Product Categories ({{ $categories->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Manage chemical category taxonomy and product mappings.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 25px;">
    <!-- Add Category Form -->
    <div>
        <div class="card">
            <div class="card-header">Add New Category</div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="name">Category Name *</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="e.g. Reactive Dyes" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="slug">Slug (Optional)</label>
                        <input type="text" name="slug" id="slug" class="form-input" placeholder="e.g. reactive-dyes">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label" for="parent_id">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-select">
                            <option value="0">-- None (Top Level) --</option>
                            @foreach($parentCategories as $p)
                                <option value="{{ $p->wp_term_id ?: $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label" for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-textarea" placeholder="Category introduction and application summary..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Create Category</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Categories List Table -->
    <div>
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-body" style="padding: 12px 20px;">
                <form action="{{ route('admin.categories.index') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-input" placeholder="Search category by name or slug...">
                    <button type="submit" class="btn btn-primary">Search</button>
                    @if(request('q'))
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Clear</a>
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
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                            <tr>
                                <td>
                                    <strong>{{ $cat->name }}</strong>
                                </td>
                                <td><code>/{{ $cat->slug }}</code></td>
                                <td>
                                    <span class="badge badge-info">{{ $cat->products_count }} products</span>
                                </td>
                                <td>
                                    <a href="{{ url('/' . $cat->slug) }}" target="_blank" class="btn btn-outline btn-sm">View ↗</a>
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 25px; color: var(--text-muted);">No categories found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="margin-top: 15px; display: flex; justify-content: center;">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
