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

                        <li class="breadcrumb-item active" aria-current="page">
                            {{ Breadcrumbs::render('post-category.create') }}

                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Create Post Category</div>
                        </div>
                        <form action="{{ route('post-category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('backend.post-category.field')

                            <div class="card-footer">

                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>

                                    Create</button>
                                <a href="{{ route('post-category.index') }}" class="btn btn-warning text-white"><i
                                        class="fas fa-times-circle"></i> Cancel</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        const pond = FilePond.create(document.querySelector('#image'), {
            acceptedFileTypes: ['image/*'],
            server: {
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
            }
        });

        // If validation fails, reload the image in FilePond
        @if (old('image'))
            pond.addFile('{{ asset('storage/' . old('image')) }}').then(function(file) {
                console.log('File added', file);
            });
        @endif
    </script>
@endpush
