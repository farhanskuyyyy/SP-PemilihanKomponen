@extends('layouts.guest')
@section('content')
    <div class="container">
        <div class="auth-container">
            <div class="text-center mb-4">
                <i class="bi bi-speedometer2 auth-logo"></i>
                <h3 class="fw-bold text-dark">Welcome Back!</h3>
                <p class="text-muted">Sign in to access your admin dashboard</p>
            </div>

            <!-- Alert for messages -->
            <div id="alertContainer"></div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    <label for="email">Email address</label>
                    <div class="invalid-feedback">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-floating position-relative">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Password" required autocomplete="current-password">
                    <label for="password">Password</label>
                    <button type="button" class="password-toggle" id="togglePassword" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="invalid-feedback">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="rememberMe" name="remember" class="form-check-input"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="rememberMe" class="form-check-label text-muted">Remember me</label>
                </div>

                <button type="submit" class="btn btn-auth" id="loginBtn">
                    <span class="btn-text">Sign In</span>
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="#" class="auth-link" id="forgotPasswordLink">Forgot your password?</a>
            </div>

            <div class="text-center mt-4">
                <small class="text-muted">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="auth-link">Sign up here</a>
                </small>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Please enter your email address to receive a password reset link.</p>
                    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="resetEmail" name="email"
                                placeholder="name@example.com" required>
                            <label for="resetEmail">Email address</label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sendResetBtn">Send Reset Link</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @vite(['resources/js/custom/login.js'])
@endsection
