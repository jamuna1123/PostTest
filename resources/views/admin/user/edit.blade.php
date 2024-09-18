@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User
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
                            <div class="card-title">Edit User</div>
                        </div>
                        <form action="{{ route('users.store') }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">
                                            <strong>name:
                                                @if (true)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </strong>
                                        </label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="Name" value="{{ old('title', $user->name ?? '') }}">
                                        @error('name')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">
                                            <strong>email:
                                                @if (true)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </strong>
                                        </label>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="Email" value="{{ old('email', $user->email ?? '') }}">
                                        @error('email')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="phone" class="form-label">
                                            <strong>Phone:
                                                @if (true)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </strong>
                                        </label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="Phone" value="{{ old('phone', $user->phone ?? '') }}">
                                        @error('phone')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <!-- Image Input -->
                                    <div class="mb-3 col-md-6">
                                        <label for="image" class="form-label"><strong>Image:@if (false)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </strong></label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        @error('image')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="mb-3">
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}
                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>
                                    Update</button>
                                <a href="{{ route('users.index') }}" class="btn btn-warning text-white">
                                    <i class="fas fa-times-circle"></i> Cancel</a>
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
                @if (isset($postcategory) && $postcategory->image)
                    {
                        source: '{{ asset('storage/' . $postcategory->image) }}',
                        options: {
                            type: 'local',
                        },
                    }
                @endif
            ],
        });
    </script>
@endpush
