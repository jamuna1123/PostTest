@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">User Details</div>
                    </div>
                    <div class="card-body mt-3">
                        <table class="table table-striped table-fixed">
                            <tbody>
                                <tr>
                                    <th style="width: 200px">Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Image:</th>
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
                                </tr>
                                <tr>
                                    <th style="width: 200px">Phone:</th>

                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Address:</th>
                                    <td>{{ $user->address ? $user->address : 'N/A' }}</td>
                                </tr>

                                <tr>
                                    <th style="width: 200px">Created At:</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Created By:</th>
                                    <td>{{ $user->username ? $user->username->name : 'N/A' }}</td> {{-- Check if 'created_by' exists --}}
                                </tr>
                                {{-- Only show Updated At and Updated By if the record has been updated --}}
                                @if ($user->updated_at && $user->updated_by)
                                    <tr>
                                        <th style="width: 200px">Updated At:</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Updated By:</th>
                                        <td>{{ $user->userupdate->name }}</td> {{-- Assuming the relation is updatedBy --}}
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-warning me-2 text-white"><i
                                    class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            <a href="{{ route('users.create') }}" class="btn btn-success  me-2"> <i
                                    class="fas fa-plus"></i>
                                Create
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            @if (auth()->id() !== $user->id)
                                <!-- Check if the authenticated user is not the same as the current user -->
                                <a class="btn btn-danger me-2" onclick="handleDelete({{ $user->id }})"
                                    data-bs-toggle="modal" data-bs-target="#modal-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <form id="deletePostForm" action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        /* / Ensure the table header (th) has a fixed width / */
        .fixed-table {
            table-layout: fixed;
            width: 100%;
        }

        .fixed-table th {
            width: 200px;
            white-space: nowrap;
        }

        .fixed-table td {
            width: auto;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }
    </style>
@endpush
