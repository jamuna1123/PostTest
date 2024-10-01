@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-sm-6">
                    <h3 class="mb-0">Post Category</h3>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ Breadcrumbs::render('post-category.index') }}

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
                       <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex mb-1">
                                <a class="btn btn-success" href="{{ route('post-category.create') }}" id="createNewProduct">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body p-3">
                            {!! $dataTable->table() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup status toggles for this module
            setupStatusToggles('.status-toggle', '/post-category/update-status');

            // Re-initialize the status toggle after DataTable is drawn
            $(document).on('draw.dt', function() {
                setupStatusToggles('.status-toggle', '/post-category/update-status');
            });
        });
    </script>
@endpush
