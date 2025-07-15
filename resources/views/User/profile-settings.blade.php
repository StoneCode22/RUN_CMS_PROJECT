<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - Complaint Management System</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Additional styles for profile settings page */
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--white-color);
            margin-bottom: var(--spacing-md);
            position: relative;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-upload {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            padding: var(--spacing-xs);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-upload:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .image-upload label {
            color: var(--white-color);
            cursor: pointer;
            font-size: 0.8rem;
        }

        .image-upload input[type="file"] {
            display: none;
        }

        .section-divider {
            margin: var(--spacing-lg) 0;
            border-top: 1px solid var(--light-grey);
            padding-top: var(--spacing-md);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .form-col {
            flex: 1;
            min-width: 250px;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--grey-color);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .profile-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
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
            <a href="{{ route ('user.view-complaints') }}" class="menu-item">
                <i class="fas fa-list-alt"></i>
                <span>View Complaints</span>
            </a>
            {{-- Remove or update this link: complaint ID required --}}
                <i class="fas fa-file-alt"></i>
                <span>Complaint Detail</span>
            </a>
            {{-- <a href="{{ route ('user.feedback') }}" class="menu-item">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a> --}}
            {{-- <a href="{{ route ('user.reviews') }}" class="menu-item">
                <i class="fas fa-star"></i>
                <span>Reviews</span>
            </a> --}}
            <a href="{{ route ('user.profile-settings') }}" class="menu-item active">
                <i class="fas fa-user-cog"></i>
                <span>Profile Settings</span>
            </a>
            <a href="#" class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Header -->
        <header class="header">
            <div class="header-title">
                <h1>Profile Settings</h1>
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
                    </div>
                </div>
            </div>
        </header>

        <!-- Profile Settings Content -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Personal Information</h2>
                <button class="btn btn-primary btn-sm" id="save-profile-btn">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
            </div>
            <div class="card-body">
                <div class="d-flex gap-3 profile-section mb-3">
                    <div class="profile-image">
                        <div id="profile-preview">JS</div>
                        <div class="image-upload">
                            <label for="profile-upload">
                                <i class="fas fa-camera"></i> Change
                            </label>
                            <input type="file" id="profile-upload" accept="image/*">
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-1">John Smith</h3>
                        <p class="text-grey">Student ID: RUN/STU/2022/12345</p>
                        <p class="text-grey">Department: Computer Science</p>
                    </div>
                </div>

                <form id="profile-form">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="first-name">First Name</label>
                                <input type="text" class="form-control" id="first-name" value="John">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="last-name">Last Name</label>
                                <input type="text" class="form-control" id="last-name" value="Smith">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" value="johnsmith@run.edu.ng">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" value="+234 801 234 5678">
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    <h3 class="mb-2">Account Settings</h3>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" value="johnsmith">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="department">Department</label>
                                <select class="form-control" id="department">
                                    <option>Computer Science</option>
                                    <option>Mass Communication</option>
                                    <option>Mechanical Engineering</option>
                                    <option>Accounting</option>
                                    <option>Medicine</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    <h3 class="mb-2">Change Password</h3>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group password-field">
                                <label class="form-label" for="current-password">Current Password</label>
                                <input type="password" class="form-control" id="current-password">
                                <span class="password-toggle" data-target="current-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group password-field">
                                <label class="form-label" for="new-password">New Password</label>
                                <input type="password" class="form-control" id="new-password">
                                <span class="password-toggle" data-target="new-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group password-field">
                                <label class="form-label" for="confirm-password">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm-password">
                                <span class="password-toggle" data-target="confirm-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    <h3 class="mb-2">Notification Preferences</h3>

                    <div class="form-group">
                        <div class="d-flex align-center gap-2 mb-2">
                            <input type="checkbox" id="email-notifications" checked>
                            <label for="email-notifications">Email notifications for complaint updates</label>
                        </div>
                        <div class="d-flex align-center gap-2 mb-2">
                            <input type="checkbox" id="sms-notifications">
                            <label for="sms-notifications">SMS notifications for complaint updates</label>
                        </div>
                        <div class="d-flex align-center gap-2">
                            <input type="checkbox" id="feedback-notifications" checked>
                            <label for="feedback-notifications">Notifications for feedback responses</label>
                        </div>
                    </div>

                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" id="cancel-btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="save-btn">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    mainContent.classList.toggle('sidebar-active');
                });
            }

            // Password visibility toggle
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordField = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordField.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Profile image upload preview
            const profileUpload = document.getElementById('profile-upload');
            const profilePreview = document.getElementById('profile-preview');

            if (profileUpload) {
                profileUpload.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Image">`;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Form submission handling
            const profileForm = document.getElementById('profile-form');
            const saveBtn = document.getElementById('save-btn');
            const saveProfileBtn = document.getElementById('save-profile-btn');
            const cancelBtn = document.getElementById('cancel-btn');

            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    saveProfile();
                });
            }

            if (saveProfileBtn) {
                saveProfileBtn.addEventListener('click', function() {
                    saveProfile();
                });
            }

            if (cancelBtn) {
                cancelBtn.addEventListener('click', function() {
                    // Reload the page to reset form
                    location.reload();
                });
            }

            function saveProfile() {
                // Create notification after saving
                const notification = document.createElement('div');
                notification.className = 'alert alert-success animate-fadeIn';
                notification.innerHTML = 'Profile updated successfully!';

                // Add notification at top of card body
                const cardBody = document.querySelector('.card-body');
                cardBody.insertBefore(notification, cardBody.firstChild);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);

                // In a real app, you would send the form data to the server here
                console.log('Profile saved');
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
