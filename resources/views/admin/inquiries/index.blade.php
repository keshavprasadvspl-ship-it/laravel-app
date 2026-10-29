@extends('admin.layout')

@section('title', 'Client Inquiries & Leads')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">Customer Inquiries & Quote Requests ({{ $inquiries->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Leads received via website "Enquire Now" modals and Contact Us forms.</p>
    </div>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 12px 20px;">
        <form action="{{ route('admin.inquiries.index') }}" method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="q" value="{{ request('q') }}" class="form-input" placeholder="Search by Client Name, Email, Phone, or Product...">
            <button type="submit" class="btn btn-primary">Search</button>
            @if(request('q'))
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline">Clear</a>
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
                        <th>Date & Time</th>
                        <th>Client Details</th>
                        <th>Product Inquired</th>
                        <th>Message</th>
                        <th>IP Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inq)
                    <tr>
                        <td style="white-space: nowrap; font-size: 12.5px;">{{ $inq->created_at->format('M d, Y h:i A') }}</td>
                        <td>
                            <strong>{{ $inq->name }}</strong>
                            <div style="font-size: 12.5px;"><a href="mailto:{{ $inq->email }}">{{ $inq->email }}</a></div>
                            @if($inq->phone)
                                <div style="font-size: 12px; color: var(--text-muted);">
                                    <a href="tel:{{ $inq->phone }}">📞 {{ $inq->phone }}</a>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($inq->product_slug)
                                <a href="{{ url('/' . $inq->product_slug) }}" target="_blank" style="font-weight: 600;">{{ $inq->product_name ?: $inq->product_slug }} ↗</a>
                            @else
                                <span class="badge badge-info">{{ $inq->product_name ?: 'General Contact Inquiry' }}</span>
                            @endif
                        </td>
                        <td style="max-width: 320px; font-size: 13px;">
                            {{ $inq->message ?: '—' }}
                        </td>
                        <td><code style="font-size: 11px;">{{ $inq->ip_address ?: '—' }}</code></td>
                        <td style="white-space: nowrap;">
                            <a href="mailto:{{ $inq->email }}?subject=Inquiry%20Response%20-%20SD%20International&body=Dear%20{{ urlencode($inq->name) }},%0D%0A%0D%0AThank%20you%20for%20contacting%20SD%20International." class="btn btn-primary btn-sm">Email Reply</a>
                            @if($inq->phone)
                                <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $inq->phone) }}&text=Hello%20{{ urlencode($inq->name) }},%20this%20is%20SD%20International%20regarding%20your%20inquiry." target="_blank" class="btn btn-sm" style="background: #25d366; color: white;">WhatsApp</a>
                            @endif
                            <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Delete this inquiry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-muted);">No inquiries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="margin-top: 15px; display: flex; justify-content: center;">
    {{ $inquiries->links() }}
</div>
@endsection
