@extends('layouts.master_assets')

@section('title', 'Search Asset')

@section('content')
    <form action="{{ route('search') }}" method="GET" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search assets..." class="form-control" />
    </form>

    <h4 class="fw-bold">Search Results</h4>

    @if ($assets->isEmpty())
        <p>No assets found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>In Charge</th>
                    <th>Status</th>
                    <th>Maintenance Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->description }}</td>
                        <td>{{ $asset->location_name }}</td>
                        <td>{{ $asset->in_charge }}</td>
                        <td>{{ $asset->status }}</td>
                        <td>{{ $asset->maintenance_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
