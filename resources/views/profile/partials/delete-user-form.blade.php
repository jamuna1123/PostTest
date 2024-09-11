<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Delete Account') }}</h3>
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
                        <div class="card-title">
                            {{ __('Are you sure you want to delete your account?') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Before deleting your account, please download any data or information that you wish to retain.') }}
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            {{-- <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2> --}}

                            {{-- <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p> --}}

                            <div class="mt-6">
                                <label for="password" class="form-label">
                                    <strong>
                                        {{ __('Password') }}:@if (true)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </strong>
                                </label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="{{ __('Password') }}">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4 flex justify-end">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Account') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
