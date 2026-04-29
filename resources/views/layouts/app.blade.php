<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZRC Fire Alarm - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            min-height: 100vh;
            background: #1a1a2e;
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 0;
            z-index: 100;
        }
        .sidebar-brand {
            background: #c0392b;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .3px;
        }
        .sidebar-brand .icon { font-size: 22px; }
        .sidebar-brand small { font-size: 11px; font-weight: 400; opacity: .8; display: block; }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 10px 20px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 0;
            transition: background .15s, color .15s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: #c0392b22;
            color: #fff;
            border-left: 3px solid #c0392b;
        }
        .sidebar .nav-section {
            font-size: 10px;
            color: #555e6e;
            padding: 14px 20px 4px;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-weight: 600;
        }
        .main-content {
            margin-left: 240px;
            padding: 0;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar h5 { margin: 0; font-weight: 600; font-size: 17px; color: #1a1a2e; }
        .content-area { padding: 24px 28px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.07); }
        .card-header { background: #fff; border-bottom: 1px solid #f0f0f0; padding: 16px 20px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 0 0 !important; }
        .btn-danger { background: #c0392b; border-color: #c0392b; }
        .btn-danger:hover { background: #a93226; border-color: #a93226; }
        .badge-status { font-size: 11px; padding: 4px 10px; border-radius: 20px; }
        .table th { font-size: 12px; text-transform: uppercase; letter-spacing: .05em; color: #6c757d; font-weight: 600; border-top: none; }
        .table td { font-size: 13.5px; vertical-align: middle; }
        .alert { border-radius: 8px; font-size: 13.5px; }
        .form-label { font-size: 13px; font-weight: 500; color: #444; }
        .form-control, .form-select { font-size: 13.5px; border-radius: 7px; }
        .btn { font-size: 13.5px; border-radius: 7px; }
        .page-title { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
        .page-subtitle { font-size: 13px; color: #6c757d; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <span class="icon"><i class="bi bi-fire"></i></span>
        <div>
            ZRC Fire Alarm
            <small>Retailing System</small>
        </div>
    </div>
    <div class="nav-section">Main</div>
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section">Management</div>
    <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Clients
    </a>
    <a href="{{ route('quotations.index') }}" class="nav-link {{ request()->routeIs('quotations.*') ? 'active' : '' }}">
        <i class="bi bi-file-text"></i> Quotations
    </a>
    <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
        <i class="bi bi-folder2-open"></i> Projects
    </a>
    <a href="{{ route('billing.index') }}" class="nav-link {{ request()->routeIs('billing.*') ? 'active' : '' }}">
        <i class="bi bi-receipt"></i> Billing
    </a>
    <div class="nav-section">Inventory</div>
    <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
        <i class="bi bi-truck"></i> Suppliers
    </a>
    <a href="{{ route('materials.index') }}" class="nav-link {{ request()->routeIs('materials.*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Materials
    </a>
    <a href="{{ route('project-materials.index') }}" class="nav-link {{ request()->routeIs('project-materials.*') ? 'active' : '' }}">
        <i class="bi bi-layers"></i> Project Materials
    </a>
    <div class="nav-section">Manpower</div>
    <a href="{{ route('emp-agency.index') }}" class="nav-link {{ request()->routeIs('emp-agency.*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Emp. Agency
    </a>
</div>
<div class="main-content">
    <div class="topbar">
        <h5>@yield('title', 'Dashboard')</h5>
        <span style="font-size:13px; color:#6c757d;"><i class="bi bi-fire text-danger"></i> ZRC Fire Alarm Retailing System</span>
    </div>
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
