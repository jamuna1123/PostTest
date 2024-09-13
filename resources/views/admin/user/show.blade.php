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
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">User Details</div>
                    </div>
                    <div class="card-body mt-3">
                        <div>
                            <strong>Name:</strong> {{ $user->name }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $user->email }}
                        </div>

                        <div>
                            <strong>Phone:</strong> {{ $user->phone }}
                        </div>
                        <div>
                            <strong>Address:</strong> {{ $user->address }}
                        </div>
                        <div>
                            <strong>Image:</strong>
                            @if ($user->image)
                                <img src="{{ asset('storage/images/resized/' . $user->image) }}" alt="{{ $user->name }}"
                                    style="width: 50px; height: auto;">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>

                        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3 btn-sm">
                            Back
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
