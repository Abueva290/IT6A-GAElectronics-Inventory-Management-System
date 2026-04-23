<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GJ Electronics - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #2d3748;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
        }
        .sidebar .brand {
            padding: 20px;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            border-bottom: 1px solid #4a5568;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #a0aec0;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #4a5568;
            color: white;
        }
        .sidebar a i { margin-right: 10px; }
        .sidebar .nav-section {
            padding: 8px 20px 4px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
        }
        .main-content { margin-left: 250px; padding: 30px; }
        .topbar {
            background: white;
            padding: 15px 30px;
            margin-left: 250px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="fa fa-shield-halved" style="color:#63b3ed"></i> GJ Electronics
    </div>
    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa fa-gauge-high"></i> Dashboard
        </a>

        <div class="nav-section">Catalog</div>
        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="fa fa-tags"></i> Categories
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fa fa-box"></i> Products
        </a>
        <a href="{{ route('inventory.index') }}" class="{{ request()->routeIs('inventory.*') ? 'active' : '' }}">
            <i class="fa fa-warehouse"></i> Inventory
        </a>

        <div class="nav-section">Partners</div>
        <a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
            <i class="fa fa-truck"></i> Suppliers
        </a>
        <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="fa fa-users"></i> Customers
        </a>

        <div class="nav-section">Transactions</div>
        <a href="{{ route('sales.index') }}" class="{{ request()->routeIs('sales.*') ? 'active' : '' }}">
            <i class="fa fa-cart-shopping"></i> Sales
        </a>
        <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="fa fa-chart-bar"></i> Reports
        </a>
    </div>

    <div style="position:absolute; bottom:0; width:100%; border-top:1px solid #4a5568; padding:15px">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:#a0aec0; cursor:pointer;">
                <i class="fa fa-arrow-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="topbar">
    <h6 class="mb-0 fw-bold">@yield('title')</h6>
    <span class="badge bg-primary">{{ auth()->user()->name }}</span>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>