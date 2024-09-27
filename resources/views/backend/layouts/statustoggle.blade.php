{{-- post category status --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use event delegation for dynamically added rows
        document.querySelector('table').addEventListener('click', function(e) {
            if (e.target.classList.contains('status-toggle')) {
                e.preventDefault();

                let selectedCategoryId = e.target.getAttribute('data-id');
                let selectedStatus = e.target.checked;

                // Show confirmation alert using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update the status?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Call function to update status
                        updateStatus(selectedCategoryId, selectedStatus);
                    } else {
                        // Revert the toggle if canceled
                        e.target.checked = !selectedStatus;
                    }
                });
            }
        });

        // Update status using AJAX and show SweetAlert on success
        function updateStatus(id, status) {
            fetch(`/post-category/update-status/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure this is processed correctly
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the toggle checkbox
                        document.querySelector(`input[data-id="${id}"]`).checked = status;

                        // Update the label text
                        let label = document.querySelector(`label[for="statusLabel${id}"]`);
                        label.textContent = status ? 'On' : 'Off';

                        // Show success alert using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })

                        // Hide the modal if needed
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modal-status-toggle'));
                        if (modal) {
                            modal.hide();
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update status.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
</script>



{{-- post toggle status update --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use event delegation for dynamically added rows
        document.querySelector('table').addEventListener('click', function(e) {
            if (e.target.classList.contains('statuspost-toggle')) {
                e.preventDefault();

                let selectedCategoryId = e.target.getAttribute('data-id');
                let selectedStatus = e.target.checked;

                // Show confirmation alert using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update the status?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Call function to update status
                        updateStatus(selectedCategoryId, selectedStatus);
                    } else {
                        // Revert the toggle if canceled
                        e.target.checked = !selectedStatus;
                    }
                });
            }
        });

        // Update status using AJAX and show SweetAlert on success
        function updateStatus(id, status) {
            fetch(`/post/update-status/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure this is processed correctly
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the toggle checkbox
                        document.querySelector(`input[data-id="${id}"]`).checked = status;

                        // Update the label text
                        let label = document.querySelector(`label[for="statusLabel${id}"]`);
                        label.textContent = status ? 'On' : 'Off';

                        // Show success alert using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })

                        // Hide the modal if needed
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modal-status-toggle'));
                        if (modal) {
                            modal.hide();
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update status.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
</script>



{{-- user status --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use event delegation for dynamically added rows
        document.querySelector('table').addEventListener('click', function(e) {
            if (e.target.classList.contains('statususer-toggle')) {
                e.preventDefault();

                let selectedCategoryId = e.target.getAttribute('data-id');
                let selectedStatus = e.target.checked;

                // Show confirmation alert using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update the status?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Call function to update status
                        updateStatus(selectedCategoryId, selectedStatus);
                    } else {
                        // Revert the toggle if canceled
                        e.target.checked = !selectedStatus;
                    }
                });
            }
        });

        // Update status using AJAX and show SweetAlert on success
        function updateStatus(id, status) {
            fetch(`/user/update-status/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure this is processed correctly
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the toggle checkbox
                        document.querySelector(`input[data-id="${id}"]`).checked = status;

                        // Update the label text
                        let label = document.querySelector(`label[for="statusLabel${id}"]`);
                        label.textContent = status ? 'On' : 'Off';

                        // Show success alert using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })

                        // Hide the modal if needed
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modal-status-toggle'));
                        if (modal) {
                            modal.hide();
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update status.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
</script>