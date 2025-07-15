<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - RUN Complaint Management System</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Additional Feedback Page Specific Styles */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            margin-bottom: var(--spacing-md);
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            font-size: 2rem;
            color: var(--light-grey);
            transition: color 0.2s;
            margin-right: var(--spacing-sm);
        }

        .rating label:hover,
        .rating label:hover ~ label,
        .rating input:checked ~ label {
            color: var(--secondary-color);
        }

        .feedback-categories {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .category-option {
            padding: var(--spacing-sm) var(--spacing-md);
            border: 1px solid var(--light-grey);
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-option:hover {
            background-color: var(--very-light-grey);
        }

        .category-option.selected {
            background-color: var(--primary-color);
            color: var(--white-color);
            border-color: var(--primary-color);
        }

        .feedback-list {
            max-height: 400px;
            overflow-y: auto;
            margin-top: var(--spacing-lg);
        }

        .feedback-item {
            border-bottom: 1px solid var(--light-grey);
            padding: var(--spacing-md) 0;
        }

        .feedback-item:last-child {
            border-bottom: none;
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: var(--spacing-sm);
        }

        .feedback-author {
            font-weight: 500;
        }

        .feedback-date {
            color: var(--grey-color);
            font-size: 0.875rem;
        }

        .feedback-stars {
            color: var(--secondary-color);
            margin-bottom: var(--spacing-sm);
        }

        .feedback-content {
            color: var(--dark-color);
        }

        .feedback-response {
            margin-top: var(--spacing-md);
            padding: var(--spacing-md);
            background-color: var(--very-light-grey);
            border-radius: var(--border-radius-sm);
        }

        .feedback-filters {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
            flex-wrap: wrap;
        }

        /* Mobile sidebar toggle button */
        .mobile-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 200;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: var(--white-color);
            box-shadow: var(--shadow-md);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 992px) {
            .mobile-toggle {
                display: flex;
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
            <a href="#" class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif
        <!-- Header -->
        <div class="header">
            <div class="d-flex align-center gap-2">
                <button id="menuToggle" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-title">
                    <h1>Reviews</h1>
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

        <!-- Submit Feedback Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Submit Your Review</h2>
            </div>
            <div class="card-body">
                <form id="feedbackForm" method="POST" action="{{ route('user.submit-review') }}">
                    @csrf
                    <input type="hidden" name="complaint_id" value="{{ $complaint_id }}">
                    <div class="form-group">
                        <label class="form-label">Rate your experience</label>
                        <div class="rating">
                            <input type="radio" name="rating" id="star5" value="5">
                            <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" id="star4" value="4">
                            <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" id="star3" value="3">
                            <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" id="star2" value="2">
                            <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" id="star1" value="1">
                            <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Select Category <span style="color:red"></span></label>
                        <div class="feedback-categories">
                            <div class="category-option" data-category="usability">Usability</div>
                            <div class="category-option" data-category="response-time">Response Time</div>
                            <div class="category-option" data-category="resolution">Resolution Quality</div>
                            <div class="category-option" data-category="staff">Staff Interaction</div>
                            <div class="category-option" data-category="system">System Performance</div>
                        </div>
                        <input type="hidden" name="category" id="selectedCategoryInput" required>
                        <div id="categoryError" style="color:red;display:none;font-size:0.95em;">Please select a category.</div>
                    </div>

                    <div class="form-group">
                        <label for="feedbackTitle" class="form-label">Feedback Title</label>
                        <input type="text" id="feedbackTitle" name="feedbackTitle" class="form-control" placeholder="Enter a title for your feedback">
                    </div>

                    <div class="form-group">
                        <label for="feedbackDescription" class="form-label">Your Feedback</label>
                        <textarea id="feedbackDescription" name="feedbackDescription" class="form-control" rows="5" placeholder="Provide your detailed feedback here..."></textarea>
                    </div>

                    <div class="form-group">
                        <!-- Removed duplicate hidden input for category -->
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Sample feedback data (would normally come from backend)
        const feedbackData = [
            {
                id: 1,
                author: "Sarah Johnson",
                date: "2025-05-15",
                rating: 5,
                category: "usability",
                title: "Great User Interface",
                content: "The complaint management system is very intuitive and easy to use. I was able to submit my complaint and track its progress without any issues.",
                response: {
                    author: "Admin",
                    content: "Thank you for your positive feedback! We're glad you found the system easy to use."
                }
            },
            {
                id: 2,
                author: "Michael Chen",
                date: "2025-05-14",
                rating: 4,
                category: "response-time",
                title: "Quick Resolution",
                content: "My complaint was addressed within 24 hours. I'm very impressed with the response time of the support team.",
                response: null
            },
            {
                id: 3,
                author: "Aisha Patel",
                date: "2025-05-12",
                rating: 3,
                category: "resolution",
                title: "Room for Improvement",
                content: "While my issue was resolved, I think the solution could have been better. There are still some aspects that need to be addressed.",
                response: {
                    author: "Support Team",
                    content: "We appreciate your feedback and will continue to work on improving our resolution process. Would you mind providing more specific details so we can address your concerns better?"
                }
            },
            {
                id: 4,
                author: "James Wilson",
                date: "2025-05-10",
                rating: 2,
                category: "staff",
                title: "Staff Could Be More Helpful",
                content: "The staff was not very helpful in understanding my issue. I had to explain multiple times what the problem was.",
                response: {
                    author: "Management",
                    content: "We apologize for your experience. We're implementing additional training for our staff to better handle complex issues. Thank you for bringing this to our attention."
                }
            }
        ];

        // DOM Elements
        const sidebarToggle = document.getElementById('menuToggle');
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const feedbackForm = document.getElementById('feedbackForm');
        const feedbackList = document.getElementById('feedbackList');
        const categoryOptions = document.querySelectorAll('.category-option');
        const categoryFilter = document.getElementById('categoryFilter');
        const ratingFilter = document.getElementById('ratingFilter');

        // Toggle sidebar on mobile
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-active');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileSidebarToggle.addEventListener('click', toggleSidebar);

        // Render feedback list
        function renderFeedbackList(feedback) {
            feedbackList.innerHTML = '';

            if (feedback.length === 0) {
                feedbackList.innerHTML = '<p class="text-center">No feedback found matching your filters.</p>';
                return;
            }

            feedback.forEach(item => {
                const stars = '★'.repeat(item.rating) + '☆'.repeat(5 - item.rating);
                const categoryDisplay = getCategoryDisplay(item.category);

                let feedbackHtml = `
                    <div class="feedback-item">
                        <div class="feedback-header">
                            <span class="feedback-author">${item.author}</span>
                            <span class="feedback-date">${formatDate(item.date)}</span>
                        </div>
                        <div class="d-flex justify-between mb-1">
                            <div class="feedback-stars">${stars}</div>
                            <div><span class="badge badge-primary">${categoryDisplay}</span></div>
                        </div>
                        <h4 class="mb-1">${item.title}</h4>
                        <p class="feedback-content">${item.content}</p>
                `;

                if (item.response) {
                    feedbackHtml += `
                        <div class="feedback-response">
                            <strong>${item.response.author} Response:</strong>
                            <p>${item.response.content}</p>
                        </div>
                    `;
                }

                feedbackHtml += `</div>`;
                feedbackList.innerHTML += feedbackHtml;
            });
        }

        // Format date
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        // Get category display name
        function getCategoryDisplay(category) {
            const categories = {
                'usability': 'Usability',
                'response-time': 'Response Time',
                'resolution': 'Resolution Quality',
                'staff': 'Staff Interaction',
                'system': 'System Performance'
            };
            return categories[category] || category;
        }

        // Filter feedback
        function filterFeedback() {
            const categoryValue = categoryFilter.value;
            const ratingValue = ratingFilter.value;

            let filteredData = [...feedbackData];

            if (categoryValue !== 'all') {
                filteredData = filteredData.filter(item => item.category === categoryValue);
            }

            if (ratingValue !== 'all') {
                filteredData = filteredData.filter(item => item.rating === parseInt(ratingValue));
            }

            renderFeedbackList(filteredData);
        }

        // Event listeners for filters
        categoryFilter.addEventListener('change', filterFeedback);
        ratingFilter.addEventListener('change', filterFeedback);

        // --- CATEGORY BUTTONS CLICKABLE LOGIC ---
    var categoryOptions = document.querySelectorAll('.category-option');
    var categoryInput = document.getElementById('selectedCategoryInput');
    var categoryError = document.getElementById('categoryError');
    categoryOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            categoryOptions.forEach(function(opt) { opt.classList.remove('selected'); });
            this.classList.add('selected');
            categoryInput.value = this.dataset.category;
            if (categoryError) categoryError.style.display = 'none';
        });
    });

    // Validate category selection before submitting
    var feedbackForm = document.getElementById('feedbackForm');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            var selectedCategory = categoryInput.value;
            if (!selectedCategory) {
                if (categoryError) categoryError.style.display = 'block';
                e.preventDefault();
                return false;
            }
        });
    }

        // Initial render
        document.addEventListener('DOMContentLoaded', function() {
            renderFeedbackList(feedbackData);
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

    <script>
    // --- CATEGORY BUTTONS CLICKABLE LOGIC ---
    var categoryOptions = document.querySelectorAll('.category-option');
    var categoryInput = document.getElementById('selectedCategoryInput');
    var categoryError = document.getElementById('categoryError');
    categoryOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            categoryOptions.forEach(function(opt) { opt.classList.remove('selected'); });
            this.classList.add('selected');
            categoryInput.value = this.dataset.category;
            if (categoryError) categoryError.style.display = 'none';
        });
    });

    // Validate category selection before submitting
    var feedbackForm = document.getElementById('feedbackForm');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            var selectedCategory = categoryInput.value;
            if (!selectedCategory) {
                if (categoryError) categoryError.style.display = 'block';
                e.preventDefault();
                return false;
            }
        });
    }
