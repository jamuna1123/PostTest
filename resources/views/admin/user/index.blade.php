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
                                                        onclick="handleDelete({{ $user->id }})" data-bs-toggle="modal"
                                                        data-bs-target="#modal-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="deletePostForm"
                                                        action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        style="display: none;">
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
                                            <td>{{ $user->phone }}</td>



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
   
