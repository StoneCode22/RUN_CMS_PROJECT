<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Detail - RUN Complaint Management System</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>

    // complaint-detail.js - Functionality for Complaint Detail Page
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-active');
        });
    }

    // Handle comment submission
    const commentForm = document.getElementById('submit-comment');
    const commentInput = document.getElementById('new-comment');
    const commentsContainer = document.getElementById('complaint-comments');

    if (commentForm && commentInput) {
        commentForm.addEventListener('click', function() {
            const commentText = commentInput.value.trim();

            if (commentText) {
                // Create new comment element
                const newComment = createCommentElement(commentText);

                // Add the new comment to the comments container
                commentsContainer.appendChild(newComment);

                // Clear the comment input
                commentInput.value = '';

                // Show success message
                showNotification('Comment posted successfully', 'success');
            } else {
                showNotification('Please enter a comment', 'warning');
            }
        });
    }

    // File upload display
    const fileInput = document.getElementById('comment-attachment');
    const fileNameDisplay = document.getElementById('file-name');

    if (fileInput && fileNameDisplay) {
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = fileInput.files[0].name;
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    }

    // Escalate button functionality
    const escalateBtn = document.getElementById('escalate-btn');
    const escalationModal = document.getElementById('escalation-modal');

    if (escalateBtn && escalationModal) {
        escalateBtn.addEventListener('click', function() {
            openModal(escalationModal);
        });
    }

    // Confirm escalation
    const confirmEscalateBtn = document.getElementById('confirm-escalate');

    if (confirmEscalateBtn) {
        confirmEscalateBtn.addEventListener('click', function() {
            const reason = document.getElementById('escalation-reason').value;
            const level = document.getElementById('escalation-level').value;

            if (reason.trim() === '') {
                showNotification('Please provide a reason for escalation', 'warning');
                return;
            }

            // Handle the escalation logic here
            // For now, just close the modal and show success message
            closeModal(escalationModal);
            showNotification('Complaint escalated successfully', 'success');

            // Update status badge
            updateComplaintStatus('escalated');

            // Add to timeline
            addTimelineEvent('Complaint Escalated',
                             getCurrentDateTime(),
                             `Complaint escalated to ${level} level. Reason: ${reason}`);
        });
    }

    // Update button functionality
    const updateBtn = document.getElementById('update-btn');

    if (updateBtn) {
        updateBtn.addEventListener('click', function() {
            // Redirect to update page
            // For demo purposes, just show a notification
            showNotification('Redirecting to update page...', 'info');
            setTimeout(() => {
                // This would normally redirect to the update page
                showNotification('This would redirect to the update page in a real implementation', 'info');
            }, 2000);
        });
    }

    // Resolve button functionality
    const resolveBtn = document.getElementById('resolve-btn');
    const confirmationModal = document.getElementById('confirmation-modal');

    if (resolveBtn && confirmationModal) {
        resolveBtn.addEventListener('click', function() {
            // Set up the confirmation modal
            document.getElementById('confirm-title').textContent = 'Mark as Resolved';
            document.getElementById('confirm-message').textContent =
                'Are you sure you want to mark this complaint as resolved? This action will close the complaint.';

            const confirmBtn = document.getElementById('confirm-action');

            // Remove previous event listeners
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

            // Add new event listener
            newConfirmBtn.addEventListener('click', function() {
                // Handle resolution logic
                closeModal(confirmationModal);
                updateComplaintStatus('resolved');
                showNotification('Complaint marked as resolved', 'success');

                // Add to timeline
                addTimelineEvent('Complaint Resolved',
                                 getCurrentDateTime(),
                                 'Complaint has been successfully resolved.');

                // Disable certain buttons
                resolveBtn.disabled = true;
                escalateBtn.disabled = true;
            });

            openModal(confirmationModal);
        });
    }

    // Delete button functionality
    const deleteBtn = document.getElementById('delete-btn');

    if (deleteBtn && confirmationModal) {
        deleteBtn.addEventListener('click', function() {
            // Set up the confirmation modal
            document.getElementById('confirm-title').textContent = 'Delete Complaint';
            document.getElementById('confirm-message').textContent =
                'Are you sure you want to delete this complaint? This action cannot be undone.';

            const confirmBtn = document.getElementById('confirm-action');
            confirmBtn.className = 'btn btn-danger';

            // Remove previous event listeners
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

            // Add new event listener
            newConfirmBtn.addEventListener('click', function() {
                // Handle delete logic
                closeModal(confirmationModal);
                showNotification('Complaint deleted successfully', 'success');

                // In a real implementation, this would redirect to the complaints list
                setTimeout(() => {
                    showNotification('Redirecting to complaints list...', 'info');
                }, 2000);
            });

            openModal(confirmationModal);
        });
    }

    // Close modals when clicking on close button or outside the modal
    const closeButtons = document.querySelectorAll('.close-modal');
    const modals = document.querySelectorAll('.modal');

    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = button.closest('.modal');
            closeModal(modal);
        });
    });

    window.addEventListener('click', function(event) {
        modals.forEach(modal => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });
    });

    // Initialize logout functionality
    const logoutBtn = document.getElementById('logout-btn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Set up the confirmation modal
            document.getElementById('confirm-title').textContent = 'Logout Confirmation';
            document.getElementById('confirm-message').textContent =
                'Are you sure you want to logout?';

            const confirmBtn = document.getElementById('confirm-action');

            // Remove previous event listeners
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

            // Add new event listener
            newConfirmBtn.addEventListener('click', function() {
                // Handle logout logic
                closeModal(confirmationModal);
                showNotification('Logging out...', 'info');

                // In a real implementation, this would redirect to the login page
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 2000);
            });

            openModal(confirmationModal);
        });
    }
});

