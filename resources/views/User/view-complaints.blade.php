<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints - Redeemer's University CMS</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Additional styles to fix layout issues */
        .d-flex {
            display: flex;
        }
        .align-center {
            align-items: center;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        .col-md-6, .col-lg-4, .col-sm-12, .col-12 {
            padding: 0 15px;
        }
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-lg-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .col-sm-12, .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .mb-2 {
            margin-bottom: 0.5rem;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        .mt-2 {
            margin-top: 0.5rem;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        .card-header {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-body {
            padding: 1rem;
        }
        .card-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9rem;
        }
        .btn-primary {
  background-color: var(--primary-color);
  color: var(--white-color);
}
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        .complaint-card {
            height: 100%;
            border: 1px solid #e9ecef;
        }
        .complaint-card .card-body {
            display: flex;
            flex-direction: column;
        }
        .complaint-card .card-title {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .complaint-card .card-text {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        .badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
            font-weight: 500;
        }
        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }
        .badge-processing {
            background-color: #17a2b8;
            color: white;
        }
        .badge-resolved {
            background-color: #28a745;
            color: white;
        }
        .badge-rejected {
            background-color: #dc3545;
            color: white;
        }
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .alert-info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
        }
        .text-center {
            text-align: center;
        }
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 992px) {
            .col-lg-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('assets/RUN_WhiteLogo.png') }}" alt="Redeemer's Uni Logo" style="height: 48px;">
            </div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('user.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('user.submit') }}" class="menu-item">
                <i class="fas fa-plus-circle"></i>
                <span>Submit Complaint</span>
            </a>
            <a href="{{ route('user.view-complaints') }}" class="menu-item active">
                <i class="fas fa-list-alt"></i>
                <span>View Complaints</span>
            </a>
            {{-- Remove or update this link: complaint ID required --}}
            {{--
                <a href="#" class="menu-item">
                    <i class="fas fa-file-alt"></i>
                    <span>Complaint Detail</span>
                </a>
            --}}
            {{--
                <a href="{{ route('user.reviews') }}" class="menu-item">
                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                </a>
            --}}
            <a href="#" class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Header -->
        <div class="header">
            <div class="d-flex align-center">
                <div class="menu-toggle" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="header-title">
                    <h1>View Complaints</h1>
                </div>
            </div>
            <div class="header-actions">
                <div class="user-profile" id="user-profile">
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
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <!-- Removed filter by status and filter by date -->
                </div>
                <div class="form-group mb-0">
                    <label class="form-label">Search</label>
                    <input type="text" class="form-control" id="search-input" placeholder="Search complaints by keyword...">
                </div>
            </div>
        </div>

        <!-- Complaints List -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">My Complaints</div>
                <a href="{{ route('user.submit') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    New Complaint
                </a>
            </div>
            <div class="card-body">
                <div class="complaints-list row">
                    @forelse($complaints as $c)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="complaint-card card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $c->subject }}</h5>
                                    <p class="card-text mb-1"><strong>Category:</strong> {{ $c->category }}</p>
                                    <p class="card-text mb-1"><strong>Date Submitted:</strong> {{ \Carbon\Carbon::parse($c->created_at)->format('M d, Y') }}</p>
                                    <p class="card-text mb-1"><strong>Status:</strong> <span class="badge badge-{{ $c->status }}">{{ ucfirst($c->status) }}</span></p>
                                    <a href="{{ route('user.complaint-detail', $c->id) }}" class="btn btn-sm btn-primary mt-2">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">No complaints</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- JavaScript -->
    <script>
        // Toggle sidebar
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-active');
        });

        // User profile dropdown (can be expanded)
        const userProfile = document.getElementById('user-profile');
        userProfile.addEventListener('click', () => {
            // Implement dropdown menu or redirect to profile
            console.log('User profile clicked');
        });

        // Logout functionality
        document.addEventListener('DOMContentLoaded', function () {
            const logoutBtn = document.getElementById('logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to logout?')) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        });

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const complaintCards = document.querySelectorAll('.complaint-card');

            function filterComplaints() {
                const searchValue = searchInput.value.toLowerCase();

                complaintCards.forEach(card => {
                    const cardContainer = card.closest('.col-md-6, .col-lg-4');
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    const category = card.querySelector('.card-text').textContent.toLowerCase();

                    let showCard = true;

                    // Search filter
                    if (searchValue && !title.includes(searchValue) && !category.includes(searchValue)) {
                        showCard = false;
                    }

                    // Show/hide card
                    if (showCard) {
                        cardContainer.style.display = 'block';
                    } else {
                        cardContainer.style.display = 'none';
                    }
                });

                // Check if no complaints are visible
                const visibleCards = Array.from(complaintCards).filter(card =>
                    card.closest('.col-md-6, .col-lg-4').style.display !== 'none'
                );

                const noResultsAlert = document.querySelector('.no-results-alert');
                if (visibleCards.length === 0 && complaintCards.length > 0) {
                    if (!noResultsAlert) {
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'col-12 no-results-alert';
                        alertDiv.innerHTML = '<div class="alert alert-info text-center"><i class="fas fa-search"></i> No complaints match your current filters.</div>';
                        document.querySelector('.complaints-list').appendChild(alertDiv);
                    }
                } else if (noResultsAlert) {
                    noResultsAlert.remove();
                }
            }

            // Event listeners for filters
            searchInput.addEventListener('input', filterComplaints);
        });
    </script>
</body>
</html>
</html>

<!--
====================================================================
VIEW COMPLAINTS BLADE STRUCTURE EXPLANATION
====================================================================

1. Sidebar Navigation (<div class="sidebar" id="sidebar">)
   - Contains the university logo and navigation links for the user dashboard.
   - Each <a> tag is a navigation link (Dashboard, Submit Complaint, View Complaints, Logout).
   - Some links are commented out for future features (Complaint Detail, Reviews).

2. Main Content Area (<div class="main-content" id="main-content">)
   - The main container for all complaint viewing content.

   a. Header (<div class="header">)
      - Contains the responsive header bar at the top of the page.
      - .d-flex.align-center: Flex container for header layout.
         - .menu-toggle: Hamburger icon for toggling sidebar on mobile/tablet.
         - .header-title: Displays the page title ("View Complaints").
      - .header-actions: Shows the user's initials and name in a styled avatar and info block.

   b. Filter/Search Section (<div class="card mb-3">)
      - Provides a search input for filtering complaints by keyword.
      - (Other filters like status/date are removed for simplicity.)

   c. Complaints List Card (<div class="card">)
      - Displays a list of the user's complaints in a responsive grid.
      - Each complaint card shows subject, category, date, status, and a button to view details.
      - If no complaints exist, an info alert is shown.

3. JavaScript Section (<script> ... </script>)
   - Handles sidebar toggle, user profile click, logout, and complaint filtering.
   - The filterComplaints function updates the visible complaints based on the search input.
   - Shows a "no results" alert if no complaints match the search.

4. Style Section (<style> ... </style>)
   - Contains custom CSS for layout, cards, badges, alerts, responsive grid, and utility classes.

====================================================================
This comment is for developer reference. Each section and div is structured for clarity, maintainability, and responsive design. The complaints list is interactive and updates based on user search input.
====================================================================
-->
    </script>
</body>
</html>
