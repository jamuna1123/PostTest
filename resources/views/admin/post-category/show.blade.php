<!-- resources/views/admin/post-category/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Post Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Post Category
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="container">

        <div>
            <strong>Title:</strong> {{ $postcategory->title }}
        </div>
        <div>
            <strong>Slug:</strong> {{ $postcategory->slug }}
        </div>
        <div>
            <strong>Status:</strong> {{ $postcategory->status ? 'Active' : 'Inactive' }}
        </div>
        <div>
            <strong>Image:</strong>
            @if ($postcategory->image)
                <img src="{{ asset('storage/' . $postcategory->image) }}" alt="{{ $postcategory->title }}"
                    style="width: 50px; height: auto;">
            @else
                <p>No image available</p>
            @endif
        </div>

        <a href="{{ route('post-category.index') }}">Back to List</a>

    </div>
@endsection
