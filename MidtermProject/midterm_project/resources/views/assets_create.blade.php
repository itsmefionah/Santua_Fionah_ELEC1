@extends('layouts.master_assets')

@section('title', 'Create Asset')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success">Add New Asset</h2>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary shadow-sm">Back to Asset List</a>
</div>

<form action="{{ route('store') }}" method="POST" class="shadow-sm p-4 rounded bg-light">
    @csrf

    <div class="mb-4">
        <label class="form-label fw-semibold text-success">Asset Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter asset name" value="{{ old('name') }}">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold text-success">Description</label>
        <textarea name="description" class="form-control" placeholder="Enter asset description" rows="4">{{ old('description') }}</textarea>
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold text-success">Location</label>
        <input type="text" name="location_name" class="form-control" placeholder="Enter asset location" value="{{ old('location_name') }}">
        @error('location_name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold text-success">Status</label>
        <select name="status" class="form-select">
            <option value="">Select Status</option>
            <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>✅ In Use</option>
            <option value="under_maintenance" {{ old('status') == 'under_maintenance' ? 'selected' : '' }}>🔧 Under Maintenance</option>
        </select>
        @error('status')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success px-4">Submit</button>
    </div>
</form>

@endsection
