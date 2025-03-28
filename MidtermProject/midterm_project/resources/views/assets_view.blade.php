@extends('layouts.master_assets')

@section('title', 'Asset List')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Asset List</h2>
    <a href="{{ route('create') }}" class="btn btn-success">Add New Asset</a>
</div>

@if (session('Success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">{{ session('Success') }}</div>
@endif

<form method="GET" action="{{ route('home') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search assets..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<div class="table-responsive rounded" style="overflow: hidden;">
<table class="table table-borderless">
    <thead class="table-dark">
        <tr>
            <th>Created At</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assets as $asset)
            <tr>
                <td>{{ \Carbon\Carbon::parse($asset->created_at)->format('F j, Y') }}</td>
                <td>{{ $asset->name }}</td>
                <td>{{ $asset->description }}</td>
                <td>{{ $asset->location_name }}</td>
                <td>{{ $asset->status }}</td>
                <td>
                    <a href="{{ route('edit', $asset->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @if ($asset->status == 'under_maintenance')
                        <a href="{{ route('mindex', ['id' => $asset->id]) }}" class="btn btn-info btn-sm">Maintenance</a>
                    @elseif($asset->status == 'in_use' && $asset->maintenance_count  > 0)
                        <a href="{{ route('history', ['id' => $asset->id]) }}" class="btn btn-primary btn-sm">Maintenance History</a>
                    @endif
                    <a href="{{ route('destroy', $asset->id) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<nav class="d-flex justify-content-center mt-3">
    <ul class="pagination p-2 rounded bg-white">
        @for ($i = 1; $i <= $assets->lastPage(); $i++)
            <li class="page-item {{ $assets->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link {{ $assets->currentPage() == $i ? 'bg-primary text-white' : 'bg-light text-dark' }}" 
                   href="{{ $assets->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    </ul>
</nav>


@endsection