</script>
</body>
</html>
</html>

<!--
====================================================================
REVIEWS BLADE STRUCTURE EXPLANATION
====================================================================

1. Sidebar Navigation (<div class="sidebar" id="sidebar">)
   - Contains the university logo and navigation links for the user dashboard.
   - Each <a> tag is a navigation link (Dashboard, Submit Complaint, View Complaints, Logout).

2. Main Content Area (<div class="main-content" id="main-content">)
   - The main container for all review-related content.

   a. Header (<div class="header">)
      - Contains the responsive header bar at the top of the page.
      - .d-flex.align-center.gap-2: Flex container for header layout.
         - .menu-toggle: Hamburger icon for toggling sidebar on mobile/tablet.
         - .header-title: Displays the page title ("Reviews").
      - .header-actions: Shows the user's initials and name in a styled avatar and info block.

   b. Submit Feedback Card (<div class="card">)
      - Allows the user to submit a new review for a complaint.
      - .card-header: Contains the card title ("Submit Your Review").
      - .card-body: Contains the feedback form.
         - Star rating input (1-5 stars).
         - Category selection (Usability, Response Time, etc.).
         - Feedback title and description fields.
         - Submit button.

   c. Feedback List (rendered by JavaScript)
      - Displays a list of feedback/reviews (sample data in JS, would be dynamic in production).
      - Each feedback item shows author, date, rating, category, title, content, and any admin response.

3. JavaScript Section (<script> ... </script>)
   - Handles sidebar toggle, feedback rendering, filtering, category selection, form validation, and logout.
   - Sample feedback data is provided for demonstration.
   - Functions for rendering feedback, formatting dates, filtering, and handling UI interactions.

4. Style Section (<style> ... </style>)
   - Contains custom CSS for ratings, categories, feedback list, cards, sidebar, header, and responsive adjustments.

====================================================================
This comment is for developer reference. Each section and div is structured for clarity, maintainability, and responsive design. The feedback list and form are interactive and update based on user actions.
====================================================================
-->
