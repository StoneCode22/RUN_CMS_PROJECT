<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Complaint Management System</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Global CSS styles -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
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
    <!-- Sidebar navigation for the dashboard -->
    <aside class="sidebar">
        <div class="sidebar-header">
           <div class="sidebar-logo">
                <img src="{{ asset('assets/RUN_WhiteLogo.png') }}" alt="Redeemer's Uni Logo" style="height: 48px;">
            </div>
        </div>
        <div class="sidebar-menu">
            <!-- Sidebar menu links for navigation -->
            <a href="{{ route('user.dashboard') }}" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('user.submit') }}" class="menu-item">
                <i class="fas fa-plus-circle"></i>
                <span>Submit Complaint</span>
            </a>
            <a href="{{ route ('user.view-complaints') }}" class="menu-item">
                <i class="fas fa-list-alt"></i>
                <span>View Complaints</span>
            </a>
            {{-- Remove or update this link: complaint ID required --}}
                {{-- <i class="fas fa-file-alt"></i> --}}
                {{-- <span>Complaint Detail</span> --}}
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
        </div>
    </aside>

    <!-- Main content area of the dashboard -->
    <main class="main-content">
        <!-- Header with menu toggle and user info -->
        <header class="header">
            <div class="header-flex">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="header-center">
                    <h1>Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="user-avatar">
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
                </div>
            </div>
        </header>

        <!-- Welcome card for the user -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <h2 class="card-title">Welcome to RUN Complaint Management System</h2>
            </div>
            <div class="card-body">
                <p>This platform allows you to submit, track, and manage complaints within Redeemer's University. You can also provide feedback and reviews on resolved complaints.</p>
            </div>
        </div>

        <!-- Dashboard statistics overview -->
        <div class="row dashboard-stats-row">
