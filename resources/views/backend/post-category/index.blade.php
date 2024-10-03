@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-sm-6">
                    <h3 class="mb-0">Post Category</h3>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ Breadcrumbs::render('post-category.index') }}

                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex mb-1">
                                <a class="btn btn-success" href="{{ route('post-category.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                                <div class="d-flex">
                                    <select id="bulkAction" class="form-select me-2" style="width: auto;">
                                        <option value="" selected disabled>Bulk Action</option>
                                        <option value="toggle-status">Toggle Status</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button class="btn btn-secondary" id="applyBulkAction">Apply</button>
                                </div>
                            </div>

                            <!-- Bulk Action Dropdown -->

                        </div>

                        <div class="card-body p-3">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table table-striped table-bordered dt-responsive nowrap', 'width' => '100%']) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    {!! $dataTable->scripts() !!}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup status toggles for individual rows
            setupStatusToggles('.status-toggle', '/post-category/update-status');

            // Re-initialize the status toggle after DataTable is drawn
            $(document).on('draw.dt', function() {
                setupStatusToggles('.status-toggle', '/post-category/update-status');
            });

            // Apply Bulk Action
            $('#applyBulkAction').click(function() {
                var selectedRows = $('input[name="selected_rows[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                var bulkAction = $('#bulkAction').val();

                if (bulkAction && selectedRows.length > 0) {
                    if (bulkAction === 'toggle-status') {
                        updateStatus(selectedRows);
                    } else if (bulkAction === 'delete') {
                        deleteSelectedRows(selectedRows);
                    }
                } else {
                    alert('Please select an action and at least one row.');
                }
            });

            // Update Status for Selected Rows
            function updateStatus(ids) {
                $.ajax({
                    url: '/post-category/bulk-update-status',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: ids
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

           // Delete Selected Rows
function deleteSelectedRows(ids) {
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
                url: '/post-category/bulk-delete',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                },
                success: function(response) {
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
                error: function(error) {
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

        });
    </script>
@endpush
