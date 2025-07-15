<!DOCTYPE html>
<html>
<body>
    <h2>Dear {{ $complaint->user ? $complaint->user->name : 'User' }},</h2>
    <p>Thank you for submitting your complaint. We have received the following details:</p>
    <ul>
        <li><strong>Subject:</strong> {{ $complaint->subject }}</li>
        <li><strong>Category:</strong> {{ ucfirst(str_replace('_', ' ', $complaint->category)) }}</li>
        <li><strong>Location:</strong> {{ $complaint->location ?? 'N/A' }}</li>
        <li><strong>Date:</strong> {{ $complaint->date ?? 'N/A' }}</li>
        <li><strong>Description:</strong> {{ $complaint->description }}</li>
        <li><strong>Urgency:</strong> {{ ucfirst($complaint->urgency) }}</li>
        <li><strong>Anonymous:</strong> {{ $complaint->is_anonymous ? 'Yes' : 'No' }}</li>
    </ul>
    <p>We will review your complaint and get back to you if necessary.</p>
    <p>Best regards,<br>RUN CMS Team</p>
</body>
</html>
