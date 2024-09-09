
 {{-- post-category toggle status update --}}
 
 <script>
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
                                document.getElementById(`statusLabel${id}`).textContent = status ? 'Active' :
                                    'Inactive';

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
        </script>







<script>
    Fancybox.bind("[data-fancybox]", {
        // Custom options here
    });
</script>