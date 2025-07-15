<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - RUN Complaint Management System</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('assets/RUN_WhiteLogo.png') }}" alt="Redeemer's Uni Logo" style="height: 48px;">
            </div>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.complaint-management') }}" class="menu-item{{ request()->routeIs('admin.complaint-management') ? ' active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span>Complaint Management</span>
            </a>
            <a href="{{ route('admin.users') }}" class="menu-item{{ request()->routeIs('admin.users') ? ' active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.feedback') }}" class="menu-item{{ request()->routeIs('admin.feedback') ? ' active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Reviews</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="menu-item{{ request()->routeIs('admin.settings') ? ' active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
            <a href="#" class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>
</body>
</html>
