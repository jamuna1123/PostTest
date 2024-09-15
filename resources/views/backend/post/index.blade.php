@extends('layouts.app')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Post
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
                            <h3 class="card-title">Post List</h3>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-1">
                                <a class="btn btn-primary" href="{{ route('post.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Add Post
                                </a>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th style="width: 280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($post as $posts)
                                        <tr class="align-middle">
                                            <td>{{ $posts->title }}</td>
                                            <td>{{ $posts->slug }}</td>
                                            <td>
                                                @if ($posts->postCategory)
                                                    {{ $posts->postCategory->title }}
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td>
                                                @if ($posts->image)
                                                   <a href="{{ asset('storage/' . $posts->image) }}"
                                                        data-fancybox="gallery" data-caption="{{ $posts->title }}">
                                                        <img src="{{ asset('storage/images/resized/' . basename($posts->image)) }}"
                                                            alt="{{ $posts->title }}" style="height: 50px;">
                                                    </a>
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($posts->username)
                                                    {{ $posts->username->name }}
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input statuspost-toggle" type="checkbox"
                                                        data-id="{{ $posts->id }}"
                                                        {{ $posts->status ? 'checked' : '' }}>
                                                    <label class="form-check-label" id="statusLabel{{ $posts->id }}">
                                                        {{-- {{ $posts->status ? 'Active' : 'Inactive' }} --}}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('post.show', $posts->id) }}"
                                                    class="btn btn-info btn-sm text-white"><i class="fas fa-folder"></i> View</a>
                                                <a href="{{ route('post.edit', $posts->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="handleDelete({{ $posts->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger"><i class="fas fa-trash"></i>
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
                                {{ $post->links('pagination::bootstrap-5') }}
                            </div>


                            <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>
                </div>
            </div> <!-- /.col -->
        </div> <!--end::Row-->
        <div class="modal fade" id="modal-danger" tabindex="-1" aria-labelledby="modal-dangerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="confirmDeleteButton" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-dangerLabel">Delete Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="redirectToPost()"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="bu
                            tton" class="btn btn-secondary"
                                data-bs-dismiss="modal" onclick="redirectToPost()">Close</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Toggle Status Modal -->
        <div class="modal fade" id="modal-statuspost-toggle" tabindex="-1" aria-labelledby="modal-statuspost-toggleLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-statuspost-toggleLabel">Confirm Status Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to update the status of this post category?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmStatusUpdate">Update</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <!-- for delete conformation  -->
    <script>
        function handleDelete(id) {
            var form = document.getElementById('confirmDeleteButton');
            form.action = 'post/' + id;
            var modal = new bootstrap.Modal(document.getElementById('modal-danger'));
            modal.show();
        }

        function redirectToPost() {
            window.location.href = "{{ route('post.index') }}";
        }

        // Optionally handle modal hidden event (if user dismisses using the backdrop or other means)
        var deleteModal = document.getElementById('modal-danger');
        deleteModal.addEventListener('hidden.bs.modal', function(event) {
            redirectToPostCategory();
        });
    </script>
