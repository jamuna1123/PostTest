@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post Category</li>
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
                        <div class="card-title">Post Category Details</div>
                    </div>
                    <div class="card-body mt-3">
                        <table class="table  table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Title:</th>
                                    <td>{{ $postcategory->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $postcategory->slug }}</td>
                                </tr>
                                 <tr>
                                    <th>Description:</th>
                                    <td>{!! $postcategory->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $postcategory->status ? 'Active' : 'Inactive' }}</td>
                                </tr>
                                <tr>
                                    <th>Image:</th>
                                    <td>
                                        @if ($postcategory->image)
                                             <a href="{{ asset('storage/' . $postcategory->image) }}"
                                                        data-fancybox="gallery" data-caption="{{ $postcategory->title }}">
                                                        <img src="{{ asset('storage/images/resized/' . basename($postcategory->image)) }}"
                                                            alt="{{ $postcategory->title }}" style="height: 50px;">
                                                    </a>
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('post-category.index') }}" class="btn btn-secondary btn-sm me-2">
                                Back
                            </a>
                            <a href="{{ route('post-category.create') }}" class="btn btn-primary btn-sm me-2">
                                Create
                            </a>
                            <a href="{{ route('post-category.edit', $postcategory->id) }}" class="btn btn-success btn-sm">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
