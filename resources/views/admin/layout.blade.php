<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | SD International Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --primary: #64141f;
            --primary-hover: #4e0f18;
            --accent: #2563eb;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-page: #f8fafc;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-page);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }
        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: #cbd5e1;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-brand img {
            max-height: 34px;
            filter: brightness(0) invert(1);
        }
        .sidebar-brand-text {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .sidebar-nav {
            list-style: none;
            padding: 16px 10px;
            flex: 1;
        }
        .nav-heading {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            padding: 12px 14px 6px;
            font-weight: 600;
        }
        .sidebar-item {
            margin-bottom: 4px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.15s ease;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: var(--sidebar-hover);
            color: #ffffff;
        }
        .sidebar-link.active {
            background: var(--primary);
            color: #ffffff;
        }
        /* Main Wrap */
        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        .admin-topbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 14px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .btn-live-site {
            background: #f1f5f9;
            color: #334155;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--border);
        }
        .btn-live-site:hover {
            background: #e2e8f0;
        }
        .admin-user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #1e293b;
        }
        .admin-avatar {
            width: 34px;
            height: 34px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }
        .content-area {
            padding: 30px;
            flex: 1;
        }
        .page-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .page-heading {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
        }
        /* Common Cards and Tables */
        .card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            overflow: hidden;
            margin-bottom: 25px;
        }
        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-body {
            padding: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }
        .admin-table th {
            background: #f8fafc;
            padding: 12px 16px;
            font-weight: 600;
            color: #475569;
            border-bottom: 1px solid var(--border);
        }
        .admin-table td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            color: #334155;
            vertical-align: middle;
        }
        .admin-table tr:hover td {
            background: #fdf2f3;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.15s ease;
        }
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        .btn-primary:hover {
            background: var(--primary-hover);
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-outline {
            background: white;
            border: 1px solid var(--border);
            color: #334155;
        }
        .btn-outline:hover {
            background: #f1f5f9;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
            font-size: 13.5px;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(100,20,31,0.1);
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11.5px;
            font-weight: 600;
            border-radius: 4px;
        }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #e0f2fe; color: #075985; }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('uploads/2020/07/logo.png') }}" alt="SD International">
            <span class="sidebar-brand-text">Admin Panel</span>
        </div>

        <ul class="sidebar-nav">
            <li class="nav-heading">Main</li>
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>📊 Dashboard</span>
                </a>
            </li>

            <li class="nav-heading">Catalog & Products</li>
            <li class="sidebar-item">
                <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span>📦 Products (628)</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span>🏷️ Categories (1,002)</span>
                </a>
            </li>

            <li class="nav-heading">Leads & Inquiries</li>
            <li class="sidebar-item">
                <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                    <span>💬 Quote Inquiries</span>
                </a>
            </li>

            <li class="nav-heading">Content & SEO</li>
            <li class="sidebar-item">
                <a href="{{ route('admin.posts.index') }}" class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <span>📝 Blog Articles (66)</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ url('/sitemap.xml') }}" target="_blank" class="sidebar-link">
                    <span>🗺️ XML Sitemaps ↗</span>
                </a>
            </li>

            <li class="nav-heading">System & Server</li>
            <li class="sidebar-item">
                <a href="{{ route('admin.deploy.index') }}" class="sidebar-link {{ request()->routeIs('admin.deploy.*') ? 'active' : '' }}">
                    <span>🚀 Git Deployment</span>
                </a>
            </li>

            <li class="nav-heading">Account</li>
            <li class="sidebar-item">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                        <span>🚪 Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <header class="admin-topbar">
            <div>
                <span style="font-weight: 600; color: #475569;">SD International Management System</span>
            </div>
            <div class="topbar-right">
                <a href="{{ url('/') }}" target="_blank" class="btn-live-site">
                    <span>🌐 View Live Website ↗</span>
                </a>
                <div class="admin-user-pill">
                    <div class="admin-avatar">A</div>
                    <span>{{ Auth::user()->name ?? 'Administrator' }}</span>
                </div>
            </div>
        </header>

        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    ✕ {{ session('error') }}
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