// Utility Functions

// Function to create a comment element
function createCommentElement(text) {
    const commentDiv = document.createElement('div');
    commentDiv.className = 'comment user-comment';

    const avatar = document.createElement('div');
    avatar.className = 'comment-avatar';
    avatar.textContent = 'JD'; // This would come from logged in user

    const content = document.createElement('div');
    content.className = 'comment-content';

    const header = document.createElement('div');
    header.className = 'comment-header';

    const name = document.createElement('h4');
    name.textContent = 'John Doe'; // This would come from logged in user

    const timestamp = document.createElement('span');
    timestamp.className = 'text-grey';
    timestamp.textContent = getCurrentDateTime();

    const commentText = document.createElement('p');
    commentText.textContent = text;

    header.appendChild(name);
    header.appendChild(timestamp);

    content.appendChild(header);
    content.appendChild(commentText);

    commentDiv.appendChild(avatar);
    commentDiv.appendChild(content);

    return commentDiv;
}

// Function to get current date and time for comments and events
function getCurrentDateTime() {
    const now = new Date();
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const month = months[now.getMonth()];
    const date = now.getDate();
    const year = now.getFullYear();

    let hours = now.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Convert 0 to 12

    const minutes = now.getMinutes().toString().padStart(2, '0');

    return `${month} ${date}, ${year} - ${hours}:${minutes} ${ampm}`;
}

// Function to update complaint status
function updateComplaintStatus(status) {
    const statusBadge = document.getElementById('complaint-status-badge');
    const statusIndicator = statusBadge.querySelector('.status');

    // Remove all status classes
    statusIndicator.classList.remove('status-pending', 'status-processing', 'status-resolved', 'status-rejected');

    // Update status based on parameter
    switch(status) {
        case 'pending':
            statusBadge.innerHTML = '<span class="status status-pending"></span> Pending';
            break;
        case 'processing':
            statusBadge.innerHTML = '<span class="status status-processing"></span> Processing';
            break;
        case 'resolved':
            statusBadge.innerHTML = '<span class="status status-resolved"></span> Resolved';
            break;
        case 'rejected':
            statusBadge.innerHTML = '<span class="status status-rejected"></span> Rejected';
            break;
        case 'escalated':
            statusBadge.innerHTML = '<span class="status status-warning"></span> Escalated';
            statusBadge.className = 'badge badge-warning';
            break;
        default:
            statusBadge.innerHTML = '<span class="status status-pending"></span> Pending';
    }
}

// Function to add a new event to the timeline
function addTimelineEvent(title, datetime, description) {
    const timeline = document.getElementById('complaint-timeline');

    // Find the pending items (usually the last two)
    const pendingItems = timeline.querySelectorAll('.timeline-item.pending');

    // Create the new timeline item
    const newItem = document.createElement('div');
    newItem.className = 'timeline-item';

    newItem.innerHTML = `
        <div class="timeline-badge active">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="timeline-content">
            <h4>${title}</h4>
            <p class="text-grey">${datetime}</p>
            <p>${description}</p>
        </div>
    `;

    // Insert before the first pending item
    if (pendingItems.length > 0) {
        timeline.insertBefore(newItem, pendingItems[0]);
    } else {
        timeline.appendChild(newItem);
    }
}

