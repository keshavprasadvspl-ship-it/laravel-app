@extends('admin.layout')

@section('title', 'Manage Products')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Chemical Products ({{ $products->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Full catalog of Vat Dyes, Solvent Dyes, Pigments and Chemical Intermediates.</p>
    </div>

    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 15px 20px;">
        <form action="{{ route('admin.products.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ request('q') }}" class="form-input" placeholder="Search by Title, CAS Registry, or C.I. Number..." style="flex: 1; min-width: 260px;">

            <select name="category_id" class="form-select" style="width: 240px;">
                <option value="">-- All Categories --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request('q') || request('category_id'))
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Clear</a>
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
                        <th>Image</th>
                        <th>Product Title</th>
                        <th>CAS Number</th>
                        <th>C.I. Number</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $prod)
                    <tr>
                        <td style="width: 50px;">
                            @if($prod->image_url)
                                <img src="{{ $prod->image_url }}" alt="{{ $prod->title }}" style="width: 40px; height: 40px; object-fit: contain; border-radius: 4px; border: 1px solid var(--border);">
                            @else
                                <span style="font-size: 22px;">📦</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $prod->title }}</strong>
                            <div style="font-size: 11.5px; color: var(--text-muted);">/{{ $prod->slug }}</div>
                        </td>
                        <td><code>{{ $prod->cas_number ?: '—' }}</code></td>
                        <td>{{ $prod->ci_number ?: '—' }}</td>
                        <td style="max-width: 180px;">
                            @foreach($prod->categories->take(2) as $c)
                                <span class="badge badge-info" style="margin: 2px 0;">{{ $c->name }}</span>
                            @endforeach
                            @if($prod->categories->count() > 2)
                                <span style="font-size: 11px; color: var(--text-muted);">+{{ $prod->categories->count() - 2 }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $prod->status == 'publish' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($prod->status) }}</span>
                        </td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-outline btn-sm">Edit</a>
                            <a href="{{ url('/' . $prod->slug) }}" target="_blank" class="btn btn-outline btn-sm">View ↗</a>
                            <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-muted);">No products found matching query.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $products->links() }}
</div>
@endsection
