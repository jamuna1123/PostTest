@extends('layouts.app')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Users</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Users
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Second Card: Striped Full Width Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Post List</h3> --}}
                            <div class="d-grid gap-2 d-md-flex  mb-1">
                                <a class="btn btn-success" href="{{ route('users.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Phone</th>
                                 <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="align-middle">
                                            <td>

                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-success btn-sm text-white"><i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @if (auth()->id() !== $user->id)
                                                    <!-- Check if the authenticated user is not the same as the current user -->
                                                   <a class="btn btn-danger btn-sm"
                                                    onclick="handleDelete({{ $user->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="deletePostForm-{{ $user->id }}"
                                                    action="{{ route('users.destroy', $user->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                @endif



                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->image)
                                                    <a href="{{ asset('storage/' . $user->image) }}" data-fancybox="gallery"
                                                        data-caption="{{ $user->name }}">
                                                        <img src="{{ asset('storage/images/resized/' . basename($user->image)) }}"
                                                            alt="{{ $user->name }}" style="height: 50px;">
                                                    </a>
                                                @else
                                                    <a>No image available</a>
                                                @endif
                                            </td>
                                            <td>{{ $user->phone ? $user->phone : 'N/A' }}</td>
  <td>
                                                 <div class="form-check form-switch">
                                                    <input class="form-check-input statususer-toggle" type="checkbox" data-id="{{ $user->id }}"
                                                        {{ $user->status ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="statusLabel{{ $user->id }}">
                                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                                    </label>
                                                </div>
                                            </td>

                                            {{-- <td>{{ $user->address ? $user->address : 'N/A' }}</td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>


                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>


                            <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>
                </div>
            </div> <!-- /.col -->
        </div> <!--end::Row-->
    @endsection
@push('scripts')
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.statususer-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            let selectedUserId = this.getAttribute('data-id');
            let selectedStatus = this.checked;

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
                    updateStatus(selectedUserId, selectedStatus);
                } else {
                    // Revert the toggle if canceled
                    this.checked = !selectedStatus;
                }
            });
        });
    });

    // Update status using AJAX and show SweetAlert on success
    function updateStatus(id, status) {
        fetch(`/user/update-status/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Status updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Optionally, reload the page or update the UI
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update status.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                // Revert the checkbox status if update failed
                document.querySelector(`input[data-id="${id}"]`).checked = !status;
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            // Revert the checkbox status if AJAX call fails
            document.querySelector(`input[data-id="${id}"]`).checked = !status;
        });
    }
});

</script>
@endpush