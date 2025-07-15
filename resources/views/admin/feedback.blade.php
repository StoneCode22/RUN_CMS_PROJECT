<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management - Redeemer's University</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        /* Import the global CSS */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* CSS Reset */
        * {
          margin: 0;
          padding: 0;
        }

        .sidebar-header {
          height: var(--header-height);
          display: flex;
          align-items: center;
          padding: 0 var(--spacing-md);
          border-bottom: 1px solid var(--primary-light);
        }

        .sidebar-logo {
          display: flex;
          align-items: center;
          gap: var(--spacing-sm);
        }

        .sidebar-logo h1 {
          font-size: 1.25rem;
          font-weight: 600;
        }

        .sidebar-menu {
          padding: var(--spacing-md) 0;
        }

        .menu-item {
          display: flex;
          align-items: center;
          padding: var(--spacing-md) var(--spacing-lg);
          color: var(--white-color);
          text-decoration: none;
          transition: all 0.3s ease;
          gap: var(--spacing-md);
        }

        .menu-item:hover {
          background-color: var(--primary-dark);
        }

        .menu-item.active {
          background-color: var(--primary-dark);
          border-left: 4px solid var(--secondary-color);
        }

        .menu-item i {
          font-size: 1.25rem;
          width: 24px;
          text-align: center;
        }

        /* Main Content Area */
        .main-content {
          margin-left: var(--sidebar-width);
          min-height: 100vh;
          padding: var(--spacing-lg);
          transition: all 0.3s ease;
        }

        /* Header Styles */
        .header {
          height: var(--header-height);
          background-color: var(--white-color);
          box-shadow: var(--shadow-sm);
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 0 var(--spacing-lg);
          margin-bottom: var(--spacing-lg);
          border-radius: var(--border-radius-md);
        }

        .header-title h1 {
          font-size: 1.5rem;
          font-weight: 600;
          color: var(--primary-color);
        }

        .header-actions {
          display: flex;
          align-items: center;
          gap: var(--spacing-md);
        }

        .user-profile {
          display: flex;
          align-items: center;
          gap: var(--spacing-sm);
          cursor: pointer;
        }

        .user-avatar {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          background-color: var(--primary-light);
          display: flex;
          align-items: center;
          justify-content: center;
          font-weight: 600;
          color: var(--white-color);
        }

        .user-info span {
          display: block;
        }

        .user-name {
          font-weight: 500;
        }

        .user-role {
          font-size: 0.8rem;
          color: var(--grey-color);
        }

        /* Card Styles */
        .card {
          background-color: var(--white-color);
          border-radius: var(--border-radius-md);
          box-shadow: var(--shadow-sm);
          padding: var(--spacing-lg);
          margin-bottom: var(--spacing-lg);
        }

        .card-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: var(--spacing-md);
        }

        .card-title {
          font-size: 1.25rem;
          font-weight: 500;
          color: var(--primary-color);
        }

        .card-body {
          margin-bottom: var(--spacing-md);
        }

        /* Button Styles */
        .btn {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: var(--spacing-sm);
          padding: var(--spacing-sm) var(--spacing-md);
          border-radius: var(--border-radius-sm);
          text-decoration: none;
          font-weight: 500;
          font-size: 1rem;
          cursor: pointer;
          transition: all 0.3s ease;
          border: none;
        }

        .btn-primary {
          background-color: var(--primary-color);
          color: var(--white-color);
        }

        .btn-primary:hover {
          background-color: var(--primary-dark);
        }

        .btn-secondary {
          background-color: var(--secondary-color);
          color: var(--white-color);
        }

        .btn-secondary:hover {
          background-color: var(--secondary-dark);
        }

        .btn-danger {
          background-color: var(--danger-color);
          color: var(--white-color);
        }

        .btn-danger:hover {
          background-color: #d32f2f;
        }

        .btn-success {
          background-color: var(--success-color);
          color: var(--white-color);
        }

        .btn-success:hover {
          background-color: #388e3c;
        }

        .btn-sm {
          font-size: 0.875rem;
          padding: 0.25rem 0.5rem;
        }

        .btn-lg {
          font-size: 1.125rem;
          padding: 0.75rem 1.5rem;
        }

        /* Badge Styles */
        .badge {
          display: inline-block;
          padding: 0.25rem 0.5rem;
          border-radius: 50px;
          font-size: 0.75rem;
          font-weight: 600;
        }

        .badge-primary {
          background-color: var(--primary-light);
          color: var(--white-color);
        }

        .badge-secondary {
          background-color: var(--secondary-light);
          color: var(--white-color);
        }

        .badge-danger {
          background-color: var(--danger-color);
          color: var(--white-color);
        }

        .badge-success {
          background-color: var(--success-color);
          color: var(--white-color);
        }

        .badge-warning {
          background-color: var(--warning-color);
          color: var(--white-color);
        }

        .badge-info {
          background-color: var(--info-color);
          color: var(--white-color);
        }

        /* Form Styles */
        .form-group {
          margin-bottom: var(--spacing-md);
        }

        .form-label {
          display: block;
          margin-bottom: var(--spacing-sm);
          font-weight: 500;
        }

        .form-control {
          width: 100%;
          padding: var(--spacing-sm) var(--spacing-md);
          border-radius: var(--border-radius-sm);
          border: 1px solid var(--light-grey);
          font-family: var(--body-font);
          font-size: 1rem;
          transition: all 0.3s ease;
        }

        .form-control:focus {
          outline: none;
          border-color: var(--primary-color);
          box-shadow: 0 0 0 2px rgba(58, 54, 219, 0.2);
        }

        /* Table Styles */
        .table-container {
          overflow-x: auto;
        }

        .table {
          width: 100%;
          border-collapse: collapse;
        }

        .table th,
        .table td {
          padding: var(--spacing-md);
          text-align: left;
          border-bottom: 1px solid var(--light-grey);
        }

        .table th {
          font-weight: 600;
          background-color: var(--very-light-grey);
          color: var(--primary-color);
        }

        .table tr:hover {
          background-color: var(--very-light-grey);
        }

        /* Stats Card */
        .stats-card {
          display: flex;
          align-items: center;
          gap: var(--spacing-md);
        }

        .stats-icon {
          width: 50px;
          height: 50px;
          border-radius: var(--border-radius-md);
          display: flex;
          align-items: center;
          justify-content: center;
          color: var(--white-color);
          font-size: 1.5rem;
        }

        .stats-info h3 {
          font-size: 1.5rem;
          font-weight: 600;
        }

        .stats-info p {
          color: var(--grey-color);
          font-size: 0.875rem;
        }

        /* Grid system */
        .row {
          display: flex;
          flex-wrap: wrap;
          margin: 0 -15px;
        }

        .col {
          padding: 0 15px;
          flex: 1;
        }

        .col-4 { flex: 0 0 33.33%; max-width: 33.33%; }
        .col-6 { flex: 0 0 50%; max-width: 50%; }
        .col-8 { flex: 0 0 66.66%; max-width: 66.66%; }
        .col-12 { flex: 0 0 100%; max-width: 100%; }

        /* Mobile Menu Toggle */
        .menu-toggle {
          display: none;
          cursor: pointer;
          font-size: 1.5rem;
          color: var(--primary-color);
        }

        /* Feedback-specific styles */
        .feedback-stats {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
          gap: var(--spacing-lg);
          margin-bottom: var(--spacing-xl);
        }

        .filter-section {
          display: flex;
          gap: var(--spacing-md);
          align-items: center;
          flex-wrap: wrap;
          margin-bottom: var(--spacing-lg);
        }

        .filter-group {
          display: flex;
          flex-direction: column;
          gap: var(--spacing-xs);
        }

        .filter-group select {
          padding: var(--spacing-sm);
          border: 1px solid var(--light-grey);
          border-radius: var(--border-radius-sm);
          font-family: var(--body-font);
        }

        .feedback-actions {
          display: flex;
          gap: var(--spacing-sm);
        }

        .rating-stars {
          display: flex;
          gap: 2px;
        }

        .star {
          color: #ffc107;
          font-size: 1rem;
        }

        .star.empty {
          color: var(--light-grey);
        }

        .feedback-summary {
          display: grid;
          grid-template-columns: 2fr 1fr;
          gap: var(--spacing-lg);
          margin-bottom: var(--spacing-lg);
        }

        .feedback-detail {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          color: white;
          padding: var(--spacing-lg);
          border-radius: var(--border-radius-lg);
        }

        .detail-content {
          margin-top: var(--spacing-md);
        }

        .detail-content h4 {
          margin-bottom: var(--spacing-sm);
          font-size: 1rem;
        }

        .detail-content p {
          font-size: 0.9rem;
          opacity: 0.9;
          line-height: 1.6;
        }

        .modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
          animation: fadeIn 0.3s ease;
        }

        .modal-content {
          background-color: var(--white-color);
          margin: 5% auto;
          padding: var(--spacing-xl);
          border-radius: var(--border-radius-lg);
          width: 90%;
          max-width: 600px;
          max-height: 80vh;
          overflow-y: auto;
          position: relative;
        }

        .modal-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: var(--spacing-lg);
          padding-bottom: var(--spacing-md);
          border-bottom: 1px solid var(--light-grey);
        }

        .close {
          color: var(--grey-color);
          font-size: 1.5rem;
          font-weight: bold;
          cursor: pointer;
          transition: color 0.3s ease;
        }

        .close:hover {
          color: var(--dark-color);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
          .sidebar {
            transform: translateX(-100%);
          }

          .sidebar.active {
            transform: translateX(0);
          }

          .main-content {
            margin-left: 0;
          }

          .main-content.sidebar-active {
            margin-left: var(--sidebar-width);
          }

          .menu-toggle {
            display: block;
          }

          .feedback-summary {
            grid-template-columns: 1fr;
          }
        }

        @media (max-width: 768px) {
          .header {
            flex-direction: column;
            height: auto;
            padding: var(--spacing-md);
            gap: var(--spacing-md);
          }

          .filter-section {
            flex-direction: column;
            align-items: stretch;
          }

          .feedback-actions {
            flex-direction: column;
          }

          .modal-content {
            width: 95%;
            margin: 10% auto;
            padding: var(--spacing-lg);
          }
        }

        /* Utility Classes */
        .d-flex { display: flex; }
        .align-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-1 { gap: var(--spacing-sm); }
        .gap-2 { gap: var(--spacing-md); }
        .mb-2 { margin-bottom: var(--spacing-md); }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .text-primary { color: var(--primary-color); }
        .text-grey { color: var(--grey-color); }
    </style>
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
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-title">
                <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
                <h1>User's Reviews</h1>
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

        <!-- Feedback Statistics -->
        <div class="feedback-stats">
            <div class="card">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: var(--primary-color);">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stats-info">
                        <h3 id="totalFeedback">{{ $totalFeedback }}</h3>
                        <p>Total Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: var(--success-color);">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stats-info">
                        <h3 id="avgRating">{{ number_format($avgRating, 1) }}</h3>
                        <p>Average Rating</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: var(--warning-color);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-info">
                        <h3 id="pendingReview">{{ $pendingReview }}</h3>
                        <p>Pending Review</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: var(--info-color);">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stats-info">
                        <h3 id="thisMonth">{{ $thisMonth }}</h3>
                        <p>This Month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Summary -->
        {{-- <div class="feedback-summary">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Reviews</h3>
                    <button class="btn btn-primary btn-sm" onclick="exportFeedback()">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
                <div class="card-body">
                    <div class="filter-section">
                        <div class="filter-group">
                            <label>Category</label>
                            <select id="categoryFilter" onchange="filterFeedback()">
                                <option value="">All Categories</option>
                                <option value="service">Service Quality</option>
                                <option value="facility">Facility</option>
                                <option value="academic">Academic</option>
                                <option value="support">Student Support</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Rating</label>
                            <select id="ratingFilter" onchange="filterFeedback()">
                                <option value="">All Ratings</option>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Status</label>
                            <select id="statusFilter" onchange="filterFeedback()">
                                <option value="">All Status</option>
                                <option value="reviewed">Reviewed</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feedback-detail">
                <h3><i class="fas fa-chart-line"></i> Feedback Analytics</h3>
                <div class="detail-content">
                    <h4>Response Rate</h4>
                    <p>87% of complaints received feedback responses from students</p>

                    <h4>Satisfaction Trend</h4>
                    <p>Overall satisfaction has improved by 15% compared to last semester</p>

                    <h4>Common Themes</h4>
                    <p>Most positive feedback relates to quick resolution times and staff professionalism</p>
                </div>
            </div>
        </div> --}}

        <!-- Feedback Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Reviews</h3>
                <!-- Refresh and Bulk Actions buttons removed -->
            </div>
            <div class="table-container">
                <table class="table" id="feedbackTable">
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Student</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="feedbackTableBody">
                        @foreach($reviews as $review)
                        <tr data-review-id="{{ $review->id }}"
                            data-user-name="{{ $review->user->name ?? 'Anonymous' }}"
                            data-user-email="{{ $review->user->email ?? '' }}"
                            data-user-matric="{{ $review->user->matric_no ?? 'N/A' }}"
                            data-category="{{ ucfirst($review->category) }}"
                            data-rating="{{ $review->rating }}"
                            data-description="{{ $review->description }}"
                            data-date="{{ $review->created_at->format('M d, Y') }}"
                            data-status="{{ $review->status }}"
                        >
                            <td>
                                {{ $review->complaint_id ?? 'N/A' }}
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                                    <br>
                                    <small class="text-grey">{{ $review->user->email ?? '' }}</small>
                                    <br>
                                    <small class="text-grey">Matric No: {{ $review->user->matric_no ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $review->category == 'service' ? 'primary' : ($review->category == 'facility' ? 'secondary' : ($review->category == 'academic' ? 'info' : 'success')) }}">
                                    {{ ucfirst($review->category) }}
                                </span>
                            </td>
                            <td>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star star{{ $i > $review->rating ? ' empty' : '' }}"></i>
                                    @endfor
                                </div>
                                <small class="text-grey">{{ $review->rating }}/5</small>
                            </td>
                            <td>
                                <span class="badge badge-{{ $review->status == 'reviewed' ? 'success' : 'warning' }}">
                                    {{ $review->status == 'reviewed' ? 'Reviewed' : 'Pending' }}
                                </span>
                            </td>
                            <!-- Feedback column removed -->
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm view-details" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-review" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Feedback Detail Modal -->
    <!-- Complaint Detail Modal -->
    <div id="complaintModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Complaint Details</h3>
                <span class="close" onclick="closeComplaintModal()">&times;</span>
            </div>
            <div id="complaintModalBody">
                <!-- Complaint details will be loaded here -->
            </div>
        </div>
    </div>
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Review Details</h3>
                <span class="close" onclick="closeFeedbackModal()">&times;</span>
            </div>
            <div id="modalBody">
                <!-- Modal content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Bulk Actions Modal -->
    <div id="bulkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bulk Actions</h3>
                <span class="close" onclick="closeBulkModal()">&times;</span>
            </div>
            <div class="form-group">
                <label class="form-label">Select Action:</label>
                <select class="form-control" id="bulkAction">
                    <option value="">Choose action...</option>
                    <option value="mark-reviewed">Mark as Reviewed</option>
                    <option value="mark-pending">Mark as Pending</option>
                    <option value="export">Export Selected</option>
                    <option value="delete">Delete Selected</option>
                </select>
            </div>
            <div style="text-align: right; margin-top: var(--spacing-lg);">
                <button class="btn btn-secondary" onclick="closeBulkModal()">Cancel</button>
                <button class="btn btn-primary" onclick="performBulkAction()">Apply</button>
            </div>
        </div>
    </div>

    <script>
        // ...existing code for modals, bulk actions, notifications, etc...

        document.addEventListener('DOMContentLoaded', function () {
            // Delete button handler (AJAX)
            document.querySelectorAll('.delete-review').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var tr = btn.closest('tr');
                    var reviewId = tr.getAttribute('data-review-id');
                    if (confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
                        fetch(`/admin/reviews/${reviewId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                tr.remove();
                                showNotification('Review deleted successfully', 'success');
                                updatePendingReviewCard();
                            } else {
                                showNotification('Failed to delete review', 'danger');
                            }
                        })
                        .catch(() => {
                            showNotification('Error deleting review', 'danger');
                        });
                    }
                });
            });

            // View Details button handler
            document.querySelectorAll('.view-details').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var tr = btn.closest('tr');
                    var userName = tr.getAttribute('data-user-name');
                    var userEmail = tr.getAttribute('data-user-email');
                    var userMatric = tr.getAttribute('data-user-matric');
                    var category = tr.getAttribute('data-category');
                    var rating = tr.getAttribute('data-rating');
                    var description = tr.getAttribute('data-description');
                    var date = tr.getAttribute('data-date');
                    var complaintId = tr.querySelector('td').textContent.trim();
                    const modalBody = document.getElementById('modalBody');
                    modalBody.innerHTML = `
                        <div class="form-group">
                            <label class="form-label">Student Information</label>
                            <div style="background: var(--very-light-grey); padding: var(--spacing-md); border-radius: var(--border-radius-sm);">
                                <strong>${userName}</strong><br>
                                <small>Email: ${userEmail}</small><br>
                                <small>Matric No: ${userMatric}</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <span class="badge badge-primary">${category}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Rating</label>
                            <div class="rating-stars">${'★'.repeat(rating) + '☆'.repeat(5-rating)}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Feedback Message</label>
                            <div style="background: var(--very-light-grey); padding: var(--spacing-md); border-radius: var(--border-radius-sm); min-height: 100px;">${description}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date Submitted</label>
                            <p>${date}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Related Complaint</label>
                            ${complaintId !== 'N/A' ? `<button class="btn btn-primary" id="viewComplaintBtn">View Complaint</button>` : '<span class="badge badge-secondary">No Complaint Linked</span>'}
                        </div>
                        <div style="text-align:right; margin-top:var(--spacing-lg);">
                            <button class="btn btn-success" id="markReviewedBtn">Mark as Reviewed</button>
                        </div>
                    `;
                    // Add event listener for mark as reviewed
                    setTimeout(function() {
                        // Add event listener for View Complaint button
                        var viewComplaintBtn = document.getElementById('viewComplaintBtn');
                        if (viewComplaintBtn && complaintId !== 'N/A') {
                            viewComplaintBtn.onclick = function() {
                                // Close feedback modal first
                                closeFeedbackModal();
                                // Then show complaint modal
                                document.getElementById('complaintModal').style.display = 'block';
                                var complaintModalBody = document.getElementById('complaintModalBody');
                                complaintModalBody.innerHTML = '<div class="text-center">Loading complaint details...</div>';
                                fetch(`/admin/complaints/${complaintId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Robust status badge and text
                                        let statusText = 'N/A';
                                        let statusClass = 'secondary';
                                        if (data.status) {
                                            const statusLower = data.status.toLowerCase();
                                            if (statusLower === 'resolved') {
                                                statusText = 'Resolved';
                                                statusClass = 'success';
                                            } else if (statusLower === 'pending') {
                                                statusText = 'Pending';
                                                statusClass = 'warning';
                                            } else {
                                                statusText = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                                                statusClass = 'secondary';
                                            }
                                        }
                                        // Robust date formatting
                                        let dateText = 'N/A';
                                        if (data.created_at) {
                                            let dateObj = new Date(data.created_at);
                                            if (!isNaN(dateObj.getTime())) {
                                                dateText = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                                            } else {
                                                dateText = data.created_at;
                                            }
                                        }
                                        complaintModalBody.innerHTML = `
                                            <div class="form-group">
                                                <label class="form-label">Complaint ID</label>
                                                <p>${data.id}</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Subject</label>
                                                <p>${data.subject || 'N/A'}</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <div style="background: var(--very-light-grey); padding: var(--spacing-md); border-radius: var(--border-radius-sm);">${data.description || 'N/A'}</div>
                                            </div>
                                        `;
                                    })
                                    .catch(() => {
                                        complaintModalBody.innerHTML = '<div class="text-danger">Failed to load complaint details.</div>';
                                    });
                            };
                        }
                        var markBtn = document.getElementById('markReviewedBtn');
                        if (markBtn) {
                            markBtn.onclick = function() {
                                var reviewId = tr.getAttribute('data-review-id');
                                fetch(`/admin/reviews/${reviewId}/mark-reviewed`, {
                                    method: 'PATCH',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json',
                                    },
                                })
                                .then(response => {
                                    if (response.ok) {
                                        tr.setAttribute('data-status', 'reviewed');
                                        var statusTd = tr.querySelector('td:nth-child(5) span');
                                        if (statusTd) {
                                            statusTd.className = 'badge badge-success';
                                            statusTd.textContent = 'Reviewed';
                                        }
                                        updatePendingReviewCard();
                                        showNotification('Review marked as reviewed', 'success');
                                        closeFeedbackModal();
                                    } else {
                                        showNotification('Failed to mark as reviewed', 'danger');
                                    }
                                })
                                .catch(() => {
                                    showNotification('Error updating review status', 'danger');
                                });
                            };
                        }
                    }, 100);
                    document.getElementById('feedbackModal').style.display = 'block';
                });
            });
        });
