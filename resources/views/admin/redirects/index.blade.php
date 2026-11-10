@extends('admin.layout')

@section('title', 'Manage 301/302 URL Redirects')

@section('content')
<div class="page-title-row">
    <div>
        <h1 class="page-heading">SEO URL Redirects ({{ $redirects->total() }})</h1>
        <p style="color: var(--text-muted); font-size: 13.5px; margin-top: 4px;">Manage 301 permanent and 302 temporary redirects to preserve SEO rankings and prevent 404s.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 340px; gap: 25px; align-items: start;">
    <!-- Redirects Table -->
    <div>
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-body" style="padding: 15px 20px;">
                <form action="{{ route('admin.redirects.index') }}" method="GET" style="display: flex; gap: 12px;">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-input" placeholder="Search by source path or destination URL..." style="flex: 1;">
                    <button type="submit" class="btn btn-primary">Search</button>
                    @if(request('q'))
                        <a href="{{ route('admin.redirects.index') }}" class="btn btn-outline">Clear</a>
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
                                <th>Source Path Pattern</th>
                                <th>Target Destination</th>
                                <th style="width: 90px;">Status</th>
                                <th style="text-align: right; width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($redirects as $r)
                            <tr>
                                <td>
                                    <code>/{{ $r->source_pattern }}</code>
                                    <a href="{{ url('/' . $r->source_pattern) }}" target="_blank" style="margin-left: 6px; font-size: 11.5px; text-decoration: none; color: var(--accent);" title="Test in browser">↗ Test</a>
                                </td>
                                <td>
                                    <strong style="color: #0f172a;">{{ $r->destination_url }}</strong>
                                </td>
                                <td>
                                    @if($r->status_code == 301)
                                        <span class="badge badge-success">301 Perm</span>
                                    @else
                                        <span class="badge badge-warning">302 Temp</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: flex; justify-content: flex-end; gap: 6px;">
                                        <button type="button" class="btn btn-outline" style="padding: 5px 9px; font-size: 12px;" onclick="openEditModal({{ $r->id }}, '{{ addslashes($r->source_pattern) }}', '{{ addslashes($r->destination_url) }}', {{ $r->status_code }})">Edit</button>

                                        <form action="{{ route('admin.redirects.destroy', $r) }}" method="POST" onsubmit="return confirm('Delete redirect for /{{ addslashes($r->source_pattern) }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 5px 9px; font-size: 12px;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    No redirect rules found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($redirects->hasPages())
                <div style="padding: 20px; border-top: 1px solid var(--border);">
                    {{ $redirects->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Redirect Card -->
    <div>
        <div class="card">
            <div class="card-header">+ Add New Redirect Rule</div>
            <div class="card-body">
                <form action="{{ route('admin.redirects.store') }}" method="POST">
                    @csrf

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Source URL / Path *</label>
                        <input type="text" name="source_pattern" class="form-input" placeholder="e.g. old-product-path" required>
                        <span style="font-size: 11.5px; color: var(--text-muted); display: block; margin-top: 4px;">Relative to site root (without leading slash).</span>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label class="form-label">Destination URL *</label>
                        <input type="text" name="destination_url" class="form-input" placeholder="e.g. /vat-dyes/ or https://..." required>
                    </div>

                    <div class="form-group" style="margin-bottom: 22px;">
                        <label class="form-label">HTTP Redirect Type</label>
                        <select name="status_code" class="form-select">
                            <option value="301" selected>301 Permanent (SEO Recommended)</option>
                            <option value="302">302 Temporary (Short-term maintenance)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 11px;">Create Redirect Rule</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Redirect Modal -->
<div id="editRedirectModal" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 10px; width: 100%; max-width: 500px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
        <div style="padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 16px; font-weight: 700;">Edit Redirect Rule</h3>
            <button type="button" onclick="closeEditModal()" style="border: none; background: none; font-size: 20px; cursor: pointer; color: #94a3b8;">&times;</button>
        </div>
        <form id="editRedirectForm" method="POST">
            @csrf
            @method('PUT')
            <div style="padding: 24px;">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label">Source URL / Path *</label>
                    <input type="text" name="source_pattern" id="edit_source_pattern" class="form-input" required>
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label">Destination URL *</label>
                    <input type="text" name="destination_url" id="edit_destination_url" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">HTTP Redirect Type</label>
                    <select name="status_code" id="edit_status_code" class="form-select">
                        <option value="301">301 Permanent (SEO Recommended)</option>
                        <option value="302">302 Temporary</option>
                    </select>
                </div>
            </div>
            <div style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeEditModal()" class="btn btn-outline">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Rule</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, source, destination, status) {
        document.getElementById('edit_source_pattern').value = source;
        document.getElementById('edit_destination_url').value = destination;
        document.getElementById('edit_status_code').value = status;
        document.getElementById('editRedirectForm').action = "{{ url('/admin/redirects') }}/" + id;
        const modal = document.getElementById('editRedirectModal');
        modal.style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editRedirectModal').style.display = 'none';
    }
</script>
@endsection
