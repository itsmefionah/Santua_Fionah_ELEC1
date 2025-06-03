@extends('layouts.master_maintenance')

@section('title', 'My Encoded Maintenance Records')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: #013D83;">My Encoded Maintenance Records</h2>
</div>

@if(session('Success'))
    <div class="alert alert-success">
        {{ session('Success') }}
    </div>
@endif

@if(count($records) > 0)
    <table class="table table-bordered table-hover bg-white shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>Asset Name</th>
                <th>Maintenance Date</th>
                <th>Staff</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->asset_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->maintenance_date)->format('Y-m-d h:i A') }}</td>
                    <td>{{ $record->staff }}</td>
                    <td>
                        <span class="badge bg-{{ $record->status === 'serviceable' ? 'success' : 'danger' }}">
                            {{ ucfirst($record->status) }}
                        </span>
                    </td>
                    <td>{{ $record->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-info">No maintenance records found.</div>
@endif
@endsection