// Close complaint modal (moved outside so it's globally accessible)
function closeComplaintModal() {
    document.getElementById('complaintModal').style.display = 'none';
}
        function viewFeedback(id) {
            const feedback = feedbackData.find(f => f.id === id);
            if (!feedback) return;

            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = `
                <div class="form-group">
                    <label class="form-label">Student Information</label>
                    <div style="background: var(--very-light-grey); padding: var(--spacing-md); border-radius: var(--border-radius-sm);">
                        <strong>${feedback.student}</strong><br>
                        <small>${feedback.email}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <span class="badge badge-${getCategoryColor(feedback.category)}">
                                ${getCategoryName(feedback.category)}
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Rating</label>
                            <div class="rating-stars">
                                ${generateStars(feedback.rating)}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Feedback Message</label>
                    <div style="background: var(--very-light-grey); padding: var(--spacing-md); border-radius: var(--border-radius-sm); min-height: 100px;">
                        ${feedback.feedback}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Date Submitted</label>
                            <p>${formatDate(feedback.date)}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <span class="badge badge-${feedback.status === 'reviewed' ? 'success' : 'warning'}">
                                ${feedback.status === 'reviewed' ? 'Reviewed' : 'Pending'}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Related Complaint ID</label>
                    <p>${feedback.complaintId}</p>
                </div>

                <div style="text-align: right; margin-top: var(--spacing-lg); padding-top: var(--spacing-md); border-top: 1px solid var(--light-grey);">
                    <button class="btn btn-secondary" onclick="closeFeedbackModal()">Close</button>
                    <button class="btn btn-primary" onclick="toggleStatus(${feedback.id}); closeFeedbackModal();">
                        Mark as ${feedback.status === 'reviewed' ? 'Pending' : 'Reviewed'}
                    </button>
                </div>
            `;

            document.getElementById('feedbackModal').style.display = 'block';
        }

        // Close feedback modal
        function closeFeedbackModal() {
            document.getElementById('feedbackModal').style.display = 'none';
        }

        // Toggle feedback status
        function toggleStatus(id) {
            const feedback = feedbackData.find(f => f.id === id);
            if (feedback) {
                feedback.status = feedback.status === 'reviewed' ? 'pending' : 'reviewed';
                populateFeedbackTable();
                updateStatistics();

                // Show success message
                showNotification(`Feedback status updated to ${feedback.status}`, 'success');
            }
        }

        // Delete feedback
        function deleteFeedback(id) {
            if (confirm('Are you sure you want to delete this feedback? This action cannot be undone.')) {
                feedbackData = feedbackData.filter(f => f.id !== id);
                filteredData = filteredData.filter(f => f.id !== id);
                populateFeedbackTable();
                updateStatistics();
                showNotification('Feedback deleted successfully', 'success');
            }
        }

        // Select all checkboxes
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.feedback-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });

            updateSelectedFeedback();
        }

        // Update selected feedback array
        function updateSelectedFeedback() {
            const checkboxes = document.querySelectorAll('.feedback-checkbox:checked');
            selectedFeedback = Array.from(checkboxes).map(cb => parseInt(cb.value));
        }

        // Show bulk actions modal
        function bulkActions() {
            if (selectedFeedback.length === 0) {
                showNotification('Please select at least one feedback item', 'warning');
                return;
            }
            document.getElementById('bulkModal').style.display = 'block';
        }

        // Close bulk actions modal
        function closeBulkModal() {
            document.getElementById('bulkModal').style.display = 'none';
            document.getElementById('bulkAction').value = '';
        }

        // Perform bulk action
        function performBulkAction() {
            const action = document.getElementById('bulkAction').value;

            if (!action) {
                showNotification('Please select an action', 'warning');
                return;
            }

            switch (action) {
                case 'mark-reviewed':
                    selectedFeedback.forEach(id => {
                        const feedback = feedbackData.find(f => f.id === id);
                        if (feedback) feedback.status = 'reviewed';
                    });
                    showNotification(`${selectedFeedback.length} feedback items marked as reviewed`, 'success');
                    break;

                case 'mark-pending':
                    selectedFeedback.forEach(id => {
                        const feedback = feedbackData.find(f => f.id === id);
                        if (feedback) feedback.status = 'pending';
                    });
                    showNotification(`${selectedFeedback.length} feedback items marked as pending`, 'success');
                    break;

                case 'export':
                    exportSelectedFeedback();
                    break;

                case 'delete':
                    if (confirm(`Are you sure you want to delete ${selectedFeedback.length} feedback items?`)) {
                        feedbackData = feedbackData.filter(f => !selectedFeedback.includes(f.id));
                        filteredData = filteredData.filter(f => !selectedFeedback.includes(f.id));
                        showNotification(`${selectedFeedback.length} feedback items deleted`, 'success');
                    }
                    break;
            }

            populateFeedbackTable();
            updateStatistics();
            closeBulkModal();

            // Clear selections
            selectedFeedback = [];
            document.getElementById('selectAll').checked = false;
        }

        // Export all feedback
        function exportFeedback() {
            const csvContent = generateCSV(feedbackData);
            downloadCSV(csvContent, 'feedback_export.csv');
            showNotification('Feedback data exported successfully', 'success');
        }

        // Export selected feedback
        function exportSelectedFeedback() {
            const selectedData = feedbackData.filter(f => selectedFeedback.includes(f.id));
            const csvContent = generateCSV(selectedData);
            downloadCSV(csvContent, 'selected_feedback_export.csv');
            showNotification('Selected feedback data exported successfully', 'success');
        }

        // Generate CSV content
        function generateCSV(data) {
            const headers = ['Student', 'Email', 'Category', 'Rating', 'Feedback', 'Date', 'Status', 'Complaint ID'];
            const csvRows = [headers.join(',')];

            data.forEach(feedback => {
                const row = [
                    `"${feedback.student}"`,
                    `"${feedback.email}"`,
                    `"${getCategoryName(feedback.category)}"`,
                    feedback.rating,
                    `"${feedback.feedback.replace(/"/g, '""')}"`,
                    feedback.date,
                    feedback.status,
                    feedback.complaintId
                ];
                csvRows.push(row.join(','));
            });

            return csvRows.join('\n');
        }

        // Download CSV file
        function downloadCSV(csvContent, filename) {
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('hidden', '');
            a.setAttribute('href', url);
            a.setAttribute('download', filename);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        // Refresh feedback data
        function refreshFeedback() {
            // In a real application, this would fetch fresh data from the server
            populateFeedbackTable();
            updateStatistics();
            showNotification('Feedback data refreshed', 'info');
        }

        // Show notification
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1001;
                min-width: 300px;
                animation: slideIn 0.3s ease;
            `;
            notification.innerHTML = `
                <i class="fas fa-${getNotificationIcon(type)}"></i>
                ${message}
                <button onclick="this.parentElement.remove()" style="float: right; background: none; border: none; font-size: 1.2em; cursor: pointer;">&times;</button>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Get notification icon based on type
        function getNotificationIcon(type) {
            const icons = {
                'success': 'check-circle',
                'danger': 'exclamation-circle',
                'warning': 'exclamation-triangle',
                'info': 'info-circle'
            };
            return icons[type] || 'info-circle';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const feedbackModal = document.getElementById('feedbackModal');
            const bulkModal = document.getElementById('bulkModal');

            if (event.target === feedbackModal) {
                closeFeedbackModal();
            }
            if (event.target === bulkModal) {
                closeBulkModal();
            }
        }

        // Add CSS animation for notifications
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);
        // Function to update the pending reviews card based on status column in All Reviews table
        function updatePendingReviewCard() {
            var pendingCount = 0;
            document.querySelectorAll('#feedbackTableBody tr').forEach(function(row) {
                // Get the status from the status column (5th td)
                var statusTd = row.querySelector('td:nth-child(5) span');
                if (statusTd && statusTd.textContent.trim().toLowerCase() === 'pending') {
                    pendingCount++;
                }
            });
            document.getElementById('pendingReview').textContent = pendingCount;
        }
        // Initial update on page load
        updatePendingReviewCard();
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
