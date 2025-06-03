@extends('layouts.master_maintenance')

@section('title', 'Add Maintenance Record')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: #013D83;">Add Maintenance for {{ $asset->name }}</h2>
    <a href="{{ route('mindex', $asset->id) }}" class="btn btn-outline-secondary shadow-sm">Back to Records</a>
</div>

<form action="{{ route('mstore', $asset->id) }}" method="POST" class="shadow-sm p-4 rounded bg-light">
    @csrf

    <div class="mb-4">
        <label class="form-label fw-semibold">Maintenance Date</label>
        <input type="date" name="maintenance_date" class="form-control">
        @error('maintenance_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Maintenance Staff</label>
        <input name="staff" class="form-control" placeholder="Enter maintenance staff"></>
        @error('staff')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Notes</label>
        <textarea name="notes" class="form-control" placeholder="Enter maintenance details..."></textarea>
        @error('notes')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-control">
            <option value="serviceable" {{ old('status') == 'Serviceable' ? 'selected' : '' }}>Serviceable</option>
            <option value="unserviceable" {{ old('status') == 'Unserviceable' ? 'selected' : '' }}>Unserviceable</option>
        </select>
        @error('status')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn" style="background: #0C53A5; color: white; font-weight: 600;">Add Record</button>
</form>

@endsection