// Function to show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    // Append to body
    document.body.appendChild(notification);

    // Add active class after a small delay (for animation)
    setTimeout(() => {
        notification.classList.add('active');
    }, 10);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('active');
        setTimeout(() => {
            notification.remove();
        }, 300); // Wait for fade out animation
    }, 3000);
}

// Function to open a modal
function openModal(modal) {
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('active');
    }, 10);
}

// Function to close a modal
function closeModal(modal) {
    modal.classList.remove('active');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300); // Match the transition duration
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

    <style>
        /* Additional styles specific to complaint-detail.html */

/* Timeline styles */
.timeline {
    position: relative;
    padding: var(--spacing-md) 0;
}

.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 20px;
    width: 2px;
    background-color: var(--light-grey);
}

.timeline-item {
    position: relative;
    margin-bottom: var(--spacing-lg);
    padding-left: 50px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-badge {
    position: absolute;
    left: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--success-color);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white-color);
    z-index: 1;
}

.timeline-badge.active {
    background-color: var(--info-color);
}

.timeline-badge.pending {
    background-color: var(--light-grey);
    color: var(--grey-color);
}

.timeline-content {
    padding: var(--spacing-md);
    background-color: var(--very-light-grey);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
}

.timeline-content h4 {
    margin-bottom: var(--spacing-xs);
    color: var(--primary-color);
}

.timeline-item.pending .timeline-content {
    background-color: transparent;
    box-shadow: none;
    padding-left: 0;
}

/* Comments Styles */
.comments {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
}

.comment {
    display: flex;
    gap: var(--spacing-md);
}

.comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: var(--white-color);
    flex-shrink: 0;
}

.user-comment .comment-avatar {
    background-color: var(--secondary-color);
}

.comment-content {
    flex: 1;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-xs);
}

.comment-header h4 {
    margin: 0;
    font-size: 1rem;
    font-weight: 500;
}

/* Attachment styles */
.attachments {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-md);
}

.attachment {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-sm) var(--spacing-md);
    background-color: var(--very-light-grey);
    border-radius: var(--border-radius-sm);
}

.attachment i {
    color: var(--primary-color);
}

/* Complaint content */
.complaint-content {
    background-color: var(--very-light-grey);
    padding: var(--spacing-md);
    border-radius: var(--border-radius-md);
    line-height: 1.6;
}

.complaint-content p:not(:last-child) {
    margin-bottom: var(--spacing-md);
}

/* File upload */
.file-upload {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

#file-name {
    font-size: 0.875rem;
    color: var(--grey-color);
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modal.active {
    opacity: 1;
}

.modal-content {
    background-color: var(--white-color);
    border-radius: var(--border-radius-md);
    width: 100%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: var(--shadow-lg);
    transform: translateY(-20px);
    transition: transform 0.3s ease;
}

.modal.active .modal-content {
    transform: translateY(0);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-md) var(--spacing-lg);
    border-bottom: 1px solid var(--light-grey);
}

.modal-header h2 {
    margin: 0;
    font-size: 1.25rem;
    color: var(--primary-color);
}

.close-modal {
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--grey-color);
}

.modal-body {
    padding: var(--spacing-lg);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: var(--spacing-md);
    padding: var(--spacing-md) var(--spacing-lg);
    border-top: 1px solid var(--light-grey);
}

/* Notification styles */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-md);
    background-color: var(--white-color);
    box-shadow: var(--shadow-md);
    z-index: 1000;
    transform: translateX(100%);
    transition: transform 0.3s ease;
}

.notification.active {
    transform: translateX(0);
}

.notification-success {
    border-left: 4px solid var(--success-color);
}

.notification-error {
    border-left: 4px solid var(--danger-color);
}

.notification-warning {
    border-left: 4px solid var(--warning-color);
}

