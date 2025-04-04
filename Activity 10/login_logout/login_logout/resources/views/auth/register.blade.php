@extends('master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="row g-0 shadow rounded overflow-hidden">
                <div class="col-md-5 bg-primary text-white d-flex flex-column justify-content-center p-4">
                    <h2 class="mb-3">Welcome!</h2>
                    <p>Create your account to get started.</p>
                </div>

                <div class="col-md-7 bg-white p-4">
                    <h4 class="mb-4">Register</h4>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Already registered? <a href="{{ route('login') }}">Log in</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
