<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Complaint Responses - RUN CMS</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom CSS for Anonymous Responses Page */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
        }

        .page-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: var(--spacing-md);
        }

        .page-description {
            color: var(--grey-color);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .search-container {
            margin-bottom: var(--spacing-lg);
        }

        .search-box {
            position: relative;
            max-width: 400px;
            margin: 0 auto;
        }

        .search-input {
            width: 100%;
            padding: var(--spacing-sm) var(--spacing-md) var(--spacing-sm) 45px;
            border: 2px solid var(--light-grey);
            border-radius: var(--border-radius-md);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--grey-color);
        }

        .response-table {
            background: var(--white-color);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white-color);
            padding: var(--spacing-lg);
        }

        .table-header h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .response-table .table {
            margin-bottom: 0;
        }

        .response-table .table th {
            background-color: var(--very-light-grey);
            font-weight: 600;
            color: var(--primary-color);
            border-bottom: 2px solid var(--light-grey);
            padding: var(--spacing-md);
        }

        .response-table .table td {
            padding: var(--spacing-md);
            vertical-align: middle;
            border-bottom: 1px solid var(--light-grey);
        }

        .response-table .table tbody tr:hover {
            background-color: rgba(30, 58, 138, 0.05);
        }

        .complaint-id {
            font-weight: 600;
            color: var(--primary-color);
            font-family: monospace;
        }

        .complaint-subject {
            font-weight: 500;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .complaint-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            background-color: var(--secondary-light);
            color: var(--white-color);
        }

        .complaint-date {
            color: var(--grey-color);
            font-size: 0.9rem;
        }

        .complaint-response {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .response-empty {
            color: var(--grey-color);
            font-style: italic;
        }

        .no-results {
            text-align: center;
            padding: var(--spacing-xl);
            color: var(--grey-color);
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: var(--spacing-md);
            color: var(--light-grey);
        }

        .instructions-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 1px solid var(--light-grey);
            border-radius: var(--border-radius-md);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .instructions-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .instructions-list {
            list-style: none;
            padding: 0;
        }

        .instructions-list li {
            padding: var(--spacing-xs) 0;
            color: var(--grey-color);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .instructions-list li i {
            color: var(--primary-color);
            width: 16px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .page-description {
                font-size: 1rem;
            }

            .complaint-subject,
            .complaint-response {
                max-width: 150px;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .response-table .table th,
            .response-table .table td {
                padding: var(--spacing-sm);
            }
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 3rem;">
        <div class="page-header">
            <h1 class="page-title">Anonymous Complaint Responses</h1>
            <p class="page-description">
                Below are responses to complaints submitted anonymously. Use your complaint subject, date, or unique ID (if provided) to find your response.
            </p>
        </div>

        <div class="instructions-card">
            <div class="instructions-title">
                <i class="fas fa-info-circle"></i>
                How to Find Your Response
            </div>
            <ul class="instructions-list">
                <li><i class="fas fa-search"></i> Use the search box below to filter responses by ID, subject, or category</li>
                <li><i class="fas fa-calendar"></i> Look for your complaint using the date you submitted it</li>
                <li><i class="fas fa-hashtag"></i> If you received a unique ID when submitting, use it to locate your response</li>
                <li><i class="fas fa-eye"></i> All personal information has been removed to protect your anonymity</li>
            </ul>
        </div>

        <div class="search-container">
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search by ID, subject, or category..." id="searchInput">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <div class="response-table">
            <div class="table-header">
                <h3><i class="fas fa-comments"></i> Anonymous Complaint Responses</h3>
            </div>
            <div class="table-responsive">
                <table class="table" id="responsesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Date Submitted</th>
                            <th>Response</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - replace with actual data -->
                        <tr>
                            <td><span class="complaint-id">#CMP-001</span></td>
                            <td><span class="complaint-subject">Library Computer Issues</span></td>
                            <td><span class="complaint-category">Facilities</span></td>
                            <td><span class="complaint-date">2024-01-15</span></td>
                            <td>We have addressed the computer issues in the library. New systems have been installed and are now fully operational.</td>
                            <td><span class="badge badge-success"><i class="fas fa-check"></i> Resolved</span></td>
                        </tr>
                        <tr>
                            <td><span class="complaint-id">#CMP-002</span></td>
                            <td><span class="complaint-subject">Cafeteria Food Quality</span></td>
                            <td><span class="complaint-category">Dining</span></td>
                            <td><span class="complaint-date">2024-01-12</span></td>
                            <td>Thank you for your feedback. We have reviewed our food preparation processes and implemented quality improvements.</td>
                            <td><span class="badge badge-success"><i class="fas fa-check"></i> Resolved</span></td>
                        </tr>
                        <tr>
                            <td><span class="complaint-id">#CMP-003</span></td>
                            <td><span class="complaint-subject">Parking Space Shortage</span></td>
                            <td><span class="complaint-category">Infrastructure</span></td>
                            <td><span class="complaint-date">2024-01-10</span></td>
                            <td>We are currently working on expanding the parking facilities. Construction is expected to begin next month.</td>
                            <td><span class="badge badge-warning"><i class="fas fa-clock"></i> In Progress</span></td>
                        </tr>
                        <tr>
                            <td><span class="complaint-id">#CMP-004</span></td>
                            <td><span class="complaint-subject">Classroom Air Conditioning</span></td>
                            <td><span class="complaint-category">Facilities</span></td>
                            <td><span class="complaint-date">2024-01-08</span></td>
                            <td><span class="response-empty">No response yet</span></td>
                            <td><span class="badge badge-warning"><i class="fas fa-hourglass-half"></i> Pending</span></td>
                        </tr>
                        <tr>
                            <td><span class="complaint-id">#CMP-005</span></td>
                            <td><span class="complaint-subject">Internet Connectivity Issues</span></td>
                            <td><span class="complaint-category">Technology</span></td>
                            <td><span class="complaint-date">2024-01-05</span></td>
                            <td>Network infrastructure has been upgraded. Internet connectivity should now be stable across all campus buildings.</td>
                            <td><span class="badge badge-success"><i class="fas fa-check"></i> Resolved</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="no-results" id="noResults" style="display: none;">
            <i class="fas fa-search"></i>
            <h3>No Results Found</h3>
            <p>No complaint responses match your search criteria. Try adjusting your search terms.</p>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const table = document.getElementById('responsesTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            const noResults = document.getElementById('noResults');
            let visibleRows = 0;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const id = row.cells[0].textContent.toLowerCase();
                const subject = row.cells[1].textContent.toLowerCase();
                const category = row.cells[2].textContent.toLowerCase();
                const date = row.cells[3].textContent.toLowerCase();
                const response = row.cells[4].textContent.toLowerCase();

                if (id.includes(searchTerm) ||
                    subject.includes(searchTerm) ||
                    category.includes(searchTerm) ||
                    date.includes(searchTerm) ||
                    response.includes(searchTerm)) {
                    row.style.display = '';
                    visibleRows++;
                } else {
                    row.style.display = 'none';
                }
            }

            // Show/hide no results message
            if (visibleRows === 0 && searchTerm !== '') {
                table.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                table.style.display = '';
                noResults.style.display = 'none';
            }
        });

        // Add fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.container').classList.add('animate-fadeIn');
        });
    </script>
</body>
</html>
