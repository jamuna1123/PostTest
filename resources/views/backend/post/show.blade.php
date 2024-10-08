@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-sm-6">
                    <h3 class="mb-0">Post</h3>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page"> {{ Breadcrumbs::render('post.show', $post) }}
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
                        <div class="card-title">Post Details</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-fixed">
                            <tbody>
                                <tr>
                                    <th style="width: 170px">Post Title:</th>
                                    <td>{{ $post->title }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Slug:</th>
                                    <td>{{ $post->slug }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Category:</th>
                                    <td>
                                        @if ($post->category)
                                            {{ $post->category->title }}
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Image:</th>
                                    <td>
                                        @if ($post->image)
                                            <a href="{{ asset('storage/' . $post->image) }}" data-fancybox="gallery"
                                                data-caption="{{ $post->title }}">
                                                <img src="{{ asset('storage/images/resized/' . basename($post->image)) }}"
                                                    alt="{{ $post->title }}" style="height: 50px;">
                                            </a>
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Description:</th>
                                    <td style="max-width: 400px; word-wrap: break-word; white-space: normal;">
                                        @if ($post->description)
                                            {!! $post->description !!}
                                        @else
                                            N/A
                                        @endif

                                    </td>

                                </tr>
                                <tr>
                                    <th style="width: 170px">Publish At:</th>
                                    <td>{{ $post->published_at }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Status:</th>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-id="{{ $post->id }}" {{ $post->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusLabel{{ $post->id }}">
                                                {{-- {{ $post->status ? 'On' : 'Off' }} --}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Created At:</th>
                                    <td>{{ $post->created_at }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 170px">Created By:</th>
                                    <td>{{ $post->username->name }}</td>
                                </tr>
                                @if ($post->updated_at && $post->updated_by)
                                    <tr>
                                        <th style="width: 170px">Updated At:</th>
                                        <td>{{ $post->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 170px">Updated By:</th>
                                        <td>{{ $post->userupdate->name }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('post.index') }}" class="btn btn-warning me-2 text-white">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <a href="{{ route('post.create') }}" class="btn btn-success me-2">
                                <i class="fas fa-plus"></i> Create
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            <a class="btn btn-danger me-2" onclick="handleDelete({{ $post->id }})">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            <form id="deletePostForm-{{ $post->id }}" action="{{ route('post.destroy', $post->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
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
            setupStatusToggles('.status-toggle', '/post/update-status');
        });
    </script>
@endpush
