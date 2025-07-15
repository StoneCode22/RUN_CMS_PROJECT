<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Complaint Management System</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Link to Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    <!-- Dashboard Specific Styles -->
    <style>
        /* Dashboard specific styles */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            color: var(--white-color);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stat-card.secondary {
            background: linear-gradient(135deg, var(--secondary-color), var(--secondary-light));
        }

        .stat-card.success {
            background: linear-gradient(135deg, var(--success-color), #66bb6a);
        }

        .stat-card.danger {
            background: linear-gradient(135deg, var(--danger-color), #ef5350);
        }

        .stat-content {
            position: relative;
            z-index: 2;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: var(--spacing-sm);
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .stat-icon {
            position: absolute;
            top: var(--spacing-md);
            right: var(--spacing-md);
            font-size: 2rem;
            opacity: 0.3;
        }

        .chart-container {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--very-light-grey);
            border-radius: var(--border-radius-md);
            color: var(--grey-color);
            margin-bottom: var(--spacing-lg);
        }

        .recent-complaints {
            max-height: 400px;
            overflow-y: auto;
        }

        .complaint-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--spacing-md);
            border-bottom: 1px solid var(--light-grey);
            transition: background-color 0.3s ease;
        }

        .complaint-item:hover {
            background-color: var(--very-light-grey);
        }

        .complaint-item:last-child {
            border-bottom: none;
        }

        .complaint-info {
            flex: 1;
        }

        .complaint-title {
            font-weight: 500;
            margin-bottom: var(--spacing-xs);
        }

        .complaint-meta {
            font-size: 0.875rem;
            color: var(--grey-color);
        }

        .priority-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-left: var(--spacing-md);
        }

        .priority-high {
            background-color: var(--danger-color);
        }

        .priority-medium {
            background-color: var(--warning-color);
        }

        .priority-low {
            background-color: var(--success-color);
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-md);
            padding: var(--spacing-md) 0;
            border-bottom: 1px solid var(--light-grey);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white-color);
            font-size: 0.875rem;
        }

        .activity-icon.new {
            background-color: var(--info-color);
        }

        .activity-icon.resolved {
            background-color: var(--success-color);
        }

        .activity-icon.updated {
            background-color: var(--warning-color);
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            margin-bottom: var(--spacing-xs);
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--grey-color);
        }

        /* Responsive adjustments for dashboard */
        @media (max-width: 768px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    {{--Login successful 3 second message--}}
    @if (session('login_success'))
        <div class="alert alert-success" id="loginSuccessAlert" style="margin: 1rem; text-align:center;">
            {{ session('login_success') }}
        </div>
        <script>
            setTimeout(function() {
                var alert = document.getElementById('loginSuccessAlert');
                if (alert) alert.style.display = 'none';
            }, 3000);
        </script>
    @endif
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
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
            <!-- Logout button (submits a hidden POST form) -->
            <a href="#" class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <!-- Hidden logout form (for security, uses POST) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-title">
                <div class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Dashboard</h1>
            </div>
           <div class="header-actions">
                <div class="user-profile">
                    <div class="user-avatar">

                        <!-- Show initials of the user's first and last name as avatar -->
                        @php
                            $names = explode(' ', trim(Auth::user()->name));
                            $initials = '';
                            if (count($names) > 1) {
                                $initials = strtoupper(substr($names[0], 0, 1) . substr($names[1], 0, 1));
                            } else {
                                $initials = strtoupper(substr($names[0], 0, 2));
                            }
                        @endphp
                        {{ $initials }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">System Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Statistics Cards -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-number" id="totalComplaints">0</div>
                        <div class="stat-label">Total Complaints</div>
                    </div>
                    <i class="fas fa-clipboard-list stat-icon"></i>
                </div>

                <div class="stat-card secondary">
                    <div class="stat-content">
                        <div class="stat-number" id="pendingComplaints">0</div>
                        <div class="stat-label">Pending Complaints</div>
                    </div>
                    <i class="fas fa-clock stat-icon"></i>
                </div>

                <div class="stat-card success">
                    <div class="stat-content">
                        <div class="stat-number" id="resolvedComplaints">0</div>
                        <div class="stat-label">Resolved Complaints</div>
                    </div>
                    <i class="fas fa-check-circle stat-icon"></i>
                </div>

                <div class="stat-card danger">
                    <div class="stat-content">
                        <div class="stat-number" id="activeUsers">0</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                    <i class="fas fa-users stat-icon"></i>
                </div>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="row">
                <!-- Recent Complaints -->
                <div class="col col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Complaints</h3>
                            <a href="{{ route('admin.complaint-management') }}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="recent-complaints" id="recentComplaints">
                                <!-- Recent complaints will be loaded here -->
                                <div class="complaint-item">
                                    <div class="complaint-info">
                                        <div class="complaint-title">Network Connectivity Issues</div>
                                        <div class="complaint-meta">By John Doe • 2 hours ago</div>
                                    </div>
                                    <div class="d-flex align-center gap-1">
                                        <span class="badge badge-warning">Pending</span>
                                        <div class="priority-indicator priority-high"></div>
                                    </div>
                                </div>

                                <div class="complaint-item">
                                    <div class="complaint-info">
                                        <div class="complaint-title">Cafeteria Service Quality</div>
                                        <div class="complaint-meta">By Jane Smith • 4 hours ago</div>
                                    </div>
                                    <div class="d-flex align-center gap-1">
                                        <span class="badge badge-info">Processing</span>
                                        <div class="priority-indicator priority-medium"></div>
                                    </div>
                                </div>

                                <div class="complaint-item">
                                    <div class="complaint-info">
                                        <div class="complaint-title">Library Access Problems</div>
                                        <div class="complaint-meta">By Mike Johnson • 6 hours ago</div>
                                    </div>
                                    <div class="d-flex align-center gap-1">
                                        <span class="badge badge-success">Resolved</span>
                                        <div class="priority-indicator priority-low"></div>
                                    </div>
                                </div>

                                <div class="complaint-item">
                                    <div class="complaint-info">
                                        <div class="complaint-title">Hostel Maintenance Request</div>
                                        <div class="complaint-meta">By Sarah Wilson • 8 hours ago</div>
                                    </div>
                                    <div class="d-flex align-center gap-1">
                                        <span class="badge badge-warning">Pending</span>
                                        <div class="priority-indicator priority-high"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                            <button class="btn btn-secondary btn-sm" onclick="refreshActivity()">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="recentActivity">
                                <!-- Recent activity will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            {{-- <div class="row">
                <div class="col col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Complaints Trend</h3>
                            <select class="form-control" style="width: auto;" onchange="updateChart(this.value)">
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="text-center">
                                    <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                    <p>Chart will be displayed here</p>
                                    <small class="text-grey">Integration with Chart.js or similar library required</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Complaint Categories</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="text-center">
                                    <i class="fas fa-chart-pie" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                    <p>Pie chart will be displayed here</p>
                                    <small class="text-grey">Integration with Chart.js or similar library required</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2" style="flex-wrap: wrap;">
                        <button class="btn btn-secondary" onclick="generateReport()">
                            <i class="fas fa-file-pdf"></i> Generate Report
                        </button>
                        <button class="btn btn-success" onclick="exportData()">
                            <i class="fas fa-download"></i> Export Data
                        </button>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>

        // Dashboard functionality
        class Dashboard {
            constructor() {
                this.init();
                this.loadDashboardData();
                this.setupEventListeners();
            }

            init() {
                this.animateCounters();
                this.setupMobileMenu();
            }

            setupEventListeners() {
                const menuToggle = document.getElementById('menuToggle');
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                if (menuToggle) {
                    menuToggle.addEventListener('click', () => {
                        sidebar.classList.toggle('active');
                        mainContent.classList.toggle('sidebar-active');
                    });
                }
                setInterval(() => {
                    this.loadDashboardData();
                }, 30000);
            }

            setupMobileMenu() {
                document.addEventListener('click', (e) => {
                    const sidebar = document.getElementById('sidebar');
                    const menuToggle = document.getElementById('menuToggle');
                    if (window.innerWidth <= 992 &&
                        !sidebar.contains(e.target) &&
                        !menuToggle.contains(e.target)) {
                        sidebar.classList.remove('active');
                        document.getElementById('mainContent').classList.remove('sidebar-active');
                    }
                });
            }

            animateCounters() {
                // No-op for now, will animate after data loads
            }

            async loadDashboardData() {
                try {
                    // Fetch complaints and users from backend
                    const [complaintsRes, usersRes] = await Promise.all([
                        fetch('/admin/complaints'),
                        fetch('/admin/users-list')
                    ]);
                    const complaints = complaintsRes.ok ? await complaintsRes.json() : [];
                    const users = usersRes.ok ? await usersRes.json() : [];

                    // Calculate stats
                    const totalComplaints = complaints.length;
                    const pendingComplaints = complaints.filter(c => c.status === 'pending' || c.status === 'processing').length;
                    const resolvedComplaints = complaints.filter(c => c.status === 'resolved').length;
                    const activeUsers = users.filter(u => u.status === 'active').length;

                    // Update stat cards
                    document.getElementById('totalComplaints').textContent = totalComplaints;
                    document.getElementById('pendingComplaints').textContent = pendingComplaints;
                    document.getElementById('resolvedComplaints').textContent = resolvedComplaints;
                    document.getElementById('activeUsers').textContent = activeUsers;

                    // Update recent complaints
                    this.renderRecentComplaints(complaints);
                    // Update recent activity
                    this.renderRecentActivity(complaints, users);

                    this.showLoadingState();
                } catch (error) {
                    this.showAlert('Failed to load dashboard data', 'danger');
                }
            }

            // Format date as "H:i, d/m/Y" (e.g., "14:23, 10/07/2025")
            formatDateTime(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return '';
                const pad = n => n < 10 ? '0' + n : n;
                const hours = pad(date.getHours());
                const minutes = pad(date.getMinutes());
                const day = pad(date.getDate());
                const month = pad(date.getMonth() + 1);
                const year = date.getFullYear();
                return `${hours}:${minutes}, ${day}/${month}/${year}`;
            }

            renderRecentActivity(complaints, users) {
                const activityDiv = document.getElementById('recentActivity');
                if (!activityDiv) return;
                activityDiv.innerHTML = '';
                // Only show the 5 most recent complaints (new or status change)
                let events = [];
                complaints.forEach(c => {
                    events.push({
                        type: 'complaint',
                        action: 'new',
                        name: c.student || 'Anonymous',
                        id: c.id,
                        date: c.date,
                        status: c.status,
                        subject: c.subject
                    });
                    if (c.status === 'resolved' || c.status === 'rejected') {
                        events.push({
                            type: 'complaint',
                            action: 'status',
                            id: c.id,
                            status: c.status,
                            date: c.date,
                            subject: c.subject
                        });
                    }
                });
                // Sort by date descending
                events = events.filter(e => e.date).sort((a, b) => new Date(b.date) - new Date(a.date));
                // Show up to 5
                events.slice(0, 5).forEach(e => {
                    let icon = '', iconClass = '', text = '', time = this.formatDateTime(e.date);
                    if (e.type === 'complaint' && e.action === 'new') {
                        icon = 'fa-plus'; iconClass = 'activity-icon new';
                        text = `New complaint submitted by ${this.escapeHtml(e.name)}`;
                    } else if (e.type === 'complaint' && e.action === 'status') {
                        icon = e.status === 'resolved' ? 'fa-check' : 'fa-times';
                        iconClass = e.status === 'resolved' ? 'activity-icon resolved' : 'activity-icon updated';
                        text = `Complaint #${e.id} marked as ${this.capitalize(e.status)}`;
                    }
                    activityDiv.innerHTML += `
                        <div class="activity-item">
                            <div class="${iconClass}">
                                <i class="fas ${icon}"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">${text}</div>
                                <div class="activity-time">${time}</div>
                            </div>
                        </div>
                    `;
                });
                if (events.length === 0) {
                    activityDiv.innerHTML = '<div class="text-center text-grey">No recent activity.</div>';
                }
            }

            renderRecentComplaints(complaints) {
                const recentComplaintsDiv = document.getElementById('recentComplaints');
                if (!recentComplaintsDiv) return;
                recentComplaintsDiv.innerHTML = '';
                // Sort by date descending, show top 5
                const sorted = complaints.slice().sort((a, b) => new Date(b.date) - new Date(a.date));
                const top5 = sorted.slice(0, 5);
                if (top5.length === 0) {
                    recentComplaintsDiv.innerHTML = '<div class="text-center text-grey">No recent complaints.</div>';
                    return;
                }
                top5.forEach(c => {
                    const statusBadge = this.getStatusBadge(c.status);
                    const priorityClass = this.getPriorityClass(c.priority);
                    const student = c.student || 'Anonymous';
                    const title = c.subject || '(No Subject)';
                    const meta = `By ${student} • ${this.formatDateTime(c.date)}`;
                    recentComplaintsDiv.innerHTML += `
                        <div class="complaint-item">
                            <div class="complaint-info">
                                <div class="complaint-title">${this.escapeHtml(title)}</div>
                                <div class="complaint-meta">${this.escapeHtml(meta)}</div>
                            </div>
                            <div class="d-flex align-center gap-1">
                                <span class="badge ${statusBadge}">${this.capitalize(c.status)}</span>
                                <div class="priority-indicator ${priorityClass}"></div>
                            </div>
                        </div>
                    `;
                });
            }

            getStatusBadge(status) {
                switch (status) {
                    case 'pending': return 'badge-warning';
                    case 'processing': return 'badge-info';
                    case 'resolved': return 'badge-success';
                    case 'rejected': return 'badge-danger';
                    default: return 'badge-secondary';
                }
            }

            getPriorityClass(priority) {
                switch (priority) {
                    case 'high': return 'priority-high';
                    case 'medium': return 'priority-medium';
                    case 'low': return 'priority-low';
                    default: return 'priority-medium';
                }
            }

            capitalize(str) {
                if (!str) return '';
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

            escapeHtml(text) {
                if (!text) return '';
                return text.replace(/[&<>\"]/g, function (c) {
                    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c];
                });
            }

            showLoadingState() {
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    stat.style.opacity = '0.7';
                    setTimeout(() => {
                        stat.style.opacity = '1';
                    }, 500);
                });
            }

            refreshData() {
                this.showAlert('Data refreshed successfully!', 'success');
                this.loadDashboardData();
            }

            showAlert(message, type = 'info') {
                const alert = document.createElement('div');
                alert.className = `alert alert-${type}`;
                alert.innerHTML = `
                    <i class="fas fa-info-circle"></i>
                    ${message}
                `;
                const mainContent = document.querySelector('.dashboard-content');
                mainContent.insertBefore(alert, mainContent.firstChild);
                setTimeout(() => {
                    alert.remove();
                }, 3000);
            }
        }

        // Utility functions
        function refreshActivity() {
            const button = event.target.closest('button');
            const icon = button.querySelector('i');

            // Add spinning animation
            icon.classList.add('fa-spin');

            // Simulate refresh
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                dashboard.showAlert('Activity refreshed!', 'success');
            }, 1000);
        }

        function updateChart(period) {
            dashboard.showAlert(`Chart updated for ${period}`, 'info');
            // In a real application, this would update the chart with new data
        }

        function generateReport() {
            dashboard.showAlert('Generating report... This may take a few moments.', 'info');
            fetch('/admin/generate-report', {
                method: 'GET',
                headers: {
                    'Accept': 'application/pdf'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to generate report');
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'complaints_report.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
                dashboard.showAlert('Report generated and downloaded!', 'success');
            })
            .catch(() => {
                dashboard.showAlert('Failed to generate report.', 'danger');
            });
        }

        function exportData() {
            dashboard.showAlert('Exporting data...', 'info');
            fetch('/admin/export-data', {
                method: 'GET',
                headers: {
                    'Accept': 'application/zip'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to export data');
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'cms_data_export.zip';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
                dashboard.showAlert('Data exported and downloaded!', 'success');
            })
            .catch(() => {
                dashboard.showAlert('Failed to export data.', 'danger');
            });
        }

        // Initialize dashboard when page loads
        let dashboard;
        document.addEventListener('DOMContentLoaded', () => {
            dashboard = new Dashboard();
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            if (window.innerWidth > 992) {
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-active');
            }
        });

        // Add loading states and animations
        document.addEventListener('DOMContentLoaded', () => {
            // Add fade-in animation to cards
            const cards = document.querySelectorAll('.card, .stat-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

            // Logout functionality: submits the hidden logout form when the logout button is clicked
    document.addEventListener('DOMContentLoaded', function () {
        const logoutBtn = document.getElementById('logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('logout-form').submit();
            });
        }
    });
    </script>
</body>
</html>
