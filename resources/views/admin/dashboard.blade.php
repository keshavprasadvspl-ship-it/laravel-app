@extends('admin.layout')

@section('title', 'Overview Dashboard')

@section('content')
<style>
    .stats-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .icon-products { background: #eff6ff; color: #2563eb; }
    .icon-categories { background: #fdf2f8; color: #db2777; }
    .icon-inquiries { background: #f0fdf4; color: #16a34a; }
    .icon-pages { background: #f5f3ff; color: #7c3aed; }
    .icon-posts { background: #fefce8; color: #ca8a04; }
    .icon-redirects { background: #ecfeff; color: #0891b2; }

    .stat-val {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.1;
    }
    .stat-lbl {
        font-size: 12.5px;
        color: var(--text-muted);
        margin-top: 4px;
    }
    .quick-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
</style>

<div class="page-title-row">
    <div>
        <h1 class="page-heading">Dashboard Overview</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Welcome to SD International Administration System.</p>
    </div>

    <div class="quick-actions">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-outline">+ Add CMS Page</a>
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline">View Inquiries @if($stats['new_inquiries'] > 0)<span class="badge badge-danger" style="margin-left: 4px;">{{ $stats['new_inquiries'] }} NEW</span>@endif</a>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline">⚙️ Site Settings</a>
    </div>
</div>

<!-- 6 Stats Cards -->
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
            <div class="stat-lbl">Categories</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-inquiries">💬</div>
        <div>
            <div class="stat-val">
                {{ number_format($stats['total_inquiries']) }}
                @if($stats['new_inquiries'] > 0)
                    <span style="font-size: 11px; background: #fee2e2; color: #991b1b; padding: 2px 6px; border-radius: 10px; vertical-align: middle; margin-left: 4px;">{{ $stats['new_inquiries'] }} New</span>
                @endif
            </div>
            <div class="stat-lbl">Export Leads</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-pages">📄</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_pages']) }}</div>
            <div class="stat-lbl">CMS Pages</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-posts">📝</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_posts']) }}</div>
            <div class="stat-lbl">Blog Articles</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-redirects">🔀</div>
        <div>
            <div class="stat-val">{{ number_format($stats['total_redirects']) }}</div>
            <div class="stat-lbl">301 Redirects</div>
        </div>
    </div>
</div>

<!-- Recent Inquiries -->
<div class="card">
    <div class="card-header">
        <span>Recent B2B Commercial Inquiries & Sample Requests</span>
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline btn-sm">View All Inquiries →</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Buyer & Contact</th>
                        <th>Company & Country</th>
                        <th>Target Product</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentInquiries as $inq)
                    <tr>
                        <td style="font-size: 12.5px; color: var(--text-muted);">
                            {{ $inq->created_at ? $inq->created_at->format('M d, Y') : '—' }}
                        </td>
                        <td>
                            <strong>{{ $inq->name }}</strong>
                            <div style="font-size: 12px; color: var(--text-muted);">{{ $inq->email }}</div>
                        </td>
                        <td>
                            <div>{{ $inq->company ?: '—' }}</div>
                            <div style="font-size: 11.5px; color: var(--text-muted);">🌐 {{ $inq->country ?: 'India' }}</div>
                        </td>
                        <td>
                            <strong style="color: var(--primary);">{{ $inq->product_name ?: ($inq->product_slug ?: 'General Inquiry') }}</strong>
                            <span class="badge badge-info" style="font-size: 10.5px; margin-left: 4px;">{{ strtoupper($inq->inquiry_type ?: 'QUOTE') }}</span>
                        </td>
                        <td>
                            @if(($inq->status ?: 'new') === 'new')
                                <span class="badge badge-danger">New</span>
                            @elseif($inq->status === 'quoted')
                                <span class="badge badge-info">Quoted</span>
                            @elseif($inq->status === 'sample_sent')
                                <span class="badge badge-warning">Sample Sent</span>
                            @elseif($inq->status === 'closed')
                                <span class="badge badge-success">Closed</span>
                            @else
                                <span class="badge badge-warning">In Progress</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.inquiries.index', ['q' => $inq->email]) }}" class="btn btn-outline btn-sm">Manage</a>
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
        <span>Chemical Products Catalog</span>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">Manage All Products →</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Title</th>
                        <th>CAS Number</th>
                        <th>C.I. Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentProducts as $p)
                    <tr>
                        <td style="width: 50px;">
                            @if($p->image_url)
                                <img src="{{ $p->image_url }}" alt="{{ $p->title }}" style="width: 38px; height: 38px; object-fit: contain; border-radius: 4px; border: 1px solid var(--border);">
                            @else
                                <span style="font-size: 20px;">📦</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $p->title }}</strong>
                            <div style="font-size: 11.5px; color: var(--text-muted);">/{{ $p->slug }}</div>
                        </td>
                        <td><code>{{ $p->cas_number ?: '—' }}</code></td>
                        <td>{{ $p->ci_number ?: '—' }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-outline btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
