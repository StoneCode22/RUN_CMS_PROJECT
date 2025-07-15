<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Complaint Management System | Redeemer's University</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    <!-- Global CSS -->
    <style>
        /* Global CSS from paste.txt */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        :root {
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

          --body-font: 'Poppins', sans-serif;

          --spacing-xs: 0.25rem;
          --spacing-sm: 0.5rem;
          --spacing-md: 1rem;
          --spacing-lg: 1.5rem;
          --spacing-xl: 2rem;

          --border-radius-sm: 4px;
          --border-radius-md: 8px;
          --border-radius-lg: 12px;

          --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
          --shadow-md: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
          --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);

          --sidebar-width: 250px;
          --header-height: 60px;
        }

        body {
          font-family: var(--body-font);
          font-size: 16px;
          line-height: 1.5;
          color: var(--dark-color);
          background-color: var(--very-light-grey);
          min-height: 100vh;
        }

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

        .main-content {
          margin-left: var(--sidebar-width);
          min-height: 100vh;
          padding: var(--spacing-lg);
          transition: all 0.3s ease;
        }

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
          padding-bottom: var(--spacing-md);
          border-bottom: 1px solid var(--light-grey);
        }

        .card-title {
          font-size: 1.25rem;
          font-weight: 500;
          color: var(--primary-color);
        }

        .card-body {
          margin-bottom: var(--spacing-md);
        }

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

        .row {
          display: flex;
          flex-wrap: wrap;
          margin: 0 -15px;
        }

        .col {
          padding: 0 15px;
          flex: 1;
        }

        .col-12 { flex: 0 0 100%; max-width: 100%; }
        .col-6 { flex: 0 0 50%; max-width: 50%; }

        .menu-toggle {
          display: none;
          cursor: pointer;
          font-size: 1.5rem;
          color: var(--primary-color);
        }

        /* Settings-specific styles */
        .settings-nav {
          background-color: var(--white-color);
          border-radius: var(--border-radius-md);
          box-shadow: var(--shadow-sm);
          margin-bottom: var(--spacing-lg);
          overflow: hidden;
        }

        .settings-nav-item {
          display: inline-block;
          padding: var(--spacing-md) var(--spacing-lg);
          cursor: pointer;
          transition: all 0.3s ease;
          border-bottom: 3px solid transparent;
        }

        .settings-nav-item:hover {
          background-color: var(--very-light-grey);
        }

        .settings-nav-item.active {
          background-color: var(--primary-color);
          color: var(--white-color);
          border-bottom-color: var(--secondary-color);
        }

        .settings-section {
          display: none;
        }

        .settings-section.active {
          display: block;
        }

        .toggle-switch {
          position: relative;
          display: inline-block;
          width: 50px;
          height: 24px;
        }

        .toggle-switch input {
          opacity: 0;
          width: 0;
          height: 0;
        }

        .toggle-slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: var(--light-grey);
          transition: 0.4s;
          border-radius: 24px;
        }

        .toggle-slider:before {
          position: absolute;
          content: "";
          height: 18px;
          width: 18px;
          left: 3px;
          bottom: 3px;
          background-color: white;
          transition: 0.4s;
          border-radius: 50%;
        }

        input:checked + .toggle-slider {
          background-color: var(--primary-color);
        }

        input:checked + .toggle-slider:before {
          transform: translateX(26px);
        }

        .setting-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: var(--spacing-md) 0;
          border-bottom: 1px solid var(--light-grey);
        }

        .setting-item:last-child {
          border-bottom: none;
        }

        .setting-info h4 {
          margin-bottom: var(--spacing-sm);
          color: var(--dark-color);
        }

        .setting-info p {
          color: var(--grey-color);
          font-size: 0.9rem;
        }

        /* Responsive */
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

          .menu-toggle {
            display: block;
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

          .settings-nav-item {
            display: block;
            text-align: center;
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
                <div class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Settings</h1>
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

        <!-- Settings Navigation -->
        <div class="settings-nav">
            <div class="settings-nav-item active" data-section="general">
                <i class="fas fa-cog"></i> General
            </div>
            <div class="settings-nav-item" data-section="notifications">
                <i class="fas fa-bell"></i> Notifications
            </div>
            <div class="settings-nav-item" data-section="security">
                <i class="fas fa-shield-alt"></i> Security
            </div>
            <div class="settings-nav-item" data-section="system">
                <i class="fas fa-server"></i> System
            </div>
        </div>

        <!-- General Settings Section -->
        <div class="settings-section active" id="general">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">General Settings</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-12 col-md-12">
                            <form id="generalSettingsForm">
                                <div class="form-group">
                                    <label for="systemName" class="form-label">System Name</label>
                                    <input type="text" id="systemName" class="form-control" value="Complaint Management System">
                                </div>
                                <div class="form-group">
                                    <label for="universityName" class="form-label">University Name</label>
                                    <input type="text" id="universityName" class="form-control" value="Redeemer's University">
                                </div>
                                <div class="form-group">
                                    <label for="adminEmail" class="form-label">Admin Email</label>
                                    <input type="email" id="adminEmail" class="form-control" value="admin@run.edu.ng">
                                </div>
                                <div class="form-group">
                                    <label for="timezone" class="form-label">Timezone</label>
                                    <select id="timezone" class="form-control">
                                        <option value="Africa/Lagos" selected>Africa/Lagos (WAT)</option>
                                        <option value="UTC">UTC</option>
                                        <option value="America/New_York">America/New_York (EST)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="language" class="form-label">Default Language</label>
                                    <select id="language" class="form-control">
                                        <option value="en" selected>English</option>
                                        <option value="yo">Yoruba</option>
                                        <option value="ig">Igbo</option>
                                        <option value="ha">Hausa</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Settings Section -->
        <div class="settings-section" id="notifications">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notification Settings</h3>
                </div>
                <div class="card-body">
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Email Notifications</h4>
                            <p>Receive email notifications for new complaints and system updates</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="emailNotifications" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>SMS Notifications</h4>
                            <p>Receive SMS notifications for urgent complaints</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="smsNotifications">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Desktop Notifications</h4>
                            <p>Show desktop notifications in your browser</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="desktopNotifications" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Daily Summary</h4>
                            <p>Receive daily summary of complaints and activities</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="dailySummary" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="notificationEmail" class="form-label">Notification Email</label>
                        <input type="email" id="notificationEmail" class="form-control" placeholder="Enter notification email">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveNotificationSettings()">
                        <i class="fas fa-save"></i> Save Notification Settings
                    </button>
                </div>
            </div>
        </div>

        <!-- Security Settings Section -->
        <div class="settings-section" id="security">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Security Settings</h3>
                </div>
                <div class="card-body">
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Two-Factor Authentication</h4>
                            <p>Add an extra layer of security to your account</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="twoFactorAuth">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Login Alerts</h4>
                            <p>Get notified when someone logs into your account</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="loginAlerts" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="sessionTimeout" class="form-label">Session Timeout (minutes)</label>
                        <select id="sessionTimeout" class="form-control">
                            <option value="15">15 minutes</option>
                            <option value="30" selected>30 minutes</option>
                            <option value="60">1 hour</option>
                            <option value="120">2 hours</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h4>Change Password</h4>
                        <div class="row">
                            <div class="col col-12">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password" id="currentPassword" class="form-control">
                            </div>
                            <div class="col col-12">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" id="newPassword" class="form-control">
                            </div>
                            <div class="col col-12">
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                <input type="password" id="confirmPassword" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="changePassword()">
                        <i class="fas fa-key"></i> Change Password
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="saveSecuritySettings()">
                        <i class="fas fa-save"></i> Save Security Settings
                    </button>
                </div>
            </div>
        </div>

        <!-- System Settings Section -->
        <div class="settings-section" id="system">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">System Settings</h3>
                </div>
                <div class="card-body">
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Maintenance Mode</h4>
                            <p>Put the system in maintenance mode for updates</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="maintenanceMode">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Auto Backup</h4>
                            <p>Automatically backup system data daily</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="autoBackup" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="maxFileSize" class="form-label">Maximum File Upload Size (MB)</label>
                        <input type="number" id="maxFileSize" class="form-control" value="10" min="1" max="100">
                    </div>
                    <div class="form-group">
                        <label for="dataRetention" class="form-label">Data Retention Period (months)</label>
                        <select id="dataRetention" class="form-control">
                            <option value="12" selected>12 months</option>
                            <option value="24">24 months</option>
                            <option value="36">36 months</option>
                            <option value="0">Indefinite</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h4>System Actions</h4>
                        <button type="button" class="btn btn-secondary" onclick="backupSystem()">
                            <i class="fas fa-download"></i> Backup System
                        </button>
                        <button type="button" class="btn btn-danger" onclick="clearCache()">
                            <i class="fas fa-trash"></i> Clear Cache
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveSystemSettings()">
                        <i class="fas fa-save"></i> Save System Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer"></div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Settings navigation
        const settingsNavItems = document.querySelectorAll('.settings-nav-item');
        const settingsSections = document.querySelectorAll('.settings-section');

        settingsNavItems.forEach(item => {
            item.addEventListener('click', function() {
                const targetSection = this.getAttribute('data-section');

                // Remove active class from all nav items and sections
                settingsNavItems.forEach(nav => nav.classList.remove('active'));
                settingsSections.forEach(section => section.classList.remove('active'));

                // Add active class to clicked nav item and corresponding section
                this.classList.add('active');
                document.getElementById(targetSection).classList.add('active');
            });
        });

        // Show alert function
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                ${message}
            `;

            alertContainer.appendChild(alert);

            // Remove alert after 3 seconds
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }

        // General settings form
        document.getElementById('generalSettingsForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Simulate saving settings
            setTimeout(() => {
                showAlert('General settings saved successfully!');
            }, 500);
        });

        // Save notification settings
        function saveNotificationSettings() {
            const emailNotifications = document.getElementById('emailNotifications').checked;
            const smsNotifications = document.getElementById('smsNotifications').checked;
            const desktopNotifications = document.getElementById('desktopNotifications').checked;
            const dailySummary = document.getElementById('dailySummary').checked;
            const notificationEmail = document.getElementById('notificationEmail').value;

            // Simulate API call
            setTimeout(() => {
                showAlert('Notification settings saved successfully!');
            }, 500);
        }

        // Change password
        function changePassword() {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!currentPassword || !newPassword || !confirmPassword) {
                showAlert('Please fill in all password fields.', 'danger');
                return;
            }

            if (newPassword !== confirmPassword) {
                showAlert('New passwords do not match.', 'danger');
                return;
            }

            if (newPassword.length < 8) {
                showAlert('Password must be at least 8 characters long.', 'danger');
                return;
            }

            // Simulate password change
            setTimeout(() => {
                showAlert('Password changed successfully!');
                // Clear password fields
                document.getElementById('currentPassword').value = '';
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
            }, 500);
        }

        // Save security settings
        function saveSecuritySettings() {
            const twoFactorAuth = document.getElementById('twoFactorAuth').checked;
            const loginAlerts = document.getElementById('loginAlerts').checked;
            const sessionTimeout = document.getElementById('sessionTimeout').value;

            // Simulate API call
            setTimeout(() => {
                showAlert('Security settings saved successfully!');
            }, 500);
        }

        // Save system settings
        function saveSystemSettings() {
            const maintenanceMode = document.getElementById('maintenanceMode').checked;
            const autoBackup = document.getElementById('autoBackup').checked;
            const maxFileSize = document.getElementById('maxFileSize').value;
            const dataRetention = document.getElementById('dataRetention').value;

            // Show warning if maintenance mode is enabled
            if (maintenanceMode) {
                if (confirm('Are you sure you want to enable maintenance mode? This will make the system unavailable to users.')) {
                    setTimeout(() => {
                        showAlert('System settings saved successfully! Maintenance mode is now active.', 'warning');
                    }, 500);
                } else {
                    document.getElementById('maintenanceMode').checked = false;
                    return;
                }
            } else {
                setTimeout(() => {
                    showAlert('System settings saved successfully!');
                }, 500);
            }
        }

        // Backup system
        function backupSystem() {
            if (confirm('This will create a full system backup. Continue?')) {
                showAlert('System backup initiated. This may take several minutes.', 'info');

                // Simulate backup process
                setTimeout(() => {
                    showAlert('System backup completed successfully!');
                }, 3000);
            }
        }

        // Clear cache
        function clearCache() {
            if (confirm('This will clear all system cache. Continue?')) {
                showAlert('Clearing system cache...', 'info');

                // Simulate cache clearing
                setTimeout(() => {
                    showAlert('System cache cleared successfully!');
                }, 1500);
            }
        }

        // Request desktop notification permission
        document.getElementById('desktopNotifications').addEventListener('change', function() {
            if (this.checked) {
                if ('Notification' in window) {
                    if (Notification.permission === 'default') {
                        Notification.requestPermission().then(function(permission) {
                            if (permission !== 'granted') {
                                document.getElementById('desktopNotifications').checked = false;
                                showAlert('Desktop notification permission denied.', 'danger');
                            }
                        });
                    } else if (Notification.permission === 'denied') {
                        this.checked = false;
                        showAlert('Desktop notifications are blocked. Please enable them in your browser settings.', 'danger');
                    }
                } else {
                    this.checked = false;
                    showAlert('Desktop notifications are not supported in this browser.', 'danger');
                }
            }
        });

        // Auto-save functionality for toggle switches
        const toggleSwitches = document.querySelectorAll('.toggle-switch input[type="checkbox"]');
        toggleSwitches.forEach(toggle => {
            toggle.addEventListener('change', function() {
                // Auto-save when toggle is changed (except for maintenance mode and desktop notifications)
                if (this.id !== 'maintenanceMode' && this.id !== 'desktopNotifications') {
                    setTimeout(() => {
                        showAlert(`${this.id} setting updated successfully!`);
                    }, 300);
                }
            });
        });

        // Form validation for file size
        document.getElementById('maxFileSize').addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 1) {
                this.value = 1;
            } else if (value > 100) {
                this.value = 100;
                showAlert('Maximum file size cannot exceed 100MB.', 'warning');
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Check if desktop notifications are already granted
            if ('Notification' in window && Notification.permission === 'granted') {
                document.getElementById('desktopNotifications').checked = true;
            }

            // Load saved settings (simulate)
            loadSettings();
        });

        // Simulate loading settings from server
        function loadSettings() {
            // This would typically make an API call to load current settings
            console.log('Loading settings...');

            // Example of loading saved settings
            const savedSettings = {
                emailNotifications: true,
                smsNotifications: false,
                desktopNotifications: true,
                dailySummary: true,
                twoFactorAuth: false,
                loginAlerts: true,
                maintenanceMode: false,
                autoBackup: true
            };

            // Apply loaded settings to form elements
            Object.keys(savedSettings).forEach(key => {
                const element = document.getElementById(key);
                if (element && element.type === 'checkbox') {
                    element.checked = savedSettings[key];
                }
            });
        }

        // Close alerts when clicked
        document.addEventListener('click', function(e) {
            if (e.target.closest('.alert')) {
                e.target.closest('.alert').remove();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save current section settings
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                const activeSection = document.querySelector('.settings-section.active');
                const sectionId = activeSection.id;

                switch(sectionId) {
                    case 'general':
                        document.getElementById('generalSettingsForm').dispatchEvent(new Event('submit'));
                        break;
                    case 'notifications':
                        saveNotificationSettings();
                        break;
                    case 'security':
                        saveSecuritySettings();
                        break;
                    case 'system':
                        saveSystemSettings();
                        break;
                }
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
