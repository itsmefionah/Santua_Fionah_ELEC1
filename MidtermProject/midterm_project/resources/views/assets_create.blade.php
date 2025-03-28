@extends('layouts.master_assets')

@section('title', 'Create Asset')

@section('content')

<h2>Add New Asset</h2>

<form action="{{ route('store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="in_use">In Use</option>
            <option value="under_maintenance">Under Maintenance</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
