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
                    <div class="card-body mt-3">
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
                                    <th>Phone:</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                               
                                <tr>
                                    <th>Image:</th>
                                    <td>
                                       @if ($user->image)
                                                <a href="{{ asset('storage/' . $user->image) }}"
                                                    data-fancybox="gallery" data-caption="{{ $user->name }}">
                                                    <img src="{{ asset('storage/images/resized/' . basename($user->image)) }}"
                                                        alt="{{ $user->name }}" style="height: 50px;">
                                                </a>
                                            @else
                                                <p>No image available</p>
                                            @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-warning me-2 text-white"><i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                             <a href="{{ route('users.create') }}" class="btn btn-success  me-2"> <i class="fas fa-plus"></i>
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
@endsection
