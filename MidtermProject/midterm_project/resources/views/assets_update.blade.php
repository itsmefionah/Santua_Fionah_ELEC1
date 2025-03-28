@extends('layouts.master_assets')

@section('title', 'Edit Asset')

@section('content')

<h2>Edit Asset</h2>

<form action="{{ route('update', $asset->id) }}" method="POST">
    @csrf
    @method('POST')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $asset->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" required>{{ $asset->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location_name" class="form-control" value="{{ $asset->location_name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="in_use" {{ $asset->status == 'in_use' ? 'selected' : '' }}>In Use</option>
            <option value="under_maintenance" {{ $asset->status == 'under_maintenance' ? 'selected' : '' }}>Under Maintenance</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>

@endsection
