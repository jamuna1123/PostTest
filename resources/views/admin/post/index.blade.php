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
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Post List</h3>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                                <a class="btn btn-primary" href="{{ route('post.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i>Add Post
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 60px">No</th>
                                          <th>User</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                      

                                        <th>Post Category</th>

                                        <th>Status</th>

                                        <th style="width: 280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $posts)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                             <td>
                                                @if ($posts->username)
                                                    {{ $posts->username->name }}
                                                @else
                                                    None
                                                @endif
                                            </td>
                                          
                                            <td>{{ $posts->title }}</td>
                                            <td>{{ $posts->slug }}</td>
                                            <td>
                                                @if ($posts->image)
                                                    <img src="{{ asset('storage/' . $posts->image) }}"
                                                        alt="{{ $posts->title }}" style="width: 50px; height: auto;">
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>





                                            <td>
                                                @if ($posts->postCategory)
                                                    {{ $posts->postCategory->title }}
                                                @else
                                                    None
                                                @endif
                                            </td>

                                            <td>{{ $posts->status ? 'Active' : 'Inactive' }}</td>

                                            <td>
                                                <a href="{{ route('post.show', $posts->id) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('post.edit', $posts->id) }}"
                                                    class="btn btn-success btn-sm">Edit</a>
                                                <form action="{{ route('post.destroy', $posts->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $post->links('pagination::bootstrap-5') }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
