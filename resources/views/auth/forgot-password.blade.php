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
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Email Password Reset Link') }}
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
