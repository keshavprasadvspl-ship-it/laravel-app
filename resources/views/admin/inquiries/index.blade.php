@extends('admin.layout')

@section('title', 'Export Leads & Inquiries')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Commercial & Quote Inquiries ({{ $inquiries->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Manage global B2B buyer inquiries, sample requests, and technical data sheet downloads.</p>
    </div>

    <div>
        <a href="{{ route('admin.inquiries.export', request()->all()) }}" class="btn btn-outline" style="background: white; border-color: #cbd5e1;">
            📥 Download CSV Report
        </a>
    </div>
</div>

<!-- Status Tabs -->
<div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
    <a href="{{ route('admin.inquiries.index') }}" class="btn {{ !request('status') || request('status') === 'all' ? 'btn-primary' : 'btn-outline' }}" style="padding: 6px 14px; font-size: 13px;">
        All ({{ $statusCounts['all'] }})
    </a>
    <a href="{{ route('admin.inquiries.index', array_merge(request()->except('page'), ['status' => 'new'])) }}" class="btn {{ request('status') === 'new' ? 'btn-primary' : 'btn-outline' }}" style="padding: 6px 14px; font-size: 13px;">
        🔴 New ({{ $statusCounts['new'] }})
    </a>
    <a href="{{ route('admin.inquiries.index', array_merge(request()->except('page'), ['status' => 'in_progress'])) }}" class="btn {{ request('status') === 'in_progress' ? 'btn-primary' : 'btn-outline' }}" style="padding: 6px 14px; font-size: 13px;">
        🟡 In Progress ({{ $statusCounts['in_progress'] }})
    </a>
    <a href="{{ route('admin.inquiries.index', array_merge(request()->except('page'), ['status' => 'quoted'])) }}" class="btn {{ request('status') === 'quoted' ? 'btn-primary' : 'btn-outline' }}" style="padding: 6px 14px; font-size: 13px;">
        🔵 Quoted ({{ $statusCounts['quoted'] }})
    </a>
    <a href="{{ route('admin.inquiries.index', array_merge(request()->except('page'), ['status' => 'sample_sent'])) }}" class="btn {{ request('status') === 'sample_sent' ? 'btn-primary' : 'btn-outline' }}" style="padding: 6px 14px; font-size: 13px;">
        🟣 Sample Dispatched ({{ $statusCounts['sample_sent'] }})
    </a>
    <a href="{{ route('admin.inquiries.index', array_merge(request()->except('page'), ['status' => 'closed'])) }}" class="btn {{ request('status') === 'closed' ? 'btn-primary' : 'btn-outline' }}" style="padding: 6px 14px; font-size: 13px;">
        🟢 Closed ({{ $statusCounts['closed'] }})
    </a>
</div>

<!-- Filter Box -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 15px 20px;">
        <form action="{{ route('admin.inquiries.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <input type="text" name="q" value="{{ request('q') }}" class="form-input" placeholder="Search by name, email, phone, company, country, or product..." style="flex: 1; min-width: 280px;">

            <select name="type" class="form-select" style="width: 220px;">
                <option value="">-- All Inquiry Types --</option>
                <option value="quote" {{ request('type') == 'quote' ? 'selected' : '' }}>Bulk Price Quotation</option>
                <option value="sample" {{ request('type') == 'sample' ? 'selected' : '' }}>Lab Sample Request</option>
                <option value="tds" {{ request('type') == 'tds' ? 'selected' : '' }}>Technical Data Sheet</option>
                <option value="msds" {{ request('type') == 'msds' ? 'selected' : '' }}>MSDS / Safety Sheet</option>
                <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>General Inquiry</option>
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request('q') || request('type'))
                <a href="{{ route('admin.inquiries.index', request('status') ? ['status' => request('status')] : []) }}" class="btn btn-outline">Clear</a>
            @endif
        </form>
    </div>
</div>

<!-- Inquiries Table -->
<div class="card">
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Buyer & Contact</th>
                        <th>Company & Country</th>
                        <th>Product & Purpose</th>
                        <th style="width: 140px;">Status</th>
                        <th style="width: 120px;">Date</th>
                        <th style="text-align: right; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inq)
                    <tr>
                        <td><strong>#{{ $inq->id }}</strong></td>
                        <td>
                            <strong style="color: #0f172a; font-size: 14px;">{{ $inq->name }}</strong>
                            <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">
                                <a href="mailto:{{ $inq->email }}" style="color: var(--accent); text-decoration: none;">{{ $inq->email }}</a>
                            </div>
                            @if($inq->phone)
                                <div style="font-size: 11.5px; color: #475569; margin-top: 2px;">
                                    📞 <a href="tel:{{ $inq->phone }}" style="color: inherit; text-decoration: none;">{{ $inq->phone }}</a>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;">{{ $inq->company ?: '—' }}</div>
                            <div style="font-size: 12px; color: var(--text-muted);">
                                🌐 {{ $inq->country ?: 'India' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--primary);">
                                {{ $inq->product_name ?: ($inq->product_slug ?: 'General Inquiry') }}
                            </div>
                            <span class="badge badge-info" style="font-size: 11px; margin-top: 4px;">
                                {{ strtoupper($inq->inquiry_type ?: 'QUOTE') }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.inquiries.update_status', $inq) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="form-select" style="padding: 4px 8px; font-size: 12px; border-radius: 4px; font-weight: 600;
                                    @if($inq->status === 'new') background: #fee2e2; color: #991b1b;
                                    @elseif($inq->status === 'in_progress') background: #fef3c7; color: #92400e;
                                    @elseif($inq->status === 'quoted') background: #dbeafe; color: #1e40af;
                                    @elseif($inq->status === 'sample_sent') background: #f3e8ff; color: #6b21a8;
                                    @elseif($inq->status === 'closed') background: #dcfce7; color: #166534;
                                    @endif">
                                    <option value="new" {{ ($inq->status ?: 'new') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="in_progress" {{ $inq->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="quoted" {{ $inq->status == 'quoted' ? 'selected' : '' }}>Quoted</option>
                                    <option value="sample_sent" {{ $inq->status == 'sample_sent' ? 'selected' : '' }}>Sample Sent</option>
                                    <option value="closed" {{ $inq->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        </td>
                        <td style="color: var(--text-muted); font-size: 12.5px;">
                            {{ $inq->created_at ? $inq->created_at->format('M d, Y') : '—' }}
                            <div style="font-size: 11px;">{{ $inq->created_at ? $inq->created_at->format('H:i') : '' }}</div>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; justify-content: flex-end; gap: 6px;">
                                <button type="button" class="btn btn-outline" style="padding: 5px 9px; font-size: 12px;" onclick="viewInquiry({{ json_encode($inq) }})">View</button>

                                <form action="{{ route('admin.inquiries.destroy', $inq) }}" method="POST" onsubmit="return confirm('Delete inquiry from {{ addslashes($inq->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 9px; font-size: 12px;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-muted);">
                            No inquiries found matching criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
        <div style="padding: 20px; border-top: 1px solid var(--border);">
            {{ $inquiries->links() }}
        </div>
        @endif
    </div>
</div>

<!-- View Inquiry Modal -->
<div id="viewModal" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 10px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
        <div style="padding: 20px 25px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 17px; font-weight: 700; color: #0f172a;" id="modalTitle">Inquiry Details</h3>
            <button type="button" onclick="closeViewModal()" style="border: none; background: none; font-size: 22px; cursor: pointer; color: #94a3b8;">&times;</button>
        </div>
        <div style="padding: 25px;" id="modalBody">
            <!-- Dynamic content injected by JS -->
        </div>
        <div style="padding: 16px 25px; background: #f8fafc; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeViewModal()" class="btn btn-outline">Close</button>
            <a href="#" id="modalEmailBtn" class="btn btn-primary">Reply by Email ✉</a>
        </div>
    </div>
</div>

<script>
    function viewInquiry(inq) {
        document.getElementById('modalTitle').innerText = 'Inquiry #' + inq.id + ' — ' + inq.name;
        document.getElementById('modalEmailBtn').href = 'mailto:' + inq.email + '?subject=' + encodeURIComponent('SD International: Quotation Inquiry regarding ' + (inq.product_name || 'Chemicals'));

        let html = `
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; font-size: 13.5px;">
                <div>
                    <span style="color: #64748b; font-size: 12px; display: block;">Full Name</span>
                    <strong>${inq.name}</strong>
                </div>
                <div>
                    <span style="color: #64748b; font-size: 12px; display: block;">Corporate Email</span>
                    <a href="mailto:${inq.email}" style="color: var(--accent);">${inq.email}</a>
                </div>
                <div>
                    <span style="color: #64748b; font-size: 12px; display: block;">Phone / WhatsApp</span>
                    <strong>${inq.phone || '—'}</strong>
                </div>
                <div>
                    <span style="color: #64748b; font-size: 12px; display: block;">Company / Enterprise</span>
                    <strong>${inq.company || '—'}</strong>
                </div>
                <div>
                    <span style="color: #64748b; font-size: 12px; display: block;">Country / Destination</span>
                    <strong>${inq.country || '—'}</strong>
                </div>
                <div>
                    <span style="color: #64748b; font-size: 12px; display: block;">Inquiry Purpose</span>
                    <span class="badge badge-info">${(inq.inquiry_type || 'QUOTE').toUpperCase()}</span>
                </div>
            </div>

            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 20px;">
                <span style="color: #64748b; font-size: 12px; display: block; margin-bottom: 4px;">Target Chemical Product</span>
                <strong style="color: var(--primary); font-size: 15px;">${inq.product_name || inq.product_slug || 'General Catalog Inquiry'}</strong>
            </div>

            <div style="margin-bottom: 20px;">
                <span style="color: #64748b; font-size: 12px; display: block; margin-bottom: 6px;">Message / Specifications</span>
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 15px; font-size: 14px; line-height: 1.6; white-space: pre-wrap; color: #1e293b;">${inq.message || 'No additional message supplied.'}</div>
            </div>

            <div style="display: flex; gap: 20px; font-size: 12px; color: #64748b; border-top: 1px solid #f1f5f9; padding-top: 12px;">
                <div>Submitted: <strong>${inq.created_at || '—'}</strong></div>
                <div>Client IP: <code>${inq.ip_address || '—'}</code></div>
                <div>Status: <strong>${(inq.status || 'new').toUpperCase()}</strong></div>
            </div>
        `;

        document.getElementById('modalBody').innerHTML = html;
        document.getElementById('viewModal').style.display = 'flex';
    }

    function closeViewModal() {
        document.getElementById('viewModal').style.display = 'none';
    }
</script>
@endsection
