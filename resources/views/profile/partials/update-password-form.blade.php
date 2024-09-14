<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Update Password') }}</h3>
            </div>
        </div>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}</div>
                    </div>
                    <form method="post" action="{{ route('password.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="update_password_current_password"
                                    class="form-label"><strong>{{ __('Current Password') }}:@if (true)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </strong></label>

                                    
                             <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password"
                                    class="form-label"><strong>{{ __('New Password') }}:
                                        @if (true)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </strong></label>
                                   <x-text-input id="update_password_password" name="password" type="password" class="form-control mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password_confirmation"
                                    class="form-label"><strong>{{ __('Confirm Password') }}:
                                        @if (true)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </strong></label>
                                 <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> {{ __('Save') }}
                            </button>

                            @if (session('status') === 'password-updated')
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
