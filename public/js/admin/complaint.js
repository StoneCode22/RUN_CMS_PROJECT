// Function to open modals
function openViewModal(complaintId) {
    document.getElementById('viewModal').style.display = 'flex';
    // In a real application, you would fetch the complaint details using the complaintId
    console.log("Opening view modal for complaint: " + complaintId);
}

function openAssignModal(complaintId) {
    document.getElementById('assignModal').style.display = 'flex';
    document.getElementById('assign-complaint-id').textContent = complaintId;
    // In a real application, you would fetch the complaint title using the complaintId
    console.log("Opening assign modal for complaint: " + complaintId);
}

function openPriorityModal(complaintId) {
    document.getElementById('priorityModal').style.display = 'flex';
    document.getElementById('priority-complaint-id').textContent = complaintId;
    // In a real application, you would fetch the current priority using the complaintId
    console.log("Opening priority modal for complaint: " + complaintId);
}

// Function to close modals
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Function to save assignment
function saveAssignment() {
    const complaintId = document.getElementById('assign-complaint-id').textContent;
    const staffId = document.getElementById('assign-staff').value;
    const note = document.getElementById('assign-note').value;
    
    // In a real application, you would send this data to the server
    console.log("Assigning complaint " + complaintId + " to staff ID: " + staffId);
    console.log("Assignment note: " + note);
    
    // Close the modal after saving
    closeModal('assignModal');
    
    // Show success message (in a real app)
    alert("Complaint " + complaintId + " has been assigned successfully!");
}

// Function to save priority change
function savePriority() {
    const complaintId = document.getElementById('priority-complaint-id').textContent;
    const newPriority = document.getElementById('new-priority').value;
    const reason = document.getElementById('priority-reason').value;
    
    // In a real application, you would send this data to the server
    console.log("Changing priority of complaint " + complaintId + " to: " + newPriority);
    console.log("Reason for change: " + reason);
    
    // Close the modal after saving
    closeModal('priorityModal');
    
    // Show success message (in a real app)
    alert("Priority for complaint " + complaintId + " has been updated successfully!");
}

// Function to mark a complaint as resolved
function markResolved(complaintId) {
    // In a real application, you would send this data to the server
    console.log("Marking complaint " + complaintId + " as resolved");
    
    // Show success message (in a real app)
    alert("Complaint " + complaintId + " has been marked as resolved!");
}

// Function to delete a complaint
function confirmDelete(complaintId) {
    const confirmed = confirm("Are you sure you want to delete complaint " + complaintId + "? This action cannot be undone.");
    
    if (confirmed) {
        // In a real application, you would send this request to the server
        console.log("Deleting complaint " + complaintId);
        
        // Show success message (in a real app)
        alert("Complaint " + complaintId + " has been deleted successfully!");
    }
}