</body>
<style>
    /* Dashboard header title style fix */
    .header-center h1 {
        font-size: 1.5rem;
        font-weight: 500;
        color: var(--primary-color, #3a36db);
        margin: 0;
        letter-spacing: 0.01em;
    }
    /* Only add space between dashboard statistic cards */
    .dashboard-stats-row {
        display: flex;
        flex-wrap: wrap;
        gap: 6.8rem;
        width: 100%;
        align-items: stretch;
        margin:0;
    }
    .dashboard-stats-row > [class^='col-'],
    .dashboard-stats-row > [class*=' col-'] {
        flex: 1 1 0;
        min-width: 120px;
        max-width: 220px;
        display: flex;
    }
    .dashboard-stats-row .card {
        width:380px;
        min-width: 300px;
    }
    /* Header Flex Layout */
    .header-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
    .header-left {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
    }
    .header-center {
        flex: 1 1 auto;
        text-align: center;
    }
    .header-right {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-light, #667eea);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: var(--white-color, #fff);
        font-size: 1.1rem;
    }
    @media (max-width: 900px) {
        .dashboard-stats-row {
            gap: 1rem;
        }
    }
    @media (max-width: 600px) {
        .dashboard-stats-row {
            flex-direction: column;
        }
        .header-flex {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
        .header-left {
            order: 1;
        }
        .header-center {
            order: 2;
            flex: 1 1 auto;
            text-align: center;
        }
        .header-right {
            order: 3;
        }
    }
</style>
            <!-- Total Complaints Card -->
            <div class="col-md-6 col-sm-12 col-3">
                <div class="card animate-fadeIn">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--primary-color);">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="totalComplaints">0</h3>
                            <p>Total Complaints</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Complaints Card -->
            <div class="col-md-6 col-sm-12 col-3">
                <div class="card animate-fadeIn">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--warning-color);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="pendingComplaints">0</h3>
                            <p>Pending</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Resolved Complaints Card -->
            <div class="col-md-6 col-sm-12 col-3">
                <div class="card animate-fadeIn">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--success-color);">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="resolvedComplaints">0</h3>
                            <p>Resolved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feedback Given Card -->
            <div class="col-md-6 col-sm-12 col-3">
                <div class="card animate-fadeIn">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--danger-color);">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="rejectedComplaints">0</h3>
                            <p>Rejected</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>




        <!-- Recent Activity Table (Real-Time) -->
        <div class="card animate-fadeIn">
            <div class="card-header">
            <h2 class="card-title">Recent Activity</h2>
            <button class="btn btn-primary btn-sm" id="refreshActivity">
                <i class="fas fa-sync"></i> Refresh
            </button>
            </div>
            <div class="card-body">
            <div class="table-container">
                <table class="table" id="recentActivityTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="activityTableBody">
                            <!-- Activity rows will be filled by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Quick Actions for the user -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <h2 class="card-title">Quick Actions</h2>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <a href="{{ route('user.submit') }}" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Submit New Complaint
                    </a>
                    <a href="{{ route('user.view-complaints') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> View All Complaints
                    </a>
                    {{-- <a href="feedback.html" class="btn btn-info">
                        <i class="fas fa-comments"></i> Provide Feedback
                    </a> --}}
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript for dashboard interactivity -->
    <script>
    // This script controls the dashboard's dynamic features

    // Get references to important DOM elements
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const refreshActivityBtn = document.getElementById('refreshActivity');
    const activityTableBody = document.getElementById('activityTableBody');
    const totalComplaintsEl = document.getElementById('totalComplaints');
    const pendingComplaintsEl = document.getElementById('pendingComplaints');
    const resolvedComplaintsEl = document.getElementById('resolvedComplaints');
    const feedbackCountEl = document.getElementById('feedbackCount');

    // When the page loads, set up the dashboard
    document.addEventListener('DOMContentLoaded', function() {
        loadDashboardData();      // Show stats
        populateActivityTable();  // Show recent activity

        // Add event listeners for menu and refresh
        menuToggle.addEventListener('click', toggleSidebar);
        refreshActivityBtn.addEventListener('click', refreshActivityTable);

        // Adjust sidebar for screen size
        checkScreenSize();
    });

    // Adjust sidebar when window is resized
    window.addEventListener('resize', checkScreenSize);

    // Hide sidebar on small screens, show on large
    function checkScreenSize() {
        if (window.innerWidth <= 992) {
            sidebar.classList.remove('active');
            mainContent.classList.remove('sidebar-active');
        } else {
            sidebar.classList.add('active');
        }
    }

    // Show/hide sidebar when menu button is clicked
    function toggleSidebar() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('sidebar-active');
    }

    // Fetch and display dashboard statistics from the backend
    function loadDashboardData() {
        fetch("{{ route('api.user.dashboard.stats') }}")
            .then(response => response.json())
            .then(data => {
                animateCounter(totalComplaintsEl, 0, data.total_complaints);
                animateCounter(pendingComplaintsEl, 0, data.pending_complaints);
                animateCounter(resolvedComplaintsEl, 0, data.resolved_complaints);
                animateCounter(document.getElementById('rejectedComplaints'), 0, data.rejected_complaints);
            });
    }

    // Animate the counter numbers for a smooth effect
    function animateCounter(element, start, end) {
        let current = start;
        const increment = Math.ceil((end - start) / 20); // 20 steps
        const timer = setInterval(() => {
            current += increment;
            if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                clearInterval(timer);
                current = end;
            }
            element.textContent = current;
        }, 50);
    }

    // Fetch and fill the recent activity table with real user data
    function populateActivityTable() {
        fetch("{{ route('api.user.dashboard.activities') }}")
            .then(response => response.json())
            .then(activities => {
                activityTableBody.innerHTML = '';
                activities.forEach(item => {
                    const row = document.createElement('tr');
                    // Status badge
                    let statusBadge = '';
                    switch(item.status) {
                        case 'pending':
                            statusBadge = `<span class="badge badge-warning">Pending</span>`;
                            break;
                        case 'resolved':
                            statusBadge = `<span class="badge badge-success">Resolved</span>`;
                            break;
                        case 'processing':
                            statusBadge = `<span class="badge badge-info">Processing</span>`;
                            break;
                        case 'processed':
                            statusBadge = `<span class="badge badge-primary">Processed</span>`;
                            break;
                        default:
                            statusBadge = `<span class="badge badge-secondary">${item.status}</span>`;
                    }
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.title}</td>
                        <td>${statusBadge}</td>
                        <td>${item.date}</td>
                    `;
                    activityTableBody.appendChild(row);
                });
            });
    }

    // Refresh the activity table (fetches new data)
    function refreshActivityTable() {
        const refreshButton = document.querySelector('#refreshActivity i');
        refreshButton.classList.add('fa-spin');
        setTimeout(() => {
            populateActivityTable();
            refreshButton.classList.remove('fa-spin');
            showNotification('Activity refreshed successfully!', 'success');
        }, 1000);
    }

    // Format date strings for display
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    // Show a notification message on the dashboard
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} animate-fadeIn`;
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '1000';
        notification.style.minWidth = '300px';
        notification.style.padding = '15px';
        notification.style.borderRadius = '4px';
        notification.style.boxShadow = 'var(--shadow-md)';
        notification.innerHTML = message;
        // Add close button
        const closeButton = document.createElement('span');
        closeButton.innerHTML = '&times;';
        closeButton.style.float = 'right';
        closeButton.style.cursor = 'pointer';
        closeButton.style.fontWeight = 'bold';
        closeButton.style.marginLeft = '15px';
        closeButton.onclick = function() {
            document.body.removeChild(notification);
        };
        notification.prepend(closeButton);
        document.body.appendChild(notification);
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 5000);
    }

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

    // Make the current user available to JavaScript (for advanced features)
    window.currentUser = @json(Auth::user());
    </script>
</body>
</html>
</html>

<!--
====================================================================
USER DASHBOARD BLADE STRUCTURE EXPLANATION
====================================================================

1. Sidebar Navigation (<aside class="sidebar">)
   - Contains the university logo and the main navigation menu for the user dashboard.
   - Each <a> tag is a navigation link (Dashboard, Submit Complaint, View Complaints, Logout).
   - The hidden logout form is used for secure POST logout requests.

2. Main Content Area (<main class="main-content">)
   - The main container for all dashboard content.

   a. Header (<header class="header">)
      - Contains the responsive header bar at the top of the dashboard.
      - .header-flex: Flex container for header layout.
         - .header-left: Contains the menu toggle button (hamburger icon) for opening/closing the sidebar on mobile/tablet.
         - .header-center: Displays the page title ("Dashboard") centered.
         - .header-right: Shows the user's initials in a styled avatar circle.

   b. Welcome Card (<div class="card animate-fadeIn">)
      - Greets the user and briefly explains the platform's purpose.
      - .card-header: Contains the welcome title.
      - .card-body: Contains the welcome message.

   c. Dashboard Statistics Overview (<div class="row dashboard-stats-row">)
      - Displays four statistic cards: Total Complaints, Pending, Resolved, Rejected.
      - Each card uses .stats-card, .stats-icon (icon with color), and .stats-info (number and label).

   d. Recent Activity Table (<div class="card animate-fadeIn">)
      - Shows a table of the user's recent complaint activities.
      - .card-header: Title and refresh button.
      - .card-body: Contains the table with columns for ID, Title, Status, Date Submitted.

   e. Quick Actions Card (<div class="card animate-fadeIn">)
      - Provides quick access buttons for submitting a new complaint or viewing all complaints.
      - .card-header: Title ("Quick Actions").
      - .card-body: Contains action buttons.

3. JavaScript Section (<script> ... </script>)
   - Handles dashboard interactivity: sidebar toggle, stats loading, activity refresh, notifications, and logout.

4. Style Section (<style> ... </style>)
   - Contains custom CSS for layout, header, cards, responsiveness, and avatar styling.

====================================================================
This comment is for developer reference. Each section and div is structured for clarity, maintainability, and responsive design.
====================================================================
-->
