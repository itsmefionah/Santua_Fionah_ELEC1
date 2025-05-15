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
                    @if ($showCreatedAt ?? true)
                        <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Created At</th>
                    @endif
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Notes</th>
                    <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Maintenance Date</th>
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
