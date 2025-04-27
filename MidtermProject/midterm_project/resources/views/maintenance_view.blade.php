@extends('layouts.master_maintenance')

@section('title', 'Maintenance Records for ' . $asset->name)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: #013D83;">Maintenance Records for {{ $asset->name }}</h2>
    <a href="{{ route('madd', $asset->id) }}" class="btn shadow-sm" style="background: #0C53A5; color: white; font-weight: 600;">Add Maintenance Record</a>
</div>

@if (session('Success'))
    <div class="alert alert-primary text-center" role="alert">
        {{ session('Success') }}
    </div>
@endif

@if (count($records) > 0)
    <div class="table-responsive rounded shadow-sm">
        <table class="table align-middle">
            <thead>
                <tr>
                    @if ($showCreatedAt ?? true)
                        <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Created At</th>
                    @endif
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Notes</th>
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Maintenance Date</th>
                    <th  style="background-color: #DBEAFE; color: #013D83;" class="fw-bold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        @if ($showCreatedAt ?? true)
                            <td>{{ \Carbon\Carbon::parse($record->created_at)->format('F j, Y') }}</td>
                        @endif
                        <td>{{ $record->notes ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->maintenance_date)->format('F j, Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('medit', ['id' => $asset->id, 'record_id' => $record->id]) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="{{ route('mdelete', ['id' => $asset->id, 'record_id' => $record->id]) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center p-4">
        <p class="text-muted">No maintenance records found for this asset.</p>
    </div>
@endif

<!-- <div class="mt-4">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary shadow-sm">Back to Assets</a>
</div> -->

@endsection
