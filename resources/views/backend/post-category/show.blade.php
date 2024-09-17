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
                    {{-- <div class="card-header">
                        <div class="card-title">Post Category Details</div>
                    </div> --}}
                    <div class="card-body mt-1">
                        <table class="table  table-striped">
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
                                    <th>Description:</th>
                                    <td>{!! $postcategory->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td> <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-id="{{ $postcategory->id }}"
                                                        {{ $postcategory->status ? 'checked' : '' }}>
                                                    <label class="form-check-label" id="statusLabel{{ $postcategory->id }}">
                                                        {{-- {{ $postCategory->status ? 'Active' : 'Inactive' }} --}}
                                                    </label>
                                                </div></td>
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

                                  <tr>
                                    <th>Created At:</th>
                                    <td>{{ $postcategory->created_at}}</td>
                                </tr>
                                  <tr>
                                    <th>Created By:</th>
                                    <td>{{$postcategory->username->name}}</td>
                                </tr>
                                  <tr>
                                    <th>Updated At:</th>
                                    <td>{{$postcategory->updated_at}}</td>
                                </tr>
                                <tr>
                                    <th>Updated By:</th>
                                     <td>{{$postcategory->username->name}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('post-category.index') }}" class="btn btn-warning me-2"><i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            <a href="{{ route('post-category.create') }}" class="btn btn-success  me-2"> <i class="fas fa-plus"></i>
                                Create
                            </a>
                            <a href="{{ route('post-category.edit', $postcategory->id) }}" class="btn btn-primary">
                               <i class="fas fa-edit"></i> Update
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
