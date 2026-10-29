@extends('admin.layout')
@section('title', 'Git Deployment')

@push('styles')
<style>
    .deploy-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid var(--border);
        font-size: 13.5px;
        gap: 12px;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: var(--text-muted); font-weight: 600; white-space: nowrap; min-width: 110px; }
    .info-value { color: #1e293b; font-family: monospace; font-size: 13px; word-break: break-all; text-align: right; }
    .branch-badge {
        background: #dcfce7; color: #166534;
        padding: 2px 10px; border-radius: 20px;
        font-size: 12px; font-weight: 700; font-family: monospace;
    }
    .sha-pill {
        background: #f1f5f9; color: #334155;
        padding: 2px 10px; border-radius: 4px;
        font-size: 12px; font-family: monospace;
    }
    .remote-link { color: var(--primary); word-break: break-all; }

    /* Deploy button */
    .btn-deploy {
        background: #64141f;
        color: #ffffff;
        padding: 12px 32px;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(100,20,31,0.25);
    }
    .btn-deploy:hover { background: #4e0f18; transform: translateY(-1px); }
    .btn-deploy:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

    .btn-cache {
        background: #0ea5e9;
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 6px;
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    .btn-cache:hover { background: #0284c7; }

    /* Step results */
    .step-list { display: flex; flex-direction: column; gap: 10px; }
    .step-item {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid var(--border);
    }
    .step-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        font-weight: 600;
        font-size: 13.5px;
    }
    .step-ok   { background: #f0fdf4; color: #166534; }
    .step-fail { background: #fef2f2; color: #991b1b; }
    .step-body {
        padding: 10px 14px;
        background: #0f172a;
        color: #94a3b8;
        font-family: monospace;
        font-size: 12px;
        white-space: pre-wrap;
        word-break: break-all;
        max-height: 180px;
        overflow-y: auto;
    }

    /* Deploy log terminal */
    .deploy-log {
        background: #0f172a;
        color: #94a3b8;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        padding: 16px;
        border-radius: 8px;
        max-height: 400px;
        overflow-y: auto;
        white-space: pre-wrap;
        word-break: break-word;
        line-height: 1.6;
    }
    .deploy-log:empty::after { content: 'No deploy log yet.'; opacity: 0.4; }

    /* Webhook section */
    .webhook-url-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 12px 16px;
        font-family: monospace;
        font-size: 13px;
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        word-break: break-all;
    }
    .btn-copy {
        background: var(--primary);
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .status-dot {
        width: 10px; height: 10px; border-radius: 50%;
        display: inline-block; margin-right: 6px;
    }
    .dot-green { background: #22c55e; box-shadow: 0 0 6px #22c55e; }
    .dot-yellow { background: #f59e0b; }
    .dot-red { background: #ef4444; }

    .git-status-box {
        background: #0f172a;
        color: #a3e635;
        font-family: monospace;
        font-size: 12px;
        padding: 12px 16px;
        border-radius: 6px;
        white-space: pre-wrap;
        min-height: 48px;
    }
    .git-status-box.clean { color: #22c55e; }
    .git-status-box.dirty { color: #fb923c; }

    @media (max-width: 900px) {
        .deploy-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="page-title-row">
    <h1 class="page-heading">🚀 Git Deployment</h1>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <form action="{{ route('admin.deploy.cache') }}" method="POST">
            @csrf
            <button type="submit" class="btn-cache" onclick="return confirm('Clear all caches?')">
                🗑️ Clear All Caches
            </button>
        </form>
        <a href="{{ route('admin.deploy.index') }}" class="btn" style="background:#f1f5f9; color:#334155; border:1px solid var(--border);">
            🔄 Refresh
        </a>
    </div>
</div>

{{-- ─── Flash Messages ─────────────────────────────────────────────────── --}}
@if(session('deploy_success'))
<div class="alert alert-success" style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; padding:14px 18px; border-radius:8px; margin-bottom:20px; font-weight:600;">
    ✅ Deployment completed successfully in {{ session('deploy_time') }}s!
</div>
@endif

@if(session('deploy_error'))
<div class="alert" style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; padding:14px 18px; border-radius:8px; margin-bottom:20px; font-weight:600;">
    ❌ Deployment failed: {{ session('deploy_error') }}
</div>
@endif

@if(session('cache_cleared'))
<div class="alert" style="background:#eff6ff; border:1px solid #bfdbfe; color:#1e40af; padding:14px 18px; border-radius:8px; margin-bottom:20px; font-weight:600;">
    🗑️ All caches cleared successfully!
</div>
@endif

{{-- ─── Step Output ─────────────────────────────────────────────────────── --}}
@if(session('deploy_output') || session('cache_output'))
@php $steps = session('deploy_output') ?? session('cache_output') ?? []; @endphp
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">📋 Deploy Steps Output</div>
    <div class="card-body">
        <div class="step-list">
            @foreach($steps as $step)
            <div class="step-item">
                <div class="step-header {{ $step['ok'] ? 'step-ok' : 'step-fail' }}">
                    {{ $step['ok'] ? '✅' : '❌' }} {{ $step['step'] }}
                </div>
                @if(!empty($step['result']))
                <div class="step-body">{{ $step['result'] }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ─── Top Grid: Git Info + Deploy Action ─────────────────────────────── --}}
<div class="deploy-grid">

    {{-- Git Repository Info --}}
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            📂 Repository Info
            <span style="font-size:12px; font-weight:400; color:var(--text-muted);">Current HEAD state</span>
        </div>
        <div class="card-body">
            @if(isset($gitInfo['error']))
                <div style="color:#991b1b; font-size:13px;">⚠️ Git error: {{ $gitInfo['error'] }}</div>
            @else
            <div class="info-row">
                <span class="info-label">Branch</span>
                <span><span class="branch-badge">{{ $gitInfo['branch'] ?? 'unknown' }}</span></span>
            </div>
            <div class="info-row">
                <span class="info-label">Commit</span>
                <span class="sha-pill">{{ $gitInfo['shortSha'] ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Message</span>
                <span class="info-value" style="font-family:inherit; font-size:13px;">{{ $gitInfo['message'] ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Author</span>
                <span class="info-value">{{ $gitInfo['author'] ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date</span>
                <span class="info-value">{{ $gitInfo['date'] ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Remote</span>
                <span class="remote-link" style="font-size:12px; text-align:right;">{{ $gitInfo['remote'] ?? 'Not set' }}</span>
            </div>
            <div style="margin-top:14px;">
                <div style="font-size:12px; font-weight:600; color:var(--text-muted); margin-bottom:6px;">Working Tree Status</div>
                <div class="git-status-box {{ empty($gitInfo['status']) ? 'clean' : 'dirty' }}">{{ empty($gitInfo['status']) ? '✓ Working tree clean — nothing to commit.' : $gitInfo['status'] }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- Deploy Action --}}
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            🚀 Deploy to Production
            <span class="status-dot dot-green"></span>
        </div>
        <div class="card-body">
            <p style="font-size:13.5px; color:var(--text-muted); margin-bottom:20px; line-height:1.6;">
                Clicking <strong>Deploy Now</strong> will pull the latest code from the remote repository and run all post-deploy tasks:
            </p>
            <ol style="font-size:13px; color:#334155; margin-left:20px; line-height:2; margin-bottom:22px;">
                <li>🔄 <strong>git pull</strong> — Fetch &amp; merge latest commits</li>
                <li>📦 <strong>composer install</strong> — Install PHP dependencies</li>
                <li>⚙️ <strong>config:cache</strong> — Cache configuration</li>
                <li>🛣️ <strong>route:cache</strong> — Cache routes</li>
                <li>🎨 <strong>view:cache</strong> — Compile Blade views</li>
                <li>🗄️ <strong>migrate --force</strong> — Run pending migrations</li>
                <li>🔗 <strong>storage:link</strong> — Create storage symlink</li>
            </ol>

            <form action="{{ route('admin.deploy.run') }}" method="POST" id="deployForm">
                @csrf
                <button type="submit" class="btn-deploy" id="deployBtn"
                    onclick="return confirmDeploy()">
                    🚀 Deploy Now
                </button>
            </form>

            <div id="deploySpinner" style="display:none; margin-top:16px; align-items:center; gap:10px; color:#64141f; font-weight:600;">
                <svg style="animation:spin 1s linear infinite; width:20px; height:20px;" fill="none" viewBox="0 0 24 24">
                    <circle style="opacity:.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path style="opacity:.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Deploying... please wait, do not close this page.
            </div>

            <div style="margin-top:18px; padding:12px 14px; background:#fefce8; border:1px solid #fde68a; border-radius:6px; font-size:12.5px; color:#92400e;">
                ⚠️ <strong>Warning:</strong> This will modify live server files. Ensure your remote has the correct code before deploying.
            </div>
        </div>
    </div>
</div>

{{-- ─── Webhook Setup ───────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">🔗 GitHub / GitLab Auto-Deploy Webhook</div>
    <div class="card-body">
        <p style="font-size:13.5px; color:var(--text-muted); margin-bottom:16px; line-height:1.6;">
            Configure this URL as a webhook in your GitHub/GitLab repository to automatically deploy on every push to <strong>main</strong> or <strong>master</strong>.
        </p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;" class="deploy-grid">
            <div>
                <label style="font-size:12px; font-weight:600; color:var(--text-muted); display:block; margin-bottom:6px;">Payload URL</label>
                <div class="webhook-url-box">
                    <span id="webhookUrl">{{ url('/webhook/git-deploy') }}</span>
                    <button class="btn-copy" onclick="copyWebhook()">📋 Copy</button>
                </div>
            </div>
            <div>
                <label style="font-size:12px; font-weight:600; color:var(--text-muted); display:block; margin-bottom:6px;">Secret Token (set in .env)</label>
                <div class="webhook-url-box">
                    <code>DEPLOY_WEBHOOK_SECRET=your_secret_here</code>
                </div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;" class="deploy-grid">
            <div style="padding:14px; background:#f8fafc; border-radius:6px; border:1px solid var(--border);">
                <div style="font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:8px;">GITHUB STEPS</div>
                <ol style="font-size:12.5px; color:#334155; margin-left:16px; line-height:1.8;">
                    <li>Go to Repo → Settings → Webhooks</li>
                    <li>Click <strong>Add webhook</strong></li>
                    <li>Paste the Payload URL above</li>
                    <li>Content type: <code>application/json</code></li>
                    <li>Add your secret from .env</li>
                    <li>Select <strong>Just the push event</strong></li>
                    <li>Click <strong>Add webhook</strong> ✓</li>
                </ol>
            </div>
            <div style="padding:14px; background:#f8fafc; border-radius:6px; border:1px solid var(--border);">
                <div style="font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:8px;">GITLAB STEPS</div>
                <ol style="font-size:12.5px; color:#334155; margin-left:16px; line-height:1.8;">
                    <li>Go to Repo → Settings → Webhooks</li>
                    <li>Paste the URL above</li>
                    <li>Add Secret token</li>
                    <li>Check <strong>Push events</strong></li>
                    <li>Uncheck SSL verification if needed</li>
                    <li>Click <strong>Add webhook</strong> ✓</li>
                </ol>
            </div>
            <div style="padding:14px; background:#f8fafc; border-radius:6px; border:1px solid var(--border);">
                <div style="font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:8px;">ENV CONFIGURATION</div>
                <div style="font-size:12px; color:#334155; line-height:1.8;">
                    <p>Add to your <code>.env</code> file on the server:</p>
                    <pre style="background:#0f172a; color:#a3e635; padding:10px; border-radius:4px; margin-top:8px; font-size:11px; white-space:pre-wrap;">DEPLOY_WEBHOOK_SECRET=make_this_random_long_string

# Optional: set git remote
GIT_REMOTE=origin</pre>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ─── Deploy Log ──────────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">
        📄 Deploy Log
        <form action="{{ route('admin.deploy.clear_log') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn" style="font-size:12px; padding:5px 12px; background:#fef2f2; color:#991b1b; border:1px solid #fecaca; cursor:pointer;"
               onclick="return confirm('Clear the deploy log?')">
                🗑️ Clear Log
            </button>
        </form>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="deploy-log" id="deployLog">{{ $deployLog ?: 'No deploy history yet. Deploy log will appear here after your first deployment.' }}</div>
    </div>
</div>

@endsection

@push('scripts')
<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
<script>
function confirmDeploy() {
    if (!confirm('⚠️ Are you sure you want to deploy?\n\nThis will run git pull and restart caches on the live server.')) return false;
    document.getElementById('deployBtn').disabled = true;
    document.getElementById('deployBtn').innerHTML = '⏳ Deploying...';
    document.getElementById('deploySpinner').style.display = 'flex';
    return true;
}

function copyWebhook() {
    const url = document.getElementById('webhookUrl').textContent;
    navigator.clipboard.writeText(url).then(() => {
        const btn = event.target;
        btn.textContent = '✅ Copied!';
        setTimeout(() => btn.textContent = '📋 Copy', 2000);
    });
}

// Auto-scroll deploy log to bottom
const log = document.getElementById('deployLog');
if (log) log.scrollTop = log.scrollHeight;
</script>
@endpush
