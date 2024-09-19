@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Detail</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <div class="card-title">User Details</div>
                    </div> --}}
                    <div class="card-body mt-1">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Image:</th>
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
                                    <th>Phone:</th>

                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $user->address ? $user->address : 'User Addrerss Not found' }}</td>
                                </tr>

                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Created By:</th>
                                    <td>{{ $user->username->name }}</td>
                                </tr>
                                {{-- Only show Updated At and Updated By if the record has been updated --}}
                                @if ($user->created_at != $user->updated_at)
                                    <tr>
                                        <th>Updated At:</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By:</th>
                                        <td>{{ $user->userupdate->name ?? 'Unknown' }}</td> {{-- Assuming the relation is updatedBy --}}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <style>
        /* Ensures the table has a consistent layout even with long text */
        table th, table td {
            vertical-align: middle;
        }

        /* For long descriptions */
        table td {
            word-wrap: break-word;
            white-space: normal; /* Ensures that long words break */
            max-width: 400px; /* Adjust as necessary */
        }
    </style>
@endsection
