<!-- for delete conformation  -->
<script>
    function handleDelete(id) {
        // Trigger SweetAlert2 for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set the form action to the correct delete route
                var form = document.getElementById('deletePostForm');
                // Submit the form
                form.submit();
            }
        });
    }
</script>
{{-- post-category toggle status update --}}

{{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                let selectedCategoryId = null;
                let selectedStatus = null;

                // Handle status toggle click event
                document.querySelectorAll('.status-toggle').forEach(toggle => {
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Store the category ID and status
                        selectedCategoryId = this.getAttribute('data-id');
                        selectedStatus = this.checked;

                        // Show confirmation modal
                        var modal = new bootstrap.Modal(document.getElementById('modal-status-toggle'));
                        modal.show();
                    });
                });

                // Handle modal confirmation for status update
                document.getElementById('confirmStatusUpdate').addEventListener('click', function() {
                    if (selectedCategoryId !== null) {
                        updateStatus(selectedCategoryId, selectedStatus);
                    }
                });

                // Update status using AJAX and show SweetAlert on success
                function updateStatus(id, status) {
                    fetch(`/post-category/update-status/${id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // document.getElementById(`statusLabel${id}`).textContent = status ? 'Active' :
                                //     'Inactive';

                                // Manually update the toggle status
                                document.querySelector(`input[data-id="${id}"]`).checked = status;
                                // Show success alert using SweetAlert
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Status updated successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            }

                            // Hide the modal after update
                            var modal = bootstrap.Modal.getInstance(document.getElementById('modal-status-toggle'));
                            modal.hide();
                        })
                        .catch(error => {
                            console.error('Error updating status:', error);
                        });
                }
            });
        </script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                let selectedCategoryId = this.getAttribute('data-id');
                let selectedStatus = this.checked;

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
                        this.checked = !selectedStatus;
                    }
                });
            });
        });

        // Update status using AJAX and show SweetAlert on success
        function updateStatus(id, status) {
            fetch(`/post-category/update-status/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success alert using SweetAlert
                        document.querySelector(`input[data-id="${id}"]`).checked = status;
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        // Optionally update the label or any other UI element
                        // Hide the modal after update`
                        var modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modal-status-toggle'));
                        modal.hide();
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }
    });
</script>
{{-- post toggle status update --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.statuspost-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                let selectedCategoryId = this.getAttribute('data-id');
                let selectedStatus = this.checked;

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
                        this.checked = !selectedStatus;
                    }
                });
            });
        });

        // Update status using AJAX and show SweetAlert on success
        function updateStatus(id, status) {
            fetch(`/post/update-status/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success alert using SweetAlert
                        document.querySelector(`input[data-id="${id}"]`).checked = status;
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        // Optionally update the label or any other UI element
                        // Hide the modal after update`
                        var modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modal-status-toggle'));
                        modal.hide();
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }
    });
</script>



<script>
    Fancybox.bind("[data-fancybox]", {
        // Custom options here
    });
</script>
