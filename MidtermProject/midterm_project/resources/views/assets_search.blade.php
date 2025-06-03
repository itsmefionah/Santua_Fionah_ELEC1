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
                    <th>Unique ID</th> 
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>In Charge</th>
                    <th>Status</th>
                    <th class=" d-flex justify-content-center">Maintenance Count</th>
                </tr>
            </thead>
            <tbody>
                @php $counter =  $uniqueID; @endphp
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->description }}</td>
                        <td>{{ $asset->location_name }}</td>
                        <td>{{ $asset->in_charge }}</td>
                        <td>{{ $asset->status }}</td>
                        <td class=" d-flex justify-content-center"> <a href="{{ route('mhistory', ['id' => $asset->id]) }}" class="btn btn-sm btn-outline-primary">Maintenance History</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
