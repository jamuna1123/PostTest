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
                        
                        <li class="breadcrumb-item active" aria-current="page">
                         {{ Breadcrumbs::render('post.edit', $post) }}

                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="col-12"></div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Edit Post</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('post.update', $post->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!--begin::Body-->
                            @include('backend.post.field')

                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                   <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>
                                    Update</button>
                                      <a href="{{ route('post.index') }}" class="btn btn-warning text-white">
                             <i class="fas fa-times-circle"></i>  Cancel</a>
                              
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->



@endsection
@push('scripts')
 <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        const inputElement = document.querySelector('#image');

        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['image/*'],
            server: {
                load: (source, load, error, progress, abort, headers) => {
                    fetch(source, {
                        mode: 'cors'
                    }).then((res) => {
                        return res.blob();
                    }).then(load).catch(error);
                },
                process: {
                    url: '{{ route('upload') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        // Store the uploaded image path in a hidden input
                    document.getElementById('image').value = data.path;
                    return data.path;
                    }
                },
                revert: {
                    url: '{{ route('revert') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            },

            files: [
                @if (isset($post) && $post->image)
                    {
                        source: '{{ asset('storage/' . $post->image) }}',
                        options: {
                            type: 'local',
                        },
                    }
                @endif
            ],
        });

       
    </script>
   @endpush 
