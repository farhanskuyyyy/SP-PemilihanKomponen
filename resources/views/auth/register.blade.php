@extends('layouts.guest')
@vite(['resources/js/custom/register.js'])
@section('content')
    <div class="container">
        <div class="auth-container">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus auth-logo"></i>
                <h3 class="fw-bold text-dark">Create Account</h3>
                <p class="text-muted">Fill in the information below to get started</p>
            </div>

            <!-- Alert for messages -->
            <div id="alertContainer"></div>

            <!-- Registration Form -->
            <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control" id="name" name="name" placeholder="name"
                        value="{{ old('name') }}" required autofocus>
                    <label for="name" class="required-field">Name</label>
                    <div class="invalid-feedback">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        value="{{ old('email') }}" required>
                    <label for="email" class="required-field">Email address</label>
                    <div class="invalid-feedback">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-floating position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required autocomplete="new-password">
                    <label for="password" class="required-field">Password</label>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="invalid-feedback">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="password-strength">
                        <div class="d-flex justify-content-between">
                            <span id="strengthText">Password strength</span>
                            <span id="strengthLevel"></span>
                        </div>
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                    </div>
                </div>

                <div class="form-floating position-relative">
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                        placeholder="Confirm Password" required autocomplete="new-password">
                    <label for="confirmPassword" class="required-field">Confirm Password</label>
                    <button type="button" class="password-toggle" id="toggleConfirmPassword">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="agreeTerms" required>
                    <label for="agreeTerms">
                        I agree to the <a href="#" class="auth-link">Terms of Service</a> and
                        <a href="#" class="auth-link">Privacy Policy</a>
                    </label>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-auth" id="registerBtn">
                    <span class="btn-text">Create Account</span>
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    Already have an account?
                    <a href="{{ route('login') }}" class="auth-link">Sign in here</a>
                </small>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="bi bi-check-circle me-2"></i>Registration Successful!
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-primary" style="font-size: 4rem;"></i>
                    </div>
                    <h5>Welcome to Admin Dashboard!</h5>
                    <p class="text-muted">Your account has been created successfully. You can now sign in with your
                        credentials.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="login.html" class="btn btn-primary">Go to Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @vite(['resources/js/custom/register.js'])
@endsection
