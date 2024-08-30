@extends('admin.layouts.app')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Add New Post Category</h2>
    
        <div class="card-body">
      


            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('postcategory.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('postcategory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="mb-3">
                    <label for="image" class="form-label"><strong>Image:</strong></label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                        id="image" placeholder="image">
                    @error('image')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label"><strong>Title:</strong></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="Title">
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                   <div class="mb-3">
                    <label for="slug" class="form-label"><strong>Slug:</strong></label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                        id="slug" placeholder="Slug">
                    @error('slug')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputdesc" class="form-label"><strong>Description:</strong></label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" style="height:150px" name="desc" id="desc"
                        placeholder="Description"></textarea>
                    @error('desc')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
@endsection
