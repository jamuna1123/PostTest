@extends('admin.layouts.app')
   
@section('content')
  
<div class="card mt-5">
      @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
  <h2 class="card-header">Post Category</h2>
  <div class="card-body">
                  
        
  
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('postcategory.create') }}"> <i class="fa fa-plus"></i> Create New Post Category</a>
        </div>
  
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Image</th>
                    <th>Title</th>
                        <th>Slug</th>
                    <th>Description</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>
  
            <tbody>
                @forelse ($postcategory as $postcategory)
                <tr>
                    <td>{{ $postcategory->id }}</td>
                    <td><img src="{{ asset($postcategory->image) }}" style="width:100px; height:100px"></td>
                    <td>{{ $postcategory->title }}</td>
                     <td>{{ $postcategory->slug }}</td>
                     <td>{{ $postcategory->desc }}</td>

                       <td>
                        <form action="{{ route('postcategory.destroy',$postcategory->id) }}" method="POST">
             
                           
              
                            <a class="btn btn-primary btn-sm" href="{{ route('postcategory.edit',$postcategory->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
            @endforelse
                {{-- <tr>
                    <td colspan="4">There are no data.</td>
                </tr> --}}
        
            </tbody>
  
        </table>
       
   
  </div>
</div>  
@endsection