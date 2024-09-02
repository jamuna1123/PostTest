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
                <h4>Post Category Details</h4>
            </div>
            <div class="card-body mt-3">
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
                        <img src="{{ asset('storage/' . $postcategory->image) }}" alt="{{ $postcategory->title }}" style="width: 50px; height: auto;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                <a href="{{ route('post-category.index') }}" class="btn btn-primary mt-3">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