.notification-info {
    border-left: 4px solid var(--info-color);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .timeline:before {
        left: 15px;
    }

    .timeline-item {
        padding-left: 40px;
    }

    .timeline-badge {
        width: 30px;
        height: 30px;
        font-size: 0.875rem;
    }

    .actions {
        flex-direction: column;
    }

    .actions button {
        width: 100%;
        margin-bottom: var(--spacing-sm);
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
            {{-- Remove or update this link: complaint ID required --}}
            {{-- <a href="{{ route ('user.feedback') }}" class="menu-item">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a> --}}
            {{-- <a href="{{ route ('user.reviews', ['complaint_id' => $complaint->id]) }}" class="menu-item">
                <i class="fas fa-star"></i>
                <span>Reviews</span>
            </a> --}}
            {{-- <a href="{{ route ('user.profile-settings') }}" class="menu-item">
                <i class="fas fa-user-cog"></i>
                <span>Profile Settings</span>
            </a> --}}
            <a href="#" class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content" id="main-content">
        <!-- Header -->
        <div class="header">
            <div class="d-flex align-center">
                <button class="menu-toggle" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-title">
                    <h1>Complaint Detail</h1>
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

        <!-- Complaint Detail -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <div class="card-title" id="complaint-title">{{ $complaint->subject }}</div>
                <div class="d-flex align-center gap-1">
                    <span class="badge badge-primary" id="complaint-id">ID: {{ $complaint->id }}</span>
                    <span class="badge" id="complaint-status-badge">
                        <span class="status status-{{ $complaint->status ?? 'pending' }}"></span>
                        {{ ucfirst($complaint->status ?? 'Pending') }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <p class="mb-1"><strong>Submitted By:</strong> <span id="complaint-submitter">{{ $complaint->user ? $complaint->user->name : 'Anonymous' }}</span></p>
                        <p class="mb-1"><strong>Department:</strong> <span id="complaint-department">{{ $complaint->user ? $complaint->user->department : 'N/A' }}</span></p>
                        <p class="mb-1"><strong>Category:</strong> <span id="complaint-category">{{ $complaint->category }}</span></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="mb-1"><strong>Date Submitted:</strong> <span id="complaint-date">{{ $complaint->created_at ? $complaint->created_at->format('M d, Y') : '' }}</span></p>
                        <p class="mb-1"><strong>Priority:</strong> <span class="badge badge-danger" id="complaint-priority">{{ ucfirst($complaint->priority ?? 'Medium') }}</span></p>
                        <p class="mb-1"><strong>Assigned To:</strong> <span id="complaint-assignee">{{ $complaint->assignee ? $complaint->assignee->name : 'N/A' }}</span></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Description</div>
                    <div class="complaint-content" id="complaint-description">
                        <p>{{ $complaint->description }}</p>
                        @if($complaint->suggested_solution)
                            <p><strong>Suggested Solution:</strong> {{ $complaint->suggested_solution }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">Attachments</div>
                    <div class="attachments" id="complaint-attachments">
                        @if($complaint->attachments && count($complaint->attachments))
                            @foreach($complaint->attachments as $attachment)
                                <div class="attachment">
                                    <i class="fas fa-file"></i>
                                    <span>{{ basename($attachment->path) }}</span>
                                    <a href="{{ asset('storage/' . $attachment->path) }}" class="text-primary" target="_blank">View</a>
                                </div>
                            @endforeach
                        @elseif($complaint->attachment)
                            <div class="attachment">
                                <i class="fas fa-file"></i>
                                <span>{{ basename($complaint->attachment) }}</span>
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" class="text-primary" target="_blank">View</a>
                            </div>
                        @else
                            <span>No attachments</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Timeline -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <div class="card-title">Progress Timeline</div>
            </div>
            <div class="card-body">
                <div class="timeline" id="complaint-timeline">
                    {{-- Complaint Submitted --}}
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Complaint Submitted</h4>
                            <p class="text-grey">{{ $complaint->created_at ? $complaint->created_at->format('M d, Y - h:i A') : '' }}</p>
                            <p>Your complaint has been successfully submitted into the system.</p>
                        </div>
                    </div>

                    {{-- Complaint Processing --}}
                    <div class="timeline-item">
                        <div class="timeline-badge active">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Complaint Processing</h4>
                            <p class="text-grey">{{ $complaint->created_at ? $complaint->created_at->format('M d, Y - h:i A') : '' }}</p>
                            <p>Your complaint is being processed by the admin.</p>
                        </div>
                    </div>

                    {{-- Complaint Reviewed/Resolved/Rejected --}}
                    {{-- Complaint Reviewed --}}
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Complaint Reviewed</h4>
                            <p class="text-grey">{{ ($complaint->status === 'resolved' || $complaint->status === 'rejected') && $complaint->updated_at ? $complaint->updated_at->format('M d, Y - h:i A') : 'Pending' }}</p>
                            <p>
                                @if($complaint->status === 'resolved')
                                    Your complaint has been marked as resolved by the admin.
                                @elseif($complaint->status === 'rejected')
                                    Your complaint has been rejected by the admin.
                                @else
                                    Your complaint is awaiting review by the admin.
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Final Step: Complaint Resolved or Rejected or Pending --}}
                    <div class="timeline-item {{ $complaint->status === 'resolved' ? '' : ($complaint->status === 'rejected' ? '' : 'pending') }}">
                        <div class="timeline-badge {{ $complaint->status === 'resolved' ? '' : ($complaint->status === 'rejected' ? '' : 'pending') }}">
                            @if($complaint->status === 'resolved')
                                <i class="fas fa-check-circle"></i>
                            @elseif($complaint->status === 'rejected')
                                <i class="fas fa-times-circle"></i>
                            @else
                                <i class="fas fa-clock"></i>
                            @endif
                        </div>
                        <div class="timeline-content">
                            <h4>
                                @if($complaint->status === 'resolved')
                                    Complaint Resolved
                                @elseif($complaint->status === 'rejected')
                                    Complaint Rejected
                                @else
                                    Complaint Resolution
                                @endif
                            </h4>
                            <p>
                                @if($complaint->status === 'resolved')
                                    Your complaint has been resolved and closed.
                                @elseif($complaint->status === 'rejected')
                                    Your complaint has been rejected and closed.
                                @else
                                    Pending
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <div class="card-title">Actions</div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-between flex-wrap gap-2">
                    @if($complaint->status === 'resolved')
                        <a href="{{ url('user/reviews/' . $complaint->id) }}" class="btn btn-success">
            <i class="fas fa-star"></i>
            Submit a Review
        </a>
        <script>
        // Show notification after review submission if redirected with success
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('review=success')) {
                showNotification('Review submitted successfully', 'success');
            }
        });
        </script>
                    @endif
                    <form method="POST" action="{{ route('complaint.delete', ['id' => $complaint->id]) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to permanently delete this complaint?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete Complaint
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Confirmation Modal -->
    <div class="modal" id="confirmation-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="confirm-title">Confirmation</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <p id="confirm-message">Are you sure you want to perform this action?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-action">Confirm</button>
            </div>
        </div>
    </div>
