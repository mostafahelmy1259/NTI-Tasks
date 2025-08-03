<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle display-1 text-primary"></i>
                        <h2 class="mt-3">Welcome Back</h2>
                        <p class="text-muted">Sign in to your account</p>
                    </div>

                    <form method="POST" action="">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="" required autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback"></div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback"></div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        @if (Route::has('password.request'))
                            <a href="" class="text-decoration-none">Forgot your password?</a>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Don't have an account? 
                            <a href="" class="text-decoration-none">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection