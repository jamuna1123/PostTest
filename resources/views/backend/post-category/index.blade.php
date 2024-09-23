@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Post Category
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">

                        <div class="card-header">
                            {{-- <h3 class="card-title">Post Category List</h3> --}}
                            <div class="d-grid gap-2 d-md-flex  mb-1">
                                <a class="btn btn-success" href="{{ route('post-category.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 60px">No</th> --}}
                                        <th style="width: 280px">Action</th>
                                        <th>Category Name</th>
                                        <th>Category Image</th>

                                        <th>Status</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($postCategories as $postCategory)
                                        <tr class="align-middle">
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>
                                                <a href="{{ route('post-category.show', $postCategory->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('post-category.edit', $postCategory->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="postcategoryDelete({{ $postCategory->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="deletePostcategoryForm-{{ $postCategory->id }}"
                                                    action="{{ route('post-category.destroy', $postCategory->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                            <td>{{ $postCategory->title }}</td>
                                            <td>
                                                @if ($postCategory->image)
                                                    <a href="{{ asset('storage/' . $postCategory->image) }}"
                                                        data-fancybox="gallery" data-caption="{{ $postCategory->title }}">
                                                        <img src="{{ asset('storage/images/resized/' . basename($postCategory->image)) }}"
                                                            alt="{{ $postCategory->title }}" style="height: 50px;">
                                                    </a>
                                                @else
                                                    <a>No image available</a>
                                                @endif
                                            </td>



                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-id="{{ $postCategory->id }}"
                                                        {{ $postCategory->status ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="statusLabel{{ $postCategory->id }}">
                                                        {{ $postCategory->status ? 'On' : 'Off' }}
                                                    </label>
                                                </div>
                                            </td>



                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $postCategories->links('pagination::bootstrap-5') }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->




            <!-- Toggle Status Modal -->
            <div class="modal fade" id="modal-status-toggle" tabindex="-1" aria-labelledby="modal-status-toggleLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-status-toggleLabel">Confirm Status Update</h5>
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
