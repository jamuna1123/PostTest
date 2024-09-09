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
                            <h3 class="card-title">Users List</h3>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-1">
                                {{-- <a class="btn btn-primary" href="{{ route('users.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Add Users
                                </a> --}}
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        
                                        <th style="width: 280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="align-middle">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                         
                                           
                                          
                                            <td>
                                                {{-- <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-success btn-sm">Edit</a> --}}
                                                <a class="btn btn-danger btn-sm" onclick="handleDelete({{ $user->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#modal-danger">
                                                    Delete
                                                </a>

                                            </td>
                                       

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
<div class="modal fade" id="modal-danger" tabindex="-1" aria-labelledby="modal-dangerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="confirmDeleteButton" method="Users" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-dangerLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="redirectToUsers()"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item? This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="redirectToUsers()">Close</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
    @endsection
   <!-- for delete conformation  -->
   <script>
    function handleDelete(id) {
        var form = document.getElementById('confirmDeleteButton');
        form.action = 'users/' + id;
        var modal = new bootstrap.Modal(document.getElementById('modal-danger'));
        modal.show();
    }

    function redirectToUsers() {
        window.location.href = "{{ route('users.index') }}";
    }

    // Optionally handle modal hidden event (if user dismisses using the backdrop or other means)
    var deleteModal = document.getElementById('modal-danger');
    deleteModal.addEventListener('hidden.bs.modal', function (event) {
        redirectToUsersCategory();
    });
</script>