</body>
</html>
</html>

<!--
====================================================================
COMPLAINT DETAIL BLADE STRUCTURE EXPLANATION
====================================================================

1. Sidebar Navigation (<div class="sidebar" id="sidebar">)
   - Contains the university logo and navigation links for the user dashboard.
   - Each <a> tag is a navigation link (Dashboard, Submit Complaint, View Complaints, Logout).
   - Some links are commented out for future features (Feedback, Reviews, Profile Settings).

2. Main Content Area (<div class="main-content" id="main-content">)
   - The main container for all complaint detail content.

   a. Header (<div class="header">)
      - Contains the responsive header bar at the top of the page.
      - .d-flex.align-center: Flex container for header layout.
         - .menu-toggle: Hamburger icon for toggling sidebar on mobile/tablet.
         - .header-title: Displays the page title ("Complaint Detail").
      - .header-actions: Shows the user's initials and name in a styled avatar and info block.

   b. Complaint Detail Card (<div class="card animate-fadeIn">)
      - Shows the main details of the complaint (subject, ID, status, submitter, department, category, date, priority, assignee).
      - .card-header: Contains the complaint title, ID badge, and status badge.
      - .card-body: Contains two columns for submitter info and complaint meta, plus the description and attachments.

   c. Progress Timeline Card (<div class="card animate-fadeIn">)
      - Shows a visual timeline of the complaint's progress through the system.
      - .timeline: Contains timeline items for each stage (Submitted, Processing, Reviewed, Resolved/Rejected/Pending).
      - Each .timeline-item has a badge (icon) and content (title, date, description).

   d. Actions Card (<div class="card animate-fadeIn">)
      - Provides action buttons for the user (Submit Review if resolved, Delete Complaint).
      - The review button appears only if the complaint is resolved.
      - The delete button is always available, with a confirmation prompt.

   e. Confirmation Modal (<div class="modal" id="confirmation-modal">)
      - Modal dialog for confirming actions (logout, resolve, delete, escalate, etc.).
      - Contains a title, message, and Cancel/Confirm buttons.

3. JavaScript Section (<script> ... </script>)
   - Handles all interactivity: sidebar toggle, comment submission, file upload, escalation, resolve/delete actions, modal logic, notifications, and logout.
   - Utility functions for creating comments, updating status, adding timeline events, showing notifications, and modal open/close.

4. Style Section (<style> ... </style>)
   - Contains custom CSS for timeline, comments, attachments, complaint content, modals, notifications, and responsive adjustments.

====================================================================
This comment is for developer reference. Each section and div is structured for clarity, maintainability, and responsive design. The timeline and actions are dynamic and update based on complaint status.
====================================================================
-->
