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
                        <li class="breadcrumb-item active" aria-current="page">
                            Post Category
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card card-primary mb-4">
                        <div class="card-header">
                            <div class="card-title">Create Post Category</div>
                        </div>
                        <form action="{{ route('post-category.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @include('backend.post-category.field')
                             
                            <div class="card-footer">
                                 <a href="{{ route('post-category.index') }}" class="btn"><i
                                        class="fa-solid fa-arrow-left"></i> Back</a>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
           
                                    Submit</button>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

 
