@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post Category Detail</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post Category Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-1">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Category Name:</th>
                                    <td>{{ $postcategory->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $postcategory->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Image:</th>
                                    <td>
                                        @if ($postcategory->image)
                                            <a href="{{ asset('storage/' . $postcategory->image) }}" data-fancybox="gallery"
                                                data-caption="{{ $postcategory->title }}">
                                                <img src="{{ asset('storage/images/resized/' . basename($postcategory->image)) }}"
                                                    alt="{{ $postcategory->title }}" style="height: 50px;">
                                            </a>
                                        @else
                                            <a>No image available</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td style="max-width: 400px; word-wrap: break-word; white-space: normal;">
                                        {!! $postcategory->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-id="{{ $postcategory->id }}"
                                                {{ $postcategory->status ? 'checked' : '' }}>
                                            <label class="form-check-label" id="statusLabel{{ $postcategory->id }}">
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $postcategory->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Created By:</th>
                                    <td>{{ $postcategory->username->name }}</td>
                                </tr>
                                @if ($postcategory->updated_at && $postcategory->updated_by)
                                    <tr>
                                        <th>Updated At:</th>
                                        <td>{{ $postcategory->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By:</th>
                                        <td>{{ $postcategory->userupdate->name }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('post-category.index') }}" class="btn btn-warning me-2 text-white"><i
                                    class="fas fa-arrow-left"></i> Back
                            </a>
                            <a href="{{ route('post-category.create') }}" class="btn btn-success me-2"><i
                                    class="fas fa-plus"></i> Create
                            </a>
                            <a href="{{ route('post-category.edit', $postcategory->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            <a class="btn btn-danger me-2" onclick="handleDelete({{ $postcategory->id }})">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            <form id="deletePostForm" action="{{ route('post-category.destroy', $postcategory->id) }}"
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

    <style>
        table th {
            vertical-align: middle;
            width: 30%;
            /* Ensuring fixed width for table headers */
        }

        table td {
            word-wrap: break-word;
            white-space: normal;
            /* Ensures that long words break */
            max-width: 70%;
            /* Adjust as necessary to fit the layout */
        }

        /* For long descriptions */
        table td {
            max-width: 400px;
            /* Adjust as necessary */
        }
    </style>
@endsection
