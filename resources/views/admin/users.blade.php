<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - Redeemer's University Complaint System</title>
    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Link to global CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Additional CSS specific to users page */
        .search-filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            align-items: center;
            justify-content: space-between;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 250px;
        }

        .search-box input {
            padding-left: 2.5rem;
        }

        .search-box i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--grey-color);
        }

        .filter-controls {
            display: flex;
            gap: var(--spacing-sm);
            flex-wrap: wrap;
        }

        .user-avatar-large {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--white-color);
        }

        .user-details {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }

        .user-info-table {
            flex: 1;
        }

        .user-info-table h4 {
            margin-bottom: 0.25rem;
            color: var(--primary-color);
        }

        .user-meta {
            font-size: 0.875rem;
            color: var(--grey-color);
            margin-bottom: 0.125rem;
        }

        .action-buttons {
            display: flex;
            gap: var(--spacing-sm);
            flex-wrap: wrap;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: var(--white-color);
            border-radius: var(--border-radius-md);
            padding: var(--spacing-xl);
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--grey-color);
        }

        .form-row {
            display: flex;
            gap: var(--spacing-md);
        }

        .form-row .form-group {
            flex: 1;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-lg);
        }

        .pagination button {
            border: none;
            background-color: var(--white-color);
            color: var(--primary-color);
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination button:hover {
            background-color: var(--primary-color);
            color: var(--white-color);
        }

        .pagination button.active {
            background-color: var(--primary-color);
            color: var(--white-color);
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: var(--spacing-xl);
            color: var(--grey-color);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: var(--spacing-md);
        }

        @media (max-width: 768px) {
            .search-filter-container {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-controls {
                justify-content: center;
            }

            .user-details {
                flex-direction: column;
                text-align: center;
            }

            .action-buttons {
                justify-content: center;
            }

            .form-row {
                flex-direction: column;
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
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1>Users Management</h1>
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

        <!-- Users Statistics -->
        <div class="row">
            <div class="col col-md-6 col-sm-12">
                <div class="card">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--primary-color);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="totalUsers">0</h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6 col-sm-12">
                <div class="card">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: var(--success-color);">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stats-info">
                            <h3 id="activeUsers">0</h3>
                            <p>Active Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Management Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">All Users</h2>
                {{-- <button class="btn btn-primary" onclick="openAddUserModal()">
                    <i class="fas fa-plus"></i>
                    Add New User
                </button> --}}
            </div>

            <!-- Search and Filter Controls -->
            <div class="search-filter-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search users by name, email, or student ID...">
                </div>
                <div class="filter-controls">
                    {{-- <select class="form-control" id="roleFilter">
                        <option value="">All Roles</option>
                        <option value="student">Student</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select> --}}
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-container">
                <table class="table" id="usersTable">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th>Date Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <!-- Users will be populated here by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="fas fa-users"></i>
                <h3>No users found</h3>
                <p>Try adjusting your search criteria or add a new user.</p>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <!-- Pagination will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Add New User</h3>
                <button class="modal-close" onclick="closeUserModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="userForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Student/Staff ID</label>
                        <input type="text" class="form-control" id="userId">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select class="form-control" id="role" required>
                            <option value="">Select Role</option>
                            <option value="student">Student</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" id="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Department/Faculty</label>
                    <input type="text" class="form-control" id="department">
                </div>
                <div class="d-flex justify-between gap-2 mt-3">
                    <button type="button" class="btn btn-secondary" onclick="closeUserModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fetch users from backend
        let users = [];
        let filteredUsers = [];
        let currentPage = 1;
        const usersPerPage = 10;
        let editingUserId = null;

        async function fetchUsers() {
            try {
                const response = await fetch('/admin/users-list');
                if (!response.ok) throw new Error('Failed to fetch users');
                const data = await response.json();
                users = Array.isArray(data) ? data.map(u => normalizeUser(u)) : [];
                filteredUsers = [...users];
                updateStats();
                renderUsers();
            } catch (error) {
                document.getElementById('usersTableBody').innerHTML = `<tr><td colspan="5" class="text-center text-danger">Failed to fetch users</td></tr>`;
                document.getElementById('emptyState').style.display = 'block';
            }
        }

        // ...existing code...

        // Initialize page
        function initializePage() {
            fetchUsers();
            setupEventListeners();
        }
        // Normalize user object from backend
        function normalizeUser(u) {
            return {
                id: u.id ?? '',
                firstName: u.first_name ?? u.firstName ?? '',
                lastName: u.last_name ?? u.lastName ?? '',
                email: u.email ?? '',
                userId: u.matric_no ?? u.staff_id ?? u.userId ?? '',
                phone: u.phone ?? '',
                role: u.role ?? '',
                status: u.status ?? 'active',
                department: u.department ?? u.faculty ?? '',
                createdAt: u.created_at ?? u.createdAt ?? '',
                avatar: (u.first_name ?? u.firstName ?? '').charAt(0).toUpperCase() + (u.last_name ?? u.lastName ?? '').charAt(0).toUpperCase()
            };
        }

        // Update statistics
        function updateStats() {
            document.getElementById('totalUsers').textContent = users.length;
            document.getElementById('activeUsers').textContent = users.filter(u => u.status === 'active').length;
        }

        // Setup event listeners
        function setupEventListeners() {
            document.getElementById('searchInput').addEventListener('input', function() {
                filterUsers();
            });
            // If roleFilter exists, add event listener
            var roleFilter = document.getElementById('roleFilter');
            if (roleFilter) {
                roleFilter.addEventListener('change', filterUsers);
            }
            var statusFilter = document.getElementById('statusFilter');
            if (statusFilter) {
                statusFilter.addEventListener('change', function() {
                    // If "All Status" is selected, show all users
                    if (statusFilter.value === '') {
                        filteredUsers = [...users];
                        currentPage = 1;
                        renderUsers();
                    } else {
                        filterUsers();
                    }
                });
            }
            document.getElementById('userForm').addEventListener('submit', handleUserSubmit);
            document.getElementById('menuToggle').addEventListener('click', toggleSidebar);
        }

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-active');
        }

        // Filter users
        function filterUsers() {
            const searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
            const roleFilter = document.getElementById('roleFilter') ? document.getElementById('roleFilter').value : '';
            const statusFilter = document.getElementById('statusFilter').value;

            filteredUsers = users.filter(user => {
                let matchesSearch = true;
                if (searchTerm) {
                    matchesSearch = (
                        (user.firstName && user.firstName.toLowerCase().includes(searchTerm)) ||
                        (user.lastName && user.lastName.toLowerCase().includes(searchTerm)) ||
                        (user.email && user.email.toLowerCase().includes(searchTerm)) ||
                        (user.userId && user.userId.toLowerCase().includes(searchTerm))
                    );
                }
                const matchesRole = !roleFilter || user.role === roleFilter;
                const matchesStatus = !statusFilter || user.status === statusFilter;
                return matchesSearch && matchesRole && matchesStatus;
            });
            currentPage = 1;
            renderUsers();
        }

        // Render users table
        function renderUsers() {
            const tableBody = document.getElementById('usersTableBody');
            const emptyState = document.getElementById('emptyState');

            if (filteredUsers.length === 0) {
                tableBody.innerHTML = '';
                emptyState.style.display = 'block';
                document.getElementById('pagination').innerHTML = '';
                return;
            }

            emptyState.style.display = 'none';

            const startIndex = (currentPage - 1) * usersPerPage;
            const endIndex = startIndex + usersPerPage;
            const paginatedUsers = filteredUsers.slice(startIndex, endIndex);

            tableBody.innerHTML = paginatedUsers.map(user => `
                <tr>
                    <td>
                        <div class="user-details">
                            <div class="user-avatar-large" style="background-color: ${getAvatarColor(user.role)};">
                                ${user.avatar}
                            </div>
                            <div class="user-info-table">
                                <h4>${user.firstName} ${user.lastName}</h4>
                                <div class="user-meta">${user.email}</div>
                                <div class="user-meta">ID: ${user.userId}</div>
                                <div class="user-meta">${user.department}</div>
                                <div class="user-meta">${user.phone}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="status status-${user.status === 'active' ? 'resolved' : 'rejected'}"></span>
                        <span class="badge badge-${user.status === 'active' ? 'success' : 'danger'}">
                            ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                        </span>
                    </td>
                    <td>${formatDate(user.createdAt)}</td>
                    <td>
                        <div class="action-buttons">
                        <button class="btn btn-sm btn-secondary" onclick="editUser(${user.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="toggleUserStatus(${user.id})">
                            <i class="fas fa-exchange-alt"></i> ${user.status === 'active' ? 'Deactivate' : 'Activate'}
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                        </div>
                    </td>
                </tr>
            `).join('');

            renderPagination();
        }

        // Render pagination
        function renderPagination() {
            const totalPages = Math.ceil(filteredUsers.length / usersPerPage);
            const pagination = document.getElementById('pagination');

            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let paginationHTML = `
                <button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
                    <i class="fas fa-chevron-left"></i>
                </button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
                    <button onclick="changePage(${i})" ${i === currentPage ? 'class="active"' : ''}>
                        ${i}
                    </button>
                `;
            }

            paginationHTML += `
                <button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
                    <i class="fas fa-chevron-right"></i>
                </button>
            `;

            pagination.innerHTML = paginationHTML;
        }

        // Change page
        function changePage(page) {
            const totalPages = Math.ceil(filteredUsers.length / usersPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderUsers();
            }
        }

        // Helper functions
        function getAvatarColor(role) {
            const colors = {
                'student': '#1e3a8a',
                'staff': '#ff9800',
                'admin': '#f44336'
            };
            return colors[role] || '#757575';
        }

        function getRoleBadgeColor(role) {
            const colors = {
                'student': 'primary',
                'staff': 'warning',
                'admin': 'danger'
            };
            return colors[role] || 'secondary';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        // Modal functions
        function openAddUserModal() {
            editingUserId = null;
            document.getElementById('modalTitle').textContent = 'Add New User';
            document.getElementById('userForm').reset();
            document.getElementById('userModal').classList.add('active');
        }

        function editUser(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;
            editingUserId = userId;
            document.getElementById('modalTitle').textContent = 'Edit User';
            document.getElementById('firstName').value = user.firstName;
            document.getElementById('lastName').value = user.lastName;
            document.getElementById('email').value = user.email;
            document.getElementById('userId').value = user.userId;
            document.getElementById('phone').value = user.phone;
            document.getElementById('role').value = user.role;
            document.getElementById('status').value = user.status;
            document.getElementById('department').value = user.department;
            document.getElementById('password').value = '';
            document.getElementById('userModal').classList.add('active');
            // Change button text to "Update User"
            const submitBtn = document.querySelector('#userForm button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Update User';
            document.getElementById('status').disabled = false;
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.remove('active');
            editingUserId = null;
        }

        function handleUserSubmit(e) {
            e.preventDefault();

            const userData = {
                first_name: document.getElementById('firstName').value,
                last_name: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                user_id: document.getElementById('userId').value,
                phone: document.getElementById('phone').value,
                role: document.getElementById('role').value,
                status: document.getElementById('status').value,
                department: document.getElementById('department').value,
                password: document.getElementById('password') ? document.getElementById('password').value : undefined
            };

            if (editingUserId) {
                // Update user in backend
                fetch(`/admin/update-user/${editingUserId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(userData)
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to update user');
                    return response.json();
                })
                .then(updatedUser => {
                    // Update local user list
                    const userIndex = users.findIndex(u => u.id === editingUserId);
                    users[userIndex] = normalizeUser(updatedUser);
                    updateStats();
                    filterUsers();
                    closeUserModal();
                    alert('User updated successfully.');
                })
                .catch(() => {
                    alert('Error updating user. Please try again.');
                });
            } else {
                // Add new user (optional, not requested)
                // ...existing code...
            }
        }

        function toggleUserStatus(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;
            const newStatus = user.status === 'active' ? 'inactive' : 'active';
            fetch(`/admin/toggle-user-status/${userId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to update status');
                // Update user status locally
                user.status = newStatus;
                // Always show all users after status change
                filteredUsers = [...users];
                updateStats();
                renderUsers();
                alert('User status updated successfully.');
            })
            .catch(() => {
                alert('Error updating user status. Please try again.');
            });
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                fetch(`/admin/delete-user/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to delete user');
                    // Remove user from local arrays
                    users = users.filter(u => u.id !== userId);
                    filteredUsers = filteredUsers.filter(u => u.id !== userId);
                    updateStats();
                    renderUsers();
                    alert('User deleted successfully.');
                })
                .catch(error => {
                    alert('Error deleting user. Please try again.');
                });
            }
        }

        // Initialize page when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializePage);

        // Close modal when clicking outside
        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserModal();
            }
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
