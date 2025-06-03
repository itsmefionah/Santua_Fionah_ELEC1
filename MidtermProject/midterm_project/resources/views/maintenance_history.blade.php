@extends('layouts.master_maintenance')

@section('title', 'Maintenance Records')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: #013D83;">Maintenance History: {{ $asset->name }}</h2>
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
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Staff</th>
                    @if ($showCreatedAt ?? true)
                        <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Created At</th>
                    @endif
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Time</th>
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Maintenance Staff</th>
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Notes</th>
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Maintenance Date</th>
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Status</th>
                     </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                         <td>{{ $record->created_by_name }}</td>
                        @if ($showCreatedAt ?? true)
                            <td>{{ \Carbon\Carbon::parse($record->created_at)->format('F j, Y') }}</td>
                        @endif
                        <td>{{ \Carbon\Carbon::parse($record->created_at)->format('g:i A') }}</td>
                        <td>{{ $record->staff}}</td>
                        <td>{{ $record->notes}}</td>
                        <td>{{ \Carbon\Carbon::parse($record->maintenance_date)->format('F j, Y') }}</td>
                        <td>
                            <span class="badge {{ $record->status === 'serviceable' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($record->status) }}
                            </span>
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


@endsection
