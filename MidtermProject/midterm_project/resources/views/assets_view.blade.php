@extends('layouts.master_assets')

@section('title', 'Asset Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: #013D83;"> Welcome, {{ auth()->user()->name }}!</h2>
    <div>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('staff.create') }}"
                class="btn shadow-sm me-2"
                style="background: #0C53A5; color: white; font-weight: 600;">
                    Add Staff
                </a>
            @endif
        @endauth
        @auth
            @if(auth()->user()->role === 'staff')
            <a href="{{ route('create') }}" class="btn shadow-sm me-2" style="background: #0C53A5; color: white; font-weight: 600;">Add New Asset</a>
            @endif
        @endauth
        <a href="{{ route('search') }}" class="btn shadow-sm" style="background: #0C53A5; color: white; font-weight: 600;">Search</a>
    </div>
</div>

<div class="container">
    <!-- First Row: Asset Status Chart and Assets Table -->
    <div class="row mb-4">
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <h5 class="text-center mb-3" style="color: #013D83; font-weight: bold;">Asset Status Overview</h5>
                <canvas id="myChart" style="width:100%;max-width:700px; height: 300px;"></canvas>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card shadow-sm p-4">
                <h5 class="text-center mb-3" style="color: #013D83; font-weight: bold;">Maintenance Frequency</h5>
                <canvas id="maintenanceChart" style="width:100%;max-width:700px; height: 315px;"></canvas>
            </div>
        </div>
    </div>
    <div class="table-responsive rounded shadow-sm">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Staff</th>
                            <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Created At</th>
                            <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Time</th>
                            <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Asset Count</th>
                            <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold">Location</th>
                            <th style="background-color: #DBEAFE; color: #013D83;" class="fw-bold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assetsByLocation as $asset)
                            <tr>
                                <td>{{$asset->creator_name}}</td>
                                <td>{{ \Carbon\Carbon::parse($asset->latest_asset_created)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($asset->latest_asset_created)->format('g:i A') }}</td>
                                <td style="padding-left: 40px;">
                                    <span style="background-color: #00BAF5; color: white; display: inline-block; width: 30px; height: 30px; line-height: 30px; text-align: center; border-radius: 50%;">
                                        {{ $asset->asset_count }}
                                    </span>
                                </td>
                                <td>{{ $asset->location_name }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('details', ['location_id' => $asset->location_id ?? 0]) }}" class="btn btn-sm btn-primary"  style="color: white; font-weight: 600;">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mt-5 mb-4 d-flex justify-content-center">
                    <style>
                        .page-nav-link {
                            text-decoration: none;
                            font-weight: bold;
                            font-size: small;
                            padding: 6px 12px;
                            color: #013D83;
                            border-radius: 4px;
                        }

                        .page-nav-link.disabled {
                            pointer-events: none;
                            opacity: 0.5;
                        }

                        .page-number {
                            width: 30px;
                            height: 30px;
                            text-decoration: none;
                            border-radius: 4px;
                            border: 1px solid #dee2e6;
                            font-weight: 500;
                            font-size: small;
                            color: #013D83;
                        }

                        .page-number.text-primary {
                            background-color: #DBEAFE;
                        }
                    </style>

                    <nav class="d-flex align-items-center">
                        {{-- Previous Button --}}
                        <a href="{{ $assetsByLocation->previousPageUrl() }}"
                        class="page-nav-link me-3 {{ $assetsByLocation->onFirstPage() ? 'disabled' : '' }}">
                            Prev
                        </a>

                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $assetsByLocation->lastPage(); $i++)
                            <a href="{{ $assetsByLocation->url($i) }}"
                            class="page-number mx-1 d-flex align-items-center justify-content-center
                            {{ $assetsByLocation->currentPage() == $i ? 'text-primary fw-bold' : 'text-secondary bg-white' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        {{-- Next Button --}}
                        <a href="{{ $assetsByLocation->nextPageUrl() }}"
                        class="page-nav-link ms-3 {{ !$assetsByLocation->hasMorePages() ? 'disabled' : '' }}">
                            Next
                        </a>
                    </nav>
                </div>
            </div> 
</div>
@endsection