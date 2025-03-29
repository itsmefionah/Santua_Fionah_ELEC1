@extends('layouts.master_maintenance')

@section('title', 'Update Asset Maintenance')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success">Update Maintenance Record</h2>
    <a href="{{ route('mindex', ['id' => $asset->id]) }}" class="btn btn-outline-secondary shadow-sm">Back to Maintenance List</a>
</div>

<form action="{{ route('mupdate', ['id' => $asset->id, 'record_id' => $record->id]) }}" method="POST" class="shadow-sm p-4 rounded bg-light">
    @csrf
    @method('POST')

    <div class="mb-4">
        <label class="form-label fw-semibold text-success">Maintenance Date</label>
        <input type="date" name="maintenance_date" class="form-control" value="{{ old('maintenance_date', $record->maintenance_date) }}">
        @error('maintenance_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold text-success">Maintenance Notes</label>
        <textarea name="notes" class="form-control" placeholder="Enter maintenance notes" rows="4">{{ old('notes', $record->notes) }}</textarea>
        @error('notes')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success px-4">Update</button>
    </div>
</form>

@endsection
