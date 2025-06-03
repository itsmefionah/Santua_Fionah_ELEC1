@extends('layouts.master_maintenance')

@section('title', 'Update Asset Maintenance')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: #013D83;">Update Maintenance Record</h2>
    <a href="{{ route('mindex', ['id' => $asset->id]) }}" class="btn btn-outline-secondary shadow-sm">Back to Maintenance List</a>
</div>

<form action="{{ route('mupdate', ['id' => $asset->id, 'record_id' => $record->id]) }}" method="POST" class="shadow-sm p-4 rounded bg-light">
    @csrf
    @method('POST')

    <div class="mb-4">
        <label class="form-label fw-semibold">Maintenance Date</label>
        <input type="date" name="maintenance_date" class="form-control" value="{{ old('maintenance_date', $record->maintenance_date) }}">
        @error('maintenance_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Maintenace Staff</label>
        <textarea name="staff" class="form-control" placeholder="Enter maintenance notes" rows="4">{{ old('staff', $record->staff) }}</textarea>
        @error('notes')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Notes</label>
        <textarea name="notes" class="form-control" placeholder="Enter maintenance notes" rows="4">{{ old('notes', $record->notes) }}</textarea>
        @error('notes')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

     <div class="mb-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-control" {{ old('status', $record->status) }}>
            <option value="serviceable" {{ old('status') == 'serviceable' ? 'selected' : '' }}>Serviceable</option>
            <option value="unserviceable" {{ old('status') == 'unserviceable' ? 'selected' : '' }}>Unserviceable</option>
        </select>
        @error('status')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    

    <div class="d-flex justify-content-end">
        <button type="submit"  class="btn" style="background: #0C53A5; color: white; font-weight: 600;">Update</button>
    </div>
</form>

@endsection
