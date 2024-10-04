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
                var form = document.getElementById('deletePostForm-' + id);
 
                // Submit the form
                form.submit();
                 
            }
        });
    }

   
</script>

<script>
 // Show success message only once
@if (session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        timer: 3000, // Close automatically after 3 seconds
        showConfirmButton: 'Ok'
    }).then(() => {
        // Clear the session flash message
       window.location.reload();
    });
@endif
</script>
<script>
function postcategoryDelete(id) {
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
            var form = document.getElementById('deletePostcategoryForm-' + id);
            form.submit();
        }
    });
}


</script>

{{-- bulk action --}}



<script>
    Fancybox.bind("[data-fancybox]", {
        // Custom options here
    });
</script>



{{-- // Handle 'select all' checkbox --}}
<script>
$('#select-all').click(function() {
    $('input[name="selected_rows[]"]').prop('checked', this.checked);
});
</script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to handle bulk actions for Post Category
        function initPostCategoryBulkActions() {
            const bulkActionUrl = "{{ route('post-category.bulk-update-status') }}";
            const deleteUrl = "{{ route('post-category.bulk-delete') }}";

            // Apply Bulk Action for Post Category
            $('#applyPostCategoryBulkAction').click(function () {
                var selectedRows = $('input[name="selected_rows[]"]:checked').map(function () {
                    return $(this).val();
                }).get();
                var bulkAction = $('#bulkActionPostCategory').val();

                if (bulkAction && selectedRows.length > 0) {
                    if (bulkAction === 'delete') {
                        deletePostCategorySelectedRows(selectedRows, deleteUrl);
                    } else if (bulkAction === 'toggle-status') {
                        updatePostCategorySelectedRowsStatus(selectedRows, bulkActionUrl);
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Action Required',
                        text: 'Please select an action and at least one row.',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Delete Post Category Selected Rows
            function deletePostCategorySelectedRows(ids, url) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                ids: ids
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Rows deleted successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting rows.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            }

            // Toggle Status for Post Category Selected Rows
            function updatePostCategorySelectedRowsStatus(ids, url) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: ids
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Status Updated!',
                            text: 'The status of selected rows has been toggled successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while updating status.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        }

        // Function to handle bulk actions for Post
        function initPostBulkActions() {
            const bulkActionUrl = "{{ route('post.bulk-update-status') }}";
            const deleteUrl = "{{ route('post.bulk-delete') }}";

            // Apply Bulk Action for Post
            $('#applyPostBulkAction').click(function () {
                var selectedRows = $('input[name="selected_rows[]"]:checked').map(function () {
                    return $(this).val();
                }).get();
                var bulkAction = $('#bulkActionPost').val();

                if (bulkAction && selectedRows.length > 0) {
                    if (bulkAction === 'delete') {
                        deletePostSelectedRows(selectedRows, deleteUrl);
                    } else if (bulkAction === 'toggle-status') {
                        updatePostSelectedRowsStatus(selectedRows, bulkActionUrl);
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Action Required',
                        text: 'Please select an action and at least one row.',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Delete Post Selected Rows
            function deletePostSelectedRows(ids, url) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                ids: ids
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Rows deleted successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting rows.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            }

            // Toggle Status for Post Selected Rows
            function updatePostSelectedRowsStatus(ids, url) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: ids
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Status Updated!',
                            text: 'The status of selected rows has been toggled successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while updating status.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        }

        // Initialize bulk actions for Post Category
        if (window.location.href.includes('/post-category')) {
            initPostCategoryBulkActions();
        }

        // Initialize bulk actions for Post
        if (window.location.href.includes('/post')) {
            initPostBulkActions();
        }
    });
</script> --}}


