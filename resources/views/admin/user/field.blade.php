<div class="card-body">
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="name" class="form-label">
                <strong>Name:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                placeholder="Name" value="{{ old('name', $user->name ?? '') }}">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">
                <strong>Email:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
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
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                placeholder="Phone" value="{{ old('phone', $user->phone ?? '') }}">
            @error('phone')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address Input (Newly Added) -->
        <div class="mb-3 col-md-6">
            <label for="address" class="form-label">
                <strong>Address:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address"
                placeholder="Address" value="{{ old('address', $user->address ?? '') }}">
            @error('address')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Input -->
        <div class="mb-3 col-md-6">
            <label for="image" class="form-label"><strong>Image:
                    @if (false)
                        <span class="text-danger">*</span>
                    @endif
                </strong></label>
            <input type="hidden" name="image" id="image" class="form-control">
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
