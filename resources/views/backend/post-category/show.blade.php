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
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('post-category.show', $postcategory) }}
</li>
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
                    <div class="card-body">
                        <table class="table table-striped table-fixed">
                            <tbody>
                                <tr>
                                    <th style="width: 200px">Category Name:</th>
                                    <td>{{ $postcategory->title }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Slug:</th>
                                    <td>{{ $postcategory->slug }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Image:</th>
                                    <td>
                                        @if ($postcategory->image)
                                            <a href="{{ asset('storage/' . $postcategory->image) }}" data-fancybox="gallery"
                                                data-caption="{{ $postcategory->title }}">
                                                <img src="{{ asset('storage/images/resized/' . basename($postcategory->image)) }}"
                                                    alt="{{ $postcategory->title }}" style="height: 50px;">
                                            </a>
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Description:</th>
                                    <td style="max-width: 400px; word-wrap: break-word; white-space: normal;">
                                        @if ($postcategory->description)
                                            {!! nl2br(e($postcategory->description)) !!}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Status:</th>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-id="{{ $postcategory->id }}"
                                                {{ $postcategory->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusLabel{{ $postcategory->id }}">
                                                {{-- {{ $postcategory->status ? 'On' : 'Off' }} --}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Created At:</th>
                                    <td>{{ $postcategory->created_at }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Created By:</th>
                                    <td>{{ $postcategory->username->name }}</td>
                                </tr>
                                @if ($postcategory->updated_at && $postcategory->updated_by)
                                    <tr>
                                        <th style="width: 200px">Updated At:</th>
                                        <td>{{ $postcategory->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Updated By:</th>
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
                            <a class="btn btn-danger me-2" onclick="postcategoryDelete({{ $postcategory->id }})">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            <form id="deletePostcategoryForm-{{ $postcategory->id }}"
                                action="{{ route('post-category.destroy', $postcategory->id) }}" method="POST"
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
            setupStatusToggles('.status-toggle', '/post-category/update-status');
        });
    </script>

@endpush