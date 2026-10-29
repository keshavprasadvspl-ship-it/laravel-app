@extends('admin.layout')

@section('title', 'Overview Dashboard')

@section('content')
<style>
    .stats-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }
    .icon-products { background: #eff6ff; color: #2563eb; }
    .icon-categories { background: #fdf2f8; color: #db2777; }
    .icon-inquiries { background: #f0fdf4; color: #16a34a; }
    .icon-posts { background: #fefce8; color: #ca8a04; }

    .stat-val {
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.1;
    }
    .stat-lbl {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 4px;
    }
    .quick-actions {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
</style>

<div class="page-title-row">
    <div>
        <h1 class="page-heading">Dashboard Overview</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Welcome back to SD International administration system.</p>
    </div>

    <div class="quick-actions">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">+ Add Category</a>
    </div>
</div>

<!-- 4 Stats Cards -->
<div class="stats-cards-grid">
    <div class="stat-card">
        <div class="stat-icon icon-products">📦</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_products']) }}</div>
            <div class="stat-lbl">Active Products</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-categories">🏷️</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_categories']) }}</div>
            <div class="stat-lbl">Product Categories</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-inquiries">💬</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_inquiries']) }}</div>
            <div class="stat-lbl">Client Inquiries</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-posts">📝</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_posts']) }}</div>
            <div class="stat-lbl">Technical Articles</div>
        </div>
    </div>
</div>

<!-- Recent Inquiries -->
<div class="card">
    <div class="card-header">
        <span>Recent Quote Inquiries & Leads</span>
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline btn-sm">View All Inquiries →</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Client Name</th>
                        <th>Email / Contact</th>
                        <th>Product</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentInquiries as $inq)
                    <tr>
                        <td>{{ $inq->created_at->format('M d, Y H:i') }}</td>
                        <td><strong>{{ $inq->name }}</strong></td>
                        <td>
                            <div>{{ $inq->email }}</div>
                            <div style="font-size: 12px; color: var(--text-muted);">{{ $inq->phone }}</div>
                        </td>
                        <td>
                            @if($inq->product_slug)
                                <a href="{{ url('/' . $inq->product_slug) }}" target="_blank">{{ $inq->product_name ?: $inq->product_slug }}</a>
                            @else
                                {{ $inq->product_name ?: 'General Inquiry' }}
                            @endif
                        </td>
                        <td style="max-width: 250px;">{{ \Illuminate\Support\Str::limit($inq->message, 80) }}</td>
                        <td>
                            <a href="mailto:{{ $inq->email }}" class="btn btn-primary btn-sm">Reply</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 25px; color: var(--text-muted);">No inquiries received yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Recent Products Added/Modified -->
<div class="card">
    <div class="card-header">
        <span>Recently Managed Chemical Products</span>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">Manage All 628 Products →</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Title</th>
                        <th>CAS Registry No</th>
                        <th>C.I. Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentProducts as $prod)
                    <tr>
                        <td style="width: 50px;">
                            @if($prod->image_url)
                                <img src="{{ $prod->image_url }}" alt="{{ $prod->title }}" style="width: 36px; height: 36px; object-fit: contain; border-radius: 4px; border: 1px solid var(--border);">
                            @else
                                <span style="font-size: 20px;">📦</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $prod->title }}</strong>
                        </td>
                        <td><code>{{ $prod->cas_number ?: 'N/A' }}</code></td>
                        <td>{{ $prod->ci_number ?: 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $prod->status == 'publish' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($prod->status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-outline btn-sm">Edit</a>
                            <a href="{{ url('/' . $prod->slug) }}" target="_blank" class="btn btn-outline btn-sm">View ↗</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
