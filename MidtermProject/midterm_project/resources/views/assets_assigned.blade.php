@extends('layouts.master_assets')

@section('title', 'Asset List')

@section('content')

<div class="card shadow-lg p-4 border-0">
    <h2 class="fw-bold" style="color: #013D83;">Assets assigned to: {{ $person }}</h2>

    <table class="table align-middle table-responsive rounded shadow-sm">
        <thead class="table-success text-white">
            <tr>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Created At</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Name</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Description</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Location</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">In Charge</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Status</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="text-center fw-bold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
            <tr>
                <td>{{ \Carbon\Carbon::parse($asset->created_at)->format('F j, Y') }}</td>
                <td class="fw-semibold">{{ $asset->name }}</td>
                <td>{{ $asset->description }}</td>
                <td>{{ $asset->location_name }}</td>
                <td>{{ $asset->in_charge }}</td>
                <td>
                    @php
                        $statusColors = [
                            'in_use' => 'primary',
                            'under_maintenance' => 'success',
                            'broken' => 'danger',
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$asset->status] ?? 'secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $asset->status)) }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route('edit', $asset->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    @if ($asset->status=='in_use')
                     <a href="{{ route('mhistory', ['id' => $asset->id]) }}" class="btn btn-sm btn-outline-primary">Maintenance History</a>
                    @endif
                    @if ($asset->status == 'under_maintenance')
                        <a href="{{ route('mindex', ['id' => $asset->id]) }}" class="btn btn-sm btn-outline-success">Maintenance</a>
                    @endif
                    <a href="{{ route('destroy', $asset->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
