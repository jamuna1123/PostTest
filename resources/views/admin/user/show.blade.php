@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-sm-6">
                    <h3 class="mb-0">User</h3>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page"> {{ Breadcrumbs::render('users.show', $user) }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">User Details</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-fixed">
                            <tbody>
                                <tr>
                                    <th style="width: 170px">Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Image:</th>
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
                                    <th style="width: 170px">Phone:</th>

                                    <td>{{ $user->phone ? $user->phone : 'N/A' }}</td>
                                </tr>
                                {{-- <tr>
                                    <th style="width: 170px">Address:</th>
                                    <td>{{ $user->address ? $user->address : 'N/A' }}</td>
                                </tr> --}}
                                <tr>
                                    <th style="width: 170px">Status:</th>
                                    <td>
                                        @if (auth()->check() && auth()->id() === $user->id)
                                            <!-- Show a button based on the user's status for the authenticated user -->
                                            <span
                                                style="color: #fff;
             background-color: {{ $user->status ? '#28a745' : '#dc3545' }};"
                                                class="badge {{ $user->status ? 'badge-success' : 'badge-danger' }}">
                                                {{ $user->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        @else
                                            <!-- Show toggle switch for other users -->
                                            {{-- <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" type="checkbox"
                                                    data-id="{{ $user->id }}" {{ $user->status ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusLabel{{ $user->id }}">
                                                </label>
                                            </div> --}}
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" type="checkbox"
                                                    data-id="{{ $user->id }}" {{ $user->status ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    id="statusLabel{{ $user->id }}"></label>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 170px">Created At:</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Created By:</th>
                                    <td>{{ $user->username ? $user->username->name : 'N/A' }}</td> {{-- Check if 'created_by' exists --}}
                                </tr>
                                {{-- Only show Updated At and Updated By if the record has been updated --}}
                                @if ($user->updated_at && $user->updated_by)
                                    <tr>
                                        <th style="width: 170px">Updated At:</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 170px">Updated By:</th>
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
                                <a class="btn btn-danger me-2" onclick="handleDelete({{ $user->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <form id="deletePostForm-{{ $user->id }}"
                                    action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
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
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup status toggles for this module
            setupStatusToggles('.status-toggle', '/users/update-status');
        });
    </script>
@endpush
