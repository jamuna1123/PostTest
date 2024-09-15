@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post</li>
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
                        <div class="card-title">Post Details</div>
                    </div>
                    <div class="card-body mt-3">
                        <table class="table  table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Title:</th>
                                    <td>{{ $post->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $post->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $post->status ? 'Active' : 'Inactive' }}</td>
                                </tr>
                                <tr>
                                    <th>User Name:</th>
                                    <td>{{ $post->username->name }}</td>
                                </tr>
                                <tr>
                                    <th>Post Category Name:</th>
                                    <td>{{ $post->postCategory->title }}</td>
                                </tr>
                                 <tr>
                                    <th>Publish At:</th>
                                    <td>{{ $post->published_at }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{!! $post->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Image:</th>
                                    <td>
                                       @if ($post->image)
                                                   <a href="{{ asset('storage/' . $post->image) }}"
                                                        data-fancybox="gallery" data-caption="{{ $post->title }}">
                                                        <img src="{{ asset('storage/images/resized/' . basename($post->image)) }}"
                                                            alt="{{ $post->title }}" style="height: 50px;">
                                                    </a>
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('post.index') }}" class="btn btn-secondary btn-sm me-2">
                                Back
                            </a>
                            <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm me-2">
                                Create
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
