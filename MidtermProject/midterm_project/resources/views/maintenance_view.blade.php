@extends('layouts.master_maintenance')

@section('title', 'Maintenance Records for ' . $asset->name)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Maintenance Records for {{ $asset->name }}</h2>
    <a href="{{ route('madd', $asset->id) }}" class="btn btn-success mb-3">Add Maintenance Record</a>
</div>

@if (session('Success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">{{ session('Success') }}</div>
@endif

@if (count($records) > 0)
    <div class="table-responsive rounded" style="overflow: hidden;">
    <table class="table table-borderless">
        <thead class="table-warning">
            <tr>
                @if ($showCreatedAt ?? true)
                    <th>Created At</th>
                @endif
                <th>Maintenance Date</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    @if ($showCreatedAt ?? true)
                        <td>{{ \Carbon\Carbon::parse($record->created_at)->format('F j, Y') }}</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($record->maintenance_date)->format('F j, Y') }}</td>
                    <td>{{ $record->notes ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@else
    <p>No maintenance records found for this asset.</p>
@endif

<a href="{{ route('home') }}" class="btn btn-secondary">Back to Assets</a>

@endsection
