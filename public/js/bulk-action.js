document.addEventListener('DOMContentLoaded', function () {
    // Function to handle bulk actions for Post Category
    function initPostCategoryBulkActions(bulkActionUrl, deleteUrl) {
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
    function initPostBulkActions(bulkActionUrl, deleteUrl) {
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

    // Function to handle bulk actions for Post
    function initUserBulkActions(bulkActionUrl, deleteUrl) {
        // Apply Bulk Action for Post
        $('#applyUserBulkAction').click(function () {
            var selectedRows = $('input[name="selected_rows[]"]:checked').map(function () {
                return $(this).val();
            }).get();
            var bulkAction = $('#bulkActionUser').val();

            if (bulkAction && selectedRows.length > 0) {
                if (bulkAction === 'delete') {
                    deleteUserSelectedRows(selectedRows, deleteUrl);
                } else if (bulkAction === 'toggle-status') {
                    updateUserSelectedRowsStatus(selectedRows, bulkActionUrl);
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
        function deleteUserSelectedRows(ids, url) {
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
        function updateUserSelectedRowsStatus(ids, url) {
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
    // Initialize bulk actions for Post
    if (window.location.href.includes('/users')) {
        var userBulkActionUrl = $('#applyUserBulkAction').data('bulk-action-url');
        var userDeleteUrl = $('#applyUserBulkAction').data('delete-url');
        initUserBulkActions(userBulkActionUrl, userDeleteUrl);
    }
    // Initialize bulk actions for Post Category
    if (window.location.href.includes('/post-category')) {
        var postCategoryBulkActionUrl = $('#applyPostCategoryBulkAction').data('bulk-action-url');
        var postCategoryDeleteUrl = $('#applyPostCategoryBulkAction').data('delete-url');
        initPostCategoryBulkActions(postCategoryBulkActionUrl, postCategoryDeleteUrl);
    }

    // Initialize bulk actions for Post
    if (window.location.href.includes('/post')) {
        var postBulkActionUrl = $('#applyPostBulkAction').data('bulk-action-url');
        var postDeleteUrl = $('#applyPostBulkAction').data('delete-url');
        initPostBulkActions(postBulkActionUrl, postDeleteUrl);
    }
});
