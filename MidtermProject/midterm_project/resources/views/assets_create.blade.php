@extends('layouts.master_assets')

@section('title', 'Create Asset')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" style="color: #013D83;">Add New Asset</h2>
        </div>

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Asset Name</label>
                    <input type="text" name="name" class="form-control shadow-sm" placeholder="Enter asset name" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Location</label>
                    <input type="text" name="location_name" class="form-control shadow-sm" placeholder="Enter asset location" value="{{ old('location_name') }}">
                    @error('location_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">In Charge</label>
                    <input type="text" name="in_charge" class="form-control shadow-sm" placeholder="Enter person in charge" value="{{ old('in_charge') }}">
                    @error('in_charge')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Status</label>
                    <select name="status" class="form-select shadow-sm">
                        <option value="">Select Status</option>
                        <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>✅ In Use</option>
                        <option value="under_maintenance" {{ old('status') == 'under_maintenance' ? 'selected' : '' }}>🔧 Under Maintenance</option>
                        <option value="broken" {{ old('status') == 'broken' ? 'selected' : '' }}>❌ Broken</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Description</label>
                    <textarea name="description" class="form-control shadow-sm" placeholder="Enter asset description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn px-4 py-2" style="background: #0C53A5; color: white; font-weight: 600;">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
