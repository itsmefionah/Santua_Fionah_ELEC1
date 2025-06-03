@extends('layouts.master_assets')

@section('title', 'Create Staff')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded border-0" style="width: 100%; max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" style="color: #013D83;">Add New Staff</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('staff.store') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Full Name</label>
                    <input type="text" name="name" class="form-control shadow-sm" placeholder="Enter full name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Email Address</label>
                    <input type="email" name="email" class="form-control shadow-sm" placeholder="Enter email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control shadow-sm" placeholder="Enter password" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn px-4 py-2" style="background: #0C53A5; color: white; font-weight: 600;">
                    Add Staff
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
