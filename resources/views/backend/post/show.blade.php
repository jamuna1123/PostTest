@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post Detail</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
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
                        <div class="card-title">Post Details</div>
                    </div> --}}
                    <div class="card-body mt-1">
                        
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Post Title:</th>
                                        <td>{{ $post->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug:</th>
                                        <td>{{ $post->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category Name:</th>
                                        <td>
                                            @if ($post->postCategory)
                                                {{ $post->postCategory->title }}
                                            @else
                                                None
                                            @endif
                                        </td>

                                    </tr>
                                      <tr>
                                        <th>Image:</th>
                                        <td>
                                            @if ($post->image)
                                                <a href="{{ asset('storage/' . $post->image) }}" data-fancybox="gallery"
                                                    data-caption="{{ $post->title }}">
                                                    <img src="{{ asset('storage/images/resized/' . basename($post->image)) }}"
                                                        alt="{{ $post->title }}" style="height: 50px;">
                                                </a>
                                            @else
                                                <p>No image available</p>
                                            @endif
                                        </td>

                                    <tr>
                                    <tr>
                                        <th>Description:</th>
                                        <td>
                                            <div class="text-truncate" style="max-width: 100%; white-space: pre-wrap;">
                                                {!! $post->description !!}
                                            </div>
                                        </td>
                                    </tr>
                                       <tr>
                                        <th>Publish At:</th>
                                        <td>{{ $post->published_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input statuspost-toggle" type="checkbox"
                                                    data-id="{{ $post->id }}" {{ $post->status ? 'checked' : '' }}>
                                                <label class="form-check-label" id="statusLabel{{ $post->id }}">
                                                    {{-- {{ $posts->status ? 'Active' : 'Inactive' }} --}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>


                                 

                                  
                                        <th>Created At:</th>
                                        <td>{{ $post->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By:</th>
                                        <td>{{ $post->username->name }}</td>
                                    </tr>
                                    {{-- Only show Updated At and Updated By if the record has been updated --}}
                                    @if ($post->created_at != $post->updated_at)
                                        <tr>
                                            <th>Updated At:</th>
                                            <td>{{ $post->updated_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated By:</th>
                                            <td>{{ $post->userupdate->name ?? 'Unknown' }}</td> {{-- Assuming the relation is updatedBy --}}
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        

                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('post.index') }}" class="btn btn-warning me-2 text-white"><i
                                    class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            <a href="{{ route('post.create') }}" class="btn btn-success  me-2"> <i class="fas fa-plus"></i>
                                Create
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            <a class="btn btn-danger me-2" onclick="handleDelete({{ $post->id }})">
                                <i class="fas fa-trash"></i>Delete
                            </a>
                            <form id="deletePostForm" action="{{ route('post.destroy', $post->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        table th {
            vertical-align: middle;
            width: 30%; /* Ensuring fixed width for table headers */
        }

        table td {
            word-wrap: break-word;
            white-space: normal; /* Ensures that long words break */
            max-width: 70%; /* Adjust as necessary to fit the layout */
        }

        /* For long descriptions */
        table td {
            max-width: 400px; /* Adjust as necessary */
        }
    </style>
@endsection
