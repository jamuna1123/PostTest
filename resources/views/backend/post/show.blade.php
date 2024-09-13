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
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                    <div class="card-title">Post Details</div>

                    </div>
                    <div class="card-body mt-3">
                        <div>
                            <strong>Title:</strong> {{ $post->title }}
                        </div>
                        <div>
                            <strong>Slug:</strong> {{ $post->slug }}
                        </div>
                        <div>
                            <strong>Status:</strong> {{ $post->status ? 'Active' : 'Inactive' }}
                        </div>
                        <div>
                            <strong>User Name:</strong> {{ $post->username->name }}
                        </div>
                        <div>
                            <strong>Post Category Name:</strong> {{ $post->postCategory->title }}
                        </div>
                        <div>
                            <strong>Description:</strong> {!! $post->description !!}
                        </div>
                        <div>
                            <strong>Image:</strong>
                            @if ($post->image)
                                <img src="{{ asset('storage/images/resized/' . $post->image) }}" alt="{{ $post->title }}"
                                    style="width: 50px; height: auto;">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                        <a href="{{ route('post.index') }}" class="btn btn-secondary mt-3 btn-sm">
                        Back
                        </a>
                          <a href="{{ route('post.create') }}" class="btn btn-primary mt-3 btn-sm">
                      Create
                        </a>
                         <a href="{{ route('post.edit',$post->id) }}" class="btn btn-success mt-3 btn-sm">
                         Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
