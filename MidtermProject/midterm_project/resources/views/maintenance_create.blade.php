@extends('layouts.master_maintenance')

@section('title', 'Add Maintenance Record')

@section('content')
<h2>Add Maintenance for {{ $asset->name }}</h2>

<form action="{{ route('mstore', $asset->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Maintenance Date</label>
        <input type="date" name="maintenance_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Add Record</button>
</form>
@endsection
