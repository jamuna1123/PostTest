<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Profile Information') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Profile Information') }}
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
                        <div class="card-title">{{ __('Update Profile') }}</div>
                    </div>
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>{{ __('Name') }}:<span
                                            class="text-danger">*</span></strong></label>
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>{{ __('Email') }}:<span
                                            class="text-danger">*</span></strong></label>
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label"><strong>{{ __('Phone') }}:</strong></label>
                                <input id="phone" name="phone" type="tel"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $user->phone) }}" autocomplete="tel">
                                @error('phone')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label"><strong>{{ __('Address') }}:</strong></label>
                                <input id="address" name="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address', $user->address) }}" autocomplete="address">
                                @error('address')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image"
                                    class="form-label"><strong>{{ __('Profile Image') }}:</strong></label>
                                <input  name="image" type="file"
                                    class="dropify @error('image') is-invalid @enderror"     data-default-file="{{ isset($user->image) ? asset('storage/images/original/' . $user->image) : '' }}">
                                @error('image')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                                {{-- @if ($user->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/images/original/' . $user->image) }}"
                                            alt="Current Image" class="img-thumbnail" width="150">
                                    </div>
                                @endif --}}
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
                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> {{ __('Save') }}
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
