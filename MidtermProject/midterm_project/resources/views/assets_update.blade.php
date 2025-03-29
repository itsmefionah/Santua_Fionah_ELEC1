@extends('layouts.master_assets')

@section('title', 'Edit Asset')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success">Edit Asset</h2>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary shadow-sm">Back to Asset List</a>
</div>

<form action="{{ route('update', $asset->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $asset->name) }}">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $asset->description) }}</textarea>
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location_name" class="form-control" value="{{ old('location_name', $asset->location_name) }}">
        @error('location_name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="">Select Status</option>
            <option value="in_use" {{ old('status', $asset->status) == 'in_use' ? 'selected' : '' }}>In Use</option>
            <option value="under_maintenance" {{ old('status', $asset->status) == 'under_maintenance' ? 'selected' : '' }}>Under Maintenance</option>
        </select>
        @error('status')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    
</form>

@endsection