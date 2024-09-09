@extends('admin.layouts.auth')

@section('content')
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo">
            <a href="../index2.html"><b>Admin</b>LTE</a>
        </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    {{ __('Reset your password') }}
                </p>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus placeholder="Email" />
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3 mt-4">
                        <x-text-input id="password" class="form-control" type="password" name="password" required placeholder="New Password" />
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group mb-3 mt-4">
                        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="Confirm Password" />
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
                
                <p class="mt-4 mb-0">
                    <a href="{{ route('login') }}" class="text-center">Back to Login</a>
                </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box -->
</body>
@endsection
