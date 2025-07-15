<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management - Redeemer's University</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        /* Import Global CSS */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* CSS Reset */
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        :root {
          /* Color Variables */
          --primary-color: #1e3a8a;
          --primary-light: #6c6aed;
          --primary-dark: #2a2899;
          --secondary-color: #ff9800;
          --secondary-light: #ffb74d;
          --secondary-dark: #f57c00;
          --danger-color: #f44336;
          --success-color: #4caf50;
          --warning-color: #ff9800;
          --info-color: #2196f3;
          --dark-color: #333;
          --grey-color: #757575;
          --light-grey: #e0e0e0;
          --very-light-grey: #f5f5f5;
          --white-color: #fff;

          /* Font Variables */
          --body-font: 'Poppins', sans-serif;

          /* Spacing Variables */
          --spacing-xs: 0.25rem;
          --spacing-sm: 0.5rem;
          --spacing-md: 1rem;
          --spacing-lg: 1.5rem;
          --spacing-xl: 2rem;

          /* Border Radius */
          --border-radius-sm: 4px;
          --border-radius-md: 8px;
          --border-radius-lg: 12px;

          /* Shadow */
          --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
          --shadow-md: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
          --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);

          /* Layout Variables */
          --sidebar-width: 250px;
          --header-height: 60px;
        }

        /* Global Styles */
        body {
          font-family: var(--body-font);
          font-size: 16px;
          line-height: 1.5;
          color: var(--dark-color);
          background-color: var(--very-light-grey);
          min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
          position: fixed;
          left: 0;
          top: 0;
          height: 100vh;
          width: var(--sidebar-width);
          background-color: var(--primary-color);
          color: var(--white-color);
          box-shadow: var(--shadow-md);
          z-index: 100;
          transition: all 0.3s ease;
          overflow-y: auto;
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

        .sidebar-logo img {
          height: 40px;
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

        textarea.form-control {
          min-height: 100px;
          resize: vertical;
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

        /* Alert Styles */
        .alert {
          padding: var(--spacing-md);
          border-radius: var(--border-radius-md);
          margin-bottom: var(--spacing-md);
        }

        .alert-success {
          background-color: #e8f5e9;
          color: var(--success-color);
          border-left: 4px solid var(--success-color);
        }

        .alert-danger {
          background-color: #ffebee;
          color: var(--danger-color);
          border-left: 4px solid var(--danger-color);
        }

        .alert-warning {
          background-color: #fff8e1;
          color: var(--warning-color);
          border-left: 4px solid var(--warning-color);
        }

        .alert-info {
          background-color: #e3f2fd;
          color: var(--info-color);
          border-left: 4px solid var(--info-color);
        }

        /* Status indicators */
        .status {
          width: 10px;
          height: 10px;
          border-radius: 50%;
          display: inline-block;
          margin-right: var(--spacing-sm);
        }

        .status-pending {
          background-color: var(--warning-color);
        }

        .status-resolved {
          background-color: var(--success-color);
        }

        .status-rejected {
          background-color: var(--danger-color);
        }

        .status-processing {
          background-color: var(--info-color);
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

        .col-1 { flex: 0 0 8.33%; max-width: 8.33%; }
        .col-2 { flex: 0 0 16.66%; max-width: 16.66%; }
        .col-3 { flex: 0 0 25%; max-width: 25%; }
        .col-4 { flex: 0 0 33.33%; max-width: 33.33%; }
        .col-5 { flex: 0 0 41.66%; max-width: 41.66%; }
        .col-6 { flex: 0 0 50%; max-width: 50%; }
        .col-7 { flex: 0 0 58.33%; max-width: 58.33%; }
        .col-8 { flex: 0 0 66.66%; max-width: 66.66%; }
        .col-9 { flex: 0 0 75%; max-width: 75%; }
        .col-10 { flex: 0 0 83.33%; max-width: 83.33%; }
        .col-11 { flex: 0 0 91.66%; max-width: 91.66%; }
        .col-12 { flex: 0 0 100%; max-width: 100%; }

        /* Mobile Menu Toggle */
        .menu-toggle {
          display: none;
          cursor: pointer;
          font-size: 1.5rem;
        }

        /* Utility Classes */
        .d-flex { display: flex; }
        .align-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .gap-1 { gap: var(--spacing-sm); }
        .gap-2 { gap: var(--spacing-md); }
        .gap-3 { gap: var(--spacing-lg); }
        .mb-1 { margin-bottom: var(--spacing-sm); }
        .mb-2 { margin-bottom: var(--spacing-md); }
        .mb-3 { margin-bottom: var(--spacing-lg); }
        .mt-1 { margin-top: var(--spacing-sm); }
        .mt-2 { margin-top: var(--spacing-md); }
        .mt-3 { margin-top: var(--spacing-lg); }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        .text-primary { color: var(--primary-color); }
        .text-secondary { color: var(--secondary-color); }
        .text-danger { color: var(--danger-color); }
        .text-success { color: var(--success-color); }
        .text-warning { color: var(--warning-color); }
        .text-info { color: var(--info-color); }
        .text-grey { color: var(--grey-color); }
        .w-100 { width: 100%; }
        .h-100 { height: 100%; }

        /* Responsive adjustments */
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

          .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
          }

          .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
          }
        }

        @media (max-width: 768px) {
          .col-sm-12 {
            flex: 0 0 100%;
            max-width: 100%;
          }

          .header {
            flex-direction: column;
            height: auto;
            padding: var(--spacing-md);
          }

          .header-title, .header-actions {
            width: 100%;
            justify-content: center;
            margin-bottom: var(--spacing-sm);
          }
        }

        /* Complaint Management Specific Styles */
        .filters-section {
          display: flex;
          gap: var(--spacing-md);
          align-items: center;
          flex-wrap: wrap;
          margin-bottom: var(--spacing-lg);
        }

        .search-box {
          position: relative;
          flex: 1;
          min-width: 250px;
        }

        .search-box input {
          padding-left: 40px;
        }

        .search-box i {
          position: absolute;
          left: 12px;
          top: 50%;
          transform: translateY(-50%);
          color: var(--grey-color);
        }

        .action-buttons {
          display: flex;
          gap: var(--spacing-sm);
        }

        .complaint-details-modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
          background-color: var(--white-color);
          margin: 5% auto;
          padding: var(--spacing-xl);
          border-radius: var(--border-radius-md);
          width: 90%;
          max-width: 600px;
          max-height: 80vh;
          overflow-y: auto;
        }

        .modal-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: var(--spacing-lg);
        }

        .close {
          color: var(--grey-color);
          font-size: 28px;
          font-weight: bold;
          cursor: pointer;
        }

        .close:hover {
          color: var(--dark-color);
        }

        .complaint-info {
          margin-bottom: var(--spacing-lg);
        }

        .info-item {
          display: flex;
          justify-content: space-between;
          margin-bottom: var(--spacing-sm);
          padding: var(--spacing-sm) 0;
          border-bottom: 1px solid var(--light-grey);
        }

        .info-label {
          font-weight: 500;
          color: var(--grey-color);
        }

        .status-actions {
          margin-top: var(--spacing-lg);
          display: flex;
          gap: var(--spacing-sm);
          flex-wrap: wrap;
        }

        @media (max-width: 768px) {
          .filters-section {
            flex-direction: column;
            align-items: stretch;
          }

          .search-box {
            min-width: unset;
          }

          .action-buttons {
            justify-content: center;
          }

          .table-container {
            font-size: 0.875rem;
          }

          .table th,
          .table td {
            padding: var(--spacing-sm);
          }
        }
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
        <div class="header">
            <div class="header-title">
                <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
                <h1>Complaint Management</h1>
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
        </div>

        <!-- Stats Cards -->
        <div class="row mb-3">
            <div class="col col-md-6 col-sm-12">
                <div class="card">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--warning-color);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="pendingCount">24</h3>
                            <p>Pending Complaints</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6 col-sm-12">
                <div class="card">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--success-color);">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="resolvedCount">156</h3>
                            <p>Resolved Complaints</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="card">
            <div class="filters-section">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search complaints...">
                </div>
                <select class="form-control" id="statusFilter" style="width: auto;">
                    <option value="">All Status</option>
                    <option value="processing">Processing</option>
                    <option value="resolved">Resolved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <select class="form-control" id="categoryFilter" style="width: auto;">
                    <option value="">All Categories</option>
                    <option value="academic">Academic</option>
                    <option value="facility">Facility</option>
                    <option value="administration">Administration</option>
                    <option value="security">Security</option>
                    <option value="hostel">Hostel</option>
                    <option value="cafeteria">Cafeteria</option>
                    <option value="IT Services">IT Services</option>
                    <option value="other">Other</option>
                </select>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="exportBtn">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Complaints Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Complaints List</h3>
            </div>
            <div class="table-container">
                <table class="table" id="complaintsTable">
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Student</th>
                            <th>Category</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="complaintsTableBody">
                        <!-- Dynamic content will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Complaint Details Modal -->
    <div id="complaintModal" class="complaint-details-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Complaint Details</h2>
                <span class="close" id="closeModal">&times;</span>
            </div>
            <div class="complaint-info" id="complaintInfo">
                <!-- Dynamic content will be inserted here -->
            </div>
            <div class="status-actions">
                <button class="btn btn-info" onclick="updateStatus('processing')">Mark as Processing</button>
                <button class="btn btn-success" onclick="updateStatus('resolved')">Mark as Resolved</button>
                <button class="btn btn-danger" onclick="updateStatus('rejected')">Reject Complaint</button>
            </div>
        </div>
    </div>

    <script>
        // Dynamic complaint data from backend
        let complaints = [];
        let filteredComplaints = [];
        let currentComplaint = null;

        // Fetch complaints from backend
        async function fetchComplaints() {
            try {
                const response = await fetch('/admin/complaints');
                if (!response.ok) throw new Error('Failed to fetch complaints');
                const data = await response.json();
                // Defensive: ensure array and map fields
                complaints = Array.isArray(data) ? data.map(c => normalizeComplaint(c)) : [];
                filteredComplaints = [...complaints];
                renderComplaints();
                updateStats();
                if (complaints.length === 0) {
                    complaintsTableBody.innerHTML = `<tr><td colspan="7" class="text-center text-grey">No complaints found.</td></tr>`;
                }
            } catch (error) {
                complaintsTableBody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Failed to fetch complaints</td></tr>`;
                showAlert('Failed to fetch complaints', 'danger');
            }
        }

        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const menuToggle = document.getElementById('menuToggle');
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const categoryFilter = document.getElementById('categoryFilter');
        const complaintsTableBody = document.getElementById('complaintsTableBody');
        const complaintModal = document.getElementById('complaintModal');
        const closeModal = document.getElementById('closeModal');
        const complaintInfo = document.getElementById('complaintInfo');
        const exportBtn = document.getElementById('exportBtn');

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            fetchComplaints();
            setupEventListeners();
        });

        // Setup event listeners
        function setupEventListeners() {
            menuToggle.addEventListener('click', toggleSidebar);
            searchInput.addEventListener('input', filterComplaints);
            statusFilter.addEventListener('change', filterComplaints);
            categoryFilter.addEventListener('change', filterComplaints);
            closeModal.addEventListener('click', closeComplaintModal);
            exportBtn.addEventListener('click', exportComplaints);

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === complaintModal) {
                    closeComplaintModal();
                }
            });
        }

        // Toggle sidebar for mobile
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-active');
        }

        // Filter complaints based on search and filters
        function filterComplaints() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusFilterValue = statusFilter.value;
            const categoryFilterValue = categoryFilter.value;


            filteredComplaints = complaints.filter(complaint => {
                const matchesSearch = (complaint.student && complaint.student.toLowerCase().includes(searchTerm)) ||
                    (complaint.subject && complaint.subject.toLowerCase().includes(searchTerm)) ||
                    (complaint.id && complaint.id.toString().toLowerCase().includes(searchTerm));

                const matchesStatus = !statusFilterValue || complaint.status === statusFilterValue;
                const matchesCategory = !categoryFilterValue || complaint.category === categoryFilterValue;

                return matchesSearch && matchesStatus && matchesCategory;
            });

            renderComplaints();
        }

        // Render complaints table
        function renderComplaints() {
            complaintsTableBody.innerHTML = '';
            if (!filteredComplaints || filteredComplaints.length === 0) {
                complaintsTableBody.innerHTML = `<tr><td colspan="7" class="text-center text-grey">No complaints found.</td></tr>`;
                return;
            }
            filteredComplaints.forEach(complaint => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${complaint.id ?? ''}</td>
                    <td>${complaint.student ?? 'Anonymous'}</td>
                    <td><span class="badge badge-info">${formatCategory(complaint.category)}</span></td>
                    <td>${complaint.subject ?? ''}</td>
                    <td>
                        <span class="status status-${complaint.status}"></span>
                        <span class="badge badge-${getStatusBadgeClass(complaint.status)}">${formatStatus(complaint.status)}</span>
                    </td>
                    <td>${formatDate(complaint.date)}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="viewComplaint('${complaint.id}')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="editComplaint('${complaint.id}')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </td>
                `;
                complaintsTableBody.appendChild(row);
            });
        }

        // View complaint details
        async function viewComplaint(complaintId) {
            try {
                // Try to get the latest complaint data from backend (in case of updates)
                const response = await fetch(`/admin/complaints/${complaintId}`);
                if (!response.ok) throw new Error('Failed to fetch complaint details');
                let data = await response.json();
                currentComplaint = normalizeComplaint(data);
                displayComplaintDetails(currentComplaint);
                complaintModal.style.display = 'block';
            } catch (error) {
                showAlert('Failed to load complaint details', 'danger');
            }
        }

        // Display complaint details in modal
        function displayComplaintDetails(complaint) {
            complaintInfo.innerHTML = `
                <div class="info-item">
                    <span class="info-label">Complaint ID:</span>
                    <span>${complaint.id ?? ''}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Student Name:</span>
                    <span>${complaint.student ?? 'Anonymous'}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span>${complaint.email ?? ''}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Category:</span>
                    <span class="badge badge-info">${formatCategory(complaint.category)}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Subject:</span>
                    <span>${complaint.subject ?? ''}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span class="badge badge-${getStatusBadgeClass(complaint.status)}">${formatStatus(complaint.status)}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Priority:</span>
                    <span class="badge badge-${getPriorityBadgeClass(complaint.priority)}">${formatPriority(complaint.priority)}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date Submitted:</span>
                    <span>${formatDate(complaint.date)}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Time Submitted:</span>
                    <span>${formatTimeHM(complaint.date)}</span>
                </div>
                <div class="info-item" style="flex-direction: column; align-items: flex-start;">
                    <span class="info-label">Description:</span>
                    <div style="margin-top: 8px; padding: 12px; background-color: var(--very-light-grey); border-radius: var(--border-radius-sm); width: 100%;">
                        ${complaint.description ?? ''}
                    </div>
                </div>
                <div class="info-item" style="flex-direction: column; align-items: flex-start;">
                    <span class="info-label">Suggested Solution:</span>
                    <div style="margin-top: 8px; padding: 12px; background-color: var(--very-light-grey); border-radius: var(--border-radius-sm); width: 100%; color: #1e3a8a;">
                        ${complaint.suggested_solution ? complaint.suggested_solution : '<span style=\'color:#757575\'>No suggestion provided.</span>'}
                    </div>
                </div>
            `;
        // Format time as "H:i" (e.g., "14:23")
        function formatTimeHM(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return '';
            const pad = n => n < 10 ? '0' + n : n;
            return pad(date.getHours()) + ':' + pad(date.getMinutes());
        }
        }

        // Close complaint modal
        function closeComplaintModal() {
            complaintModal.style.display = 'none';
            currentComplaint = null;
        }

        // Update complaint status (admin)
        async function updateStatus(newStatus) {
            if (currentComplaint) {
                try {
                    const response = await fetch(`/admin/complaints/${currentComplaint.id}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ status: newStatus })
                    });
                    if (response.ok) {
                        showAlert(`Complaint ${currentComplaint.id} has been marked as ${formatStatus(newStatus)}`, 'success');
                        fetchComplaints();
                        closeComplaintModal();
                    } else {
                        showAlert('Failed to update complaint', 'danger');
                    }
                } catch (error) {
                    showAlert('Error updating complaint', 'danger');
                }
            }
        }

        // Edit complaint (placeholder function)
        function editComplaint(complaintId) {
            showAlert('Edit functionality will be implemented in the full system', 'info');
        }

        // Update statistics
        function updateStats() {
            // 'Pending Complaints' should show all complaints that are either 'pending' or 'processing'
            const pendingCount = complaints.filter(c => c.status === 'pending' || c.status === 'processing').length;
            const resolvedCount = complaints.filter(c => c.status === 'resolved').length;

            document.getElementById('pendingCount').textContent = pendingCount;
            document.getElementById('resolvedCount').textContent = resolvedCount;
        }

        // Export complaints
        function exportComplaints() {
            const csvContent = generateCSV(filteredComplaints);
            downloadCSV(csvContent, 'complaints_export.csv');
            showAlert('Complaints exported successfully', 'success');
        }

        // Generate CSV content
        function generateCSV(data) {
            const headers = ['ID', 'Student', 'Email', 'Category', 'Subject', 'Status', 'Priority', 'Date', 'Description'];
            const csvRows = [headers.join(',')];

            data.forEach(complaint => {
                const row = [
                    complaint.id,
                    complaint.student,
                    complaint.email,
                    complaint.category,
                    complaint.subject,
                    complaint.status,
                    complaint.priority,
                    complaint.date,
                    `"${complaint.description.replace(/"/g, '""')}"`
                ];
                csvRows.push(row.join(','));
            });

            return csvRows.join('\n');
        }

        // Download CSV file
        function downloadCSV(content, filename) {
            const blob = new Blob([content], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        // Show alert message
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.innerHTML = `
                <i class="fas fa-${getAlertIcon(type)}"></i>
                ${message}
            `;

            // Make alert stretch full width but keep it in the normal flow
            alertDiv.style.width = '100%';
            alertDiv.style.left = '0';
            alertDiv.style.right = '0';
            alertDiv.style.position = 'relative';
            alertDiv.style.textAlign = 'center';
            alertDiv.style.fontSize = '1.15rem';
            alertDiv.style.borderRadius = '0';
            alertDiv.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';
            alertDiv.style.margin = '0 0 1rem 0';
            alertDiv.style.padding = '1.25rem 0.5rem';


            // Insert alert just after the header in main content
            const mainContent = document.getElementById('mainContent');
            const header = mainContent.querySelector('.header');
            if (header && header.nextSibling) {
                // Insert after header
                mainContent.insertBefore(alertDiv, header.nextSibling);
            } else {
                // Fallback: append at top of main content
                mainContent.insertBefore(alertDiv, mainContent.firstChild);
            }

            // Remove after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }

        // Get alert icon based on type
        function getAlertIcon(type) {
            const icons = {
                success: 'check-circle',
                danger: 'exclamation-triangle',
                warning: 'exclamation-triangle',
                info: 'info-circle'
            };
            return icons[type] || 'info-circle';
        }

        // Format category for display
        function formatCategory(category) {
            const categories = {
                academic: 'Academic',
                hostel: 'Hostel',
                facilities: 'Facilities',
                food: 'Food Services',
                other: 'Other'
            };
            return categories[category] || category;
        }

        // Format status for display
        function formatStatus(status) {
            const statuses = {
                pending: 'Pending',
                processing: 'Processing',
                resolved: 'Resolved',
                rejected: 'Rejected'
            };
            return statuses[status] || status;
        }

        // Format priority for display
        function formatPriority(priority) {
            const priorities = {
                low: 'Low',
                medium: 'Medium',
                high: 'High'
            };
            return priorities[priority] || priority;
        }

        // Get status badge class
        function getStatusBadgeClass(status) {
            const classes = {
                pending: 'warning',
                processing: 'info',
                resolved: 'success',
                rejected: 'danger'
            };
            return classes[status] || 'secondary';
        }

        // Get priority badge class
        function getPriorityBadgeClass(priority) {
            const classes = {
                low: 'success',
                medium: 'warning',
                high: 'danger'
            };
            return classes[priority] || 'secondary';
        }

        // Format date for display
        function formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        // Normalize complaint object to ensure all fields exist and fallback for missing/null
        function normalizeComplaint(c) {
            return {
                id: c.id ?? '',
                student: c.student ?? (c.user && c.user.matric_no ? c.user.matric_no : 'Anonymous'),
                email: c.email ?? (c.user && c.user.email ? c.user.email : ''),
                category: c.category ?? '',
                subject: c.subject ?? '',
                status: c.status ?? 'pending',
                priority: c.priority ?? 'medium',
                date: c.date ?? c.created_at ?? '',
                description: c.description ?? '',
                suggested_solution: c.suggested_solution ?? '',
            };
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
    </script>
</body>
</html>
