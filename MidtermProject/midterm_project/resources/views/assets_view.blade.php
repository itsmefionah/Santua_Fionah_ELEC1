@extends('layouts.master_assets')

@section('title', 'Asset List')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success">Asset List</h2>
    <a href="{{ route('create') }}" class="btn btn-success shadow-sm">Add New Asset</a>
</div>

@if (session('Success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('Success') }}
    </div>
@endif

<form method="GET" action="{{ route('home') }}" class="mb-4">
    <div class="input-group shadow-sm">
        <input type="text" name="search" class="form-control" placeholder="🔍 Search assets..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-success">Search</button>
    </div>
</form>

<div class="table-responsive rounded shadow-sm">
    <table class="table align-middle">
        <thead class="table-success text-white">
            <tr>
                <th>Created At</th>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($asset->created_at)->format('F j, Y') }}</td>
                    <td class="fw-semibold">{{ $asset->name }}</td>
                    <td>{{ $asset->description }}</td>
                    <td>{{ $asset->location_name }}</td>
                    <td>
                        <span class="badge bg-{{ $asset->status == 'under_maintenance' ? 'warning' : 'success' }}">
                            {{ ucfirst(str_replace('_', ' ', $asset->status)) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('edit', $asset->id) }}" class="btn btn-sm btn-outline-warning"> Edit</a>
                        @if ($asset->status == 'under_maintenance')
                            <a href="{{ route('mindex', ['id' => $asset->id]) }}" class="btn btn-sm btn-outline-info"> Maintenance</a>
                        @endif
                        <a href="{{ route('destroy', $asset->id) }}" class="btn btn-sm btn-outline-danger"> Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<nav class="d-flex justify-content-center mt-4">
    <ul class="pagination p-2 rounded bg-light shadow-sm">
        @for ($i = 1; $i <= $assets->lastPage(); $i++)
            <li class="page-item {{ $assets->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link {{ $assets->currentPage() == $i ? 'bg-success text-white' : 'bg-light text-dark' }}" 
                   href="{{ $assets->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    </ul>
</nav>

@endsection
