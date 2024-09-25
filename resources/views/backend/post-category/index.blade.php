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
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex mb-1">
                                <a class="btn btn-success" href="{{ route('post-category.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection

@push('styles')
    <style>
      
        table.dataTable {
            width: 100% !important;
            margin-bottom: 20px;
        }

    </style>
@endpush

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
