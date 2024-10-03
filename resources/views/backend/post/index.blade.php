@extends('layouts.app')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                {{-- <div class="col-sm-6">
                    <h3 class="mb-0">Post</h3>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ Breadcrumbs::render('post.index') }}
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
               
                        <!-- Second Card: Striped Full Width Table -->
                        <div class="card mb-4">
                            <div class="card-header">
                                {{-- <h3 class="card-title">Post List</h3> --}}
                                <div class="d-grid gap-2 d-md-flex  mb-1">
                                    <a class="btn btn-success" href="{{ route('post.create') }}" id="createNewProduct">
                                        <i class="fa fa-plus"></i> Create
                                    </a>
                                </div>
                            </div> <!-- /.card-header -->

                            <div class="card-body p-3">

                                <div class="table-responsive">
                                    {!! $dataTable->table(['class' => 'table table-striped table-bordered dt-responsive nowrap', 'width' => '100%']) !!}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div> <!-- /.card -->
                  
                </div>
            </div> <!-- /.col -->
        </div> <!--end::Row-->
    @endsection


    @push('scripts')
        {!! $dataTable->scripts() !!}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Setup status toggles for this module
                setupStatusToggles('.status-toggle', '/post/update-status');

                // Re-initialize the status toggle after DataTable is drawn
                $(document).on('draw.dt', function() {
                    setupStatusToggles('.status-toggle', '/post/update-status');
                });
            });
        </script>
    @endpush
