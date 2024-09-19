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
                            {{-- <h3 class="card-title">Post List</h3> --}}
                            <div class="d-grid gap-2 d-md-flex  mb-1">
                                <a class="btn btn-success" href="{{ route('post.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 280px">Action</th>
                                        <th>Post Title</th>

                                        <th>Category</th>
                                        <th>Image</th>

                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($post as $posts)
                                        <tr class="align-middle">
                                            <td>
                                                <a href="{{ route('post.show', $posts->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('post.edit', $posts->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="handleDelete({{ $posts->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="deletePostForm" action="{{ route('post.destroy', $posts->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </td>
                                            <td>{{ $posts->title }}</td>

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
                                                    <a>No image available</a>
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

        
    @endsection
