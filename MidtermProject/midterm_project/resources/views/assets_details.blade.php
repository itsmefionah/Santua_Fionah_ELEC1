@extends('layouts.master_assets')

@section('title', 'Asset List')

@section('content')

<div class="card shadow-lg p-4 border-0">
<h2 class="fw-bold" style="color: #013D83;">{{ $locationName }}</h2>

<div class="table-responsive rounded shadow-sm">
    <table class="table align-middle">
        <thead>
            <tr>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Created At</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Name</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Description</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Status</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">In Charge</th>
                <th style="background-color: #DBEAFE; color: #013D83;" class="text-center fw-bold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
            <tr>
                <td>{{ \Carbon\Carbon::parse($asset->created_at)->format('F j, Y') }}</td>
                <td>
                    {{ $asset->name }}
                    <span style="background-color:#00BAF5; color: white; display: inline-block; width: 25px; height: 25px; line-height: 25px; text-align: center; border-radius: 50%; margin-left: 10px; font-size: 14px;">
                        {{ $asset->asset_count }}
                    </span>
                </td>
                <td>{{ $asset->description }}</td>
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
                <td>{{ $asset->in_charge }}</td>
                <td class="text-center">
                    <a href="{{ route('assignedToPerson', ['name' => $asset->in_charge]) }}" class="btn btn-sm btn-primary" style="color: white; font-weight: 600;">See assigned asset</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
