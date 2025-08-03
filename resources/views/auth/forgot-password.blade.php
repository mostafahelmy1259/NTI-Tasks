<!-- resources/views/auth/forgot-password.blade.php -->
@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-question-circle display-1 text-primary"></i>
                        <h2 class="mt-3">Forgot Password?</h2>
                        <p class="text-muted">Enter your email to reset your password</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            
                        </div>
                    @endif

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

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Send Reset Link</button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Remember your password? 
                            <a href="" class="text-decoration-none">Back to login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
