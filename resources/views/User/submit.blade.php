<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint - RUN CMS</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
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
            <a href="{{ route('user.submit') }}" class="menu-item active">
                <i class="fas fa-plus-circle"></i>
                <span>Submit Complaint</span>
            </a>
            <a href="{{ route('user.view-complaints') }}" class="menu-item">
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
                <a href="{{ route('user.feedback') }}" class="menu-item">
                    <i class="fas fa-comment"></i>
                    <span>Feedback</span>
                </a>
            --}}
            {{--
                <a href="{{ route('user.reviews') }}" class="menu-item">
                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                </a>
            --}}
            {{--
                <a href="{{ route('user.profile-settings') }}" class="menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span>Profile Settings</span>
                </a>
            --}}
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
                    <h1>Submit Complaint</h1>
                </div>
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
        </div>

        <!-- Submit Complaint Form -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <h2 class="card-title">Submit a New Complaint</h2>
                {{-- <div>
                    <span class="badge badge-info">New Submission</span>
                </div> --}}
            </div>
            <div class="card-body">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="alert alert-info mb-3">
                    <p>Please provide as much detail as possible to help us address your complaint effectively.</p>
                </div>

                    <form id="complaint-form" method="POST" action="{{ route('user.complaints.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mb-6"> <!-- Added mb-3 for spacing -->
                                <label for="subject" class="form-label">Subject/Title</label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter complaint title" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mb-6"> <!-- Added mb-3 for spacing -->
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="category" class="form-control" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="academic">Academic</option>
                                    <option value="facility">Facility</option>
                                    <option value="administration">Administration</option>
                                    <option value="security">Security</option>
                                    <option value="hostel">Hostel</option>
                                    <option value="cafeteria">Cafeteria</option>
                                    <option value="it_services">IT Services</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mb-6"> <!-- Added mb-3 for spacing -->
                                <label for="location" class="form-label">Location</label>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Where did this occur?">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mb-6"> <!-- Added mb-3 for spacing -->
                                <label for="date" class="form-label">Date of Incident</label>
                                <input type="date" id="date" name="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Complaint Description</label>
                        <textarea id="description" name="description" class="form-control" rows="6" placeholder="Please provide a detailed description of your complaint..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="suggested-solution" class="form-label">Suggested Solution</label>
                        <textarea id="suggested-solution" name="suggested_solution" class="form-control" rows="3" placeholder="If you have any suggestions on how to resolve this issue..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="urgency" class="form-label">Urgency Level</label>
                                <select id="urgency" name="urgency" class="form-control">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="attachment" class="form-label">Attach Files (optional)</label>
                                <input type="file" id="attachment" name="attachment" class="form-control">
                                <small class="text-grey">Max file size: 5MB. Supported formats: jpg, png, pdf</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-center gap-1">
                            <input type="hidden" name="anonymous" value="0">
                            <input type="checkbox" id="anonymous" name="anonymous" value="1" class="mr-1">
                            <label for="anonymous" class="form-label mb-0">Submit anonymously</label>
                        </div>
                        <small class="text-grey">Note: Anonymous complaints may limit our ability to follow up with you directly.</small>
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-center gap-1">
                            <input type="checkbox" id="terms" name="terms" class="mr-1" required>
                            <label for="terms" class="form-label mb-0">I confirm that the information provided is accurate to the best of my knowledge</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Submit Complaint
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fas fa-times"></i> Clear Form
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Example Complaints Section (to be replaced with dynamic content) -->
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="card-title">Recent Complaints</h2>
            </div>
            <div class="card-body">
                @foreach($complaints as $complaint)
                    <div class="complaint mb-3 p-3 border rounded">
                        <h3 class="h6">{{ $complaint->subject }}</h3>
                        @if(!$complaint->is_anonymous && $complaint->user)
                            <p class="mb-1">Submitted by: {{ $complaint->user->name }}</p>
                        @endif
                        <p class="mb-1"><strong>Category:</strong> {{ ucfirst(str_replace('_', ' ', $complaint->category)) }}</p>
                        <p class="mb-1"><strong>Location:</strong> {{ $complaint->location ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Date:</strong> {{ $complaint->date ? \Carbon\Carbon::parse($complaint->date)->format('F j, Y') : 'N/A' }}</p>
                        <p class="mb-1"><strong>Urgency:</strong> {{ ucfirst($complaint->urgency) }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('user.complaint-detail', $complaint->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-file-alt"></i> View Details
                            </a>
                            @if($complaint->attachment)
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" class="btn btn-sm btn-secondary" download>
                                    <i class="fas fa-download"></i> Download Attachment
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($complaints->isEmpty())
                    <div class="alert alert-info">
                        No complaints found. Submit a complaint to see it listed here.
                    </div>
                @endif
            </div>
        </div>

    <script>
        window.currentUser = {
            name: @json(Auth::user()->name),
            initials: @json(strtoupper(substr(Auth::user()->name, 0, 2)))
        };
    </script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('sidebar-active');
            });


            // Save as draft functionality
            saveDraftBtn.addEventListener('click', function() {
                // Simulate saving draft
                const subject = document.getElementById('subject').value;
                const description = document.getElementById('description').value;

                if (!subject && !description) {
                    alert('Please enter at least a subject or description to save as draft.');
                    return;
                }

                const originalText = saveDraftBtn.innerHTML;
                saveDraftBtn.disabled = true;
                saveDraftBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

                // Simulate API call
                setTimeout(() => {
                    showSuccessMessage('Your draft has been saved successfully!');
                    saveDraftBtn.disabled = false;
                    saveDraftBtn.innerHTML = originalText;
                }, 1000);
            });

            // Function to display success message
            function showSuccessMessage(message) {
                // Check if there's already an alert
                const existingAlert = document.querySelector('.alert-success');
                if (existingAlert) {
                    existingAlert.remove();
                }

                // Create new alert
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success mb-3';
                alertDiv.innerHTML = message;

                // Insert alert before the form
                const formElement = document.getElementById('complaint-form');
                formElement.parentNode.insertBefore(alertDiv, formElement);

                // Auto-remove alert after 5 seconds
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }

            // User profile dropdown (can be expanded later)
            const userProfile = document.getElementById('user-profile');
            userProfile.addEventListener('click', function() {
                // This would typically toggle a dropdown menu
                console.log('User profile clicked');
            });

            // Add example complaints dynamically (would be replaced by actual API calls)
            function loadRecentComplaints() {
                // This would typically fetch data from an API
                console.log('Loading recent complaints');
            }

            loadRecentComplaints();
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
document.addEventListener('DOMContentLoaded', function() {
    // ...existing code...
</script>
</body>
</html>
</html>

<!--
====================================================================
SUBMIT COMPLAINT BLADE STRUCTURE EXPLANATION
====================================================================

1. Sidebar Navigation (<div class="sidebar" id="sidebar">)
   - Contains the university logo and navigation links for the user dashboard.
   - Each <a> tag is a navigation link (Dashboard, Submit Complaint, View Complaints, Logout).
   - Some links are commented out for future features (Complaint Detail, Feedback, Reviews, Profile Settings).

2. Main Content Area (<div class="main-content" id="main-content">)
   - The main container for all complaint submission content.

   a. Header (<div class="header">)
      - Contains the responsive header bar at the top of the page.
      - .d-flex.align-center: Flex container for header layout.
         - .menu-toggle: Hamburger icon for toggling sidebar on mobile/tablet.
         - .header-title: Displays the page title ("Submit Complaint").
      - .header-actions: Shows the user's initials and name in a styled avatar and info block.

   b. Submit Complaint Form Card (<div class="card animate-fadeIn">)
      - Allows the user to submit a new complaint.
      - .card-header: Contains the card title ("Submit a New Complaint").
      - .card-body: Contains the complaint form.
         - Subject, category, location, date, description, suggested solution, urgency, attachment, anonymous, terms.
         - Submit and clear form buttons.
         - Displays success and error messages as needed.

   c. Example Complaints Section (<div class="card mt-4">)
      - Shows a list of recent complaints (for demonstration, to be replaced with dynamic content).
      - Each complaint displays subject, submitter, category, location, date, urgency, and action buttons (view, download).
      - If no complaints exist, an info alert is shown.

3. JavaScript Section (<script> ... </script>)
   - Handles sidebar toggle, draft saving, user profile click, and logout.
   - Functions for showing success messages and loading recent complaints.

====================================================================
This comment is for developer reference. Each section and div is structured for clarity, maintainability, and responsive design. The complaint form is comprehensive and supports file uploads, anonymous submission, and validation.
====================================================================
-->
