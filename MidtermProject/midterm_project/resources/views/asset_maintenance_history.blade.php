@extends('layouts.master_maintenance')

@section('title', 'Maintenance History')

@section('content')
<h2>Maintenance History for {{ $asset->name }}</h2>

@if (empty($maintenanceRecords))
    <p>No Maintenance records for this asset.</p>
@else
<div class="table-responsive rounded" style="overflow: hidden;">
<table class="table table-borderless">
        <thead class="table-primary">
            <tr>
                <th>Dates</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maintenanceRecords as $record )
            <tr>
                <th>{{ $record->maintenance_date }}</th>
                <th>{{ $record->notes }}</th>
            </tr>       
            @endforeach
        </tbody>
    </table>
</div>
@endif
    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Assets</a>
@endsection