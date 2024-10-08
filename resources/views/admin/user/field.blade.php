<div class="card-body">
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-6">
            <!-- Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">
                    <strong>Name:
                        <span class="text-danger">*</span>
                    </strong>
                </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="Name" value="{{ old('name', $user->name ?? '') }}">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Input -->
            <div class="mb-3">
                <label for="phone" class="form-label">
                    <strong>Phone:
                        <span class="text-danger">*</span>
                    </strong>
                </label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" placeholder="Phone" value="{{ old('phone', $user->phone ?? '') }}">
                @error('phone')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address Input -->
            <div class="mb-3">
                <label for="address" class="form-label">
                    <strong>Address:
                        <span class="text-danger">*</span>
                    </strong>
                </label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    id="address" placeholder="Address" value="{{ old('address', $user->address ?? '') }}">
                @error('address')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Input (only show on create page) -->
     @if (!isset($user) || !$user->exists)
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <strong>Password:
                            <span class="text-danger">*</span>
                        </strong>
                    </label>
                    <div class="position-relative">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password" oninput="toggleIconVisibility()">
                        <i class="fa fa-eye-slash position-absolute" id="togglePassword"
                            style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none;"></i>
                    </div>
                    @error('password')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-md-6">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    <strong>Email:
                        <span class="text-danger">*</span>
                    </strong>
                </label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" placeholder="Email" value="{{ old('email', $user->email ?? '') }}">
                @error('email')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Input -->
            <div class="mb-3">
                <label for="image" class="form-label"><strong>Image:</strong></label>
                <input type="hidden" name="image" id="image" class="form-control">
                @error('image')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Full Column for Status -->
    @if (auth()->check() && auth()->id() !== $user->id)
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="status" class="form-label">
                        <strong>Status:
                            <span class="text-danger">*</span>
                        </strong>
                    </label>
                    <div class="form-check form-switch">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox"
                            role="switch" id="statususer" name="status" value="1"
                            {{ (isset($user) && $user->status) || old('status') ? 'checked' : '' }}
                            onchange="toggleStatusLabeluser()">
                        <label class="form-check-label" for="status" id="statusLabeluser">
                            {{ (isset($user) && $user->status) || old('status') ? 'Active' : 'Inactive' }}
                        </label>
                    </div>
                    @error('status')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    <!-- Email Verification (for users who need to verify email) -->
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
