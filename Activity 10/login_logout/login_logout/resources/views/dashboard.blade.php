@extends('master')
@section('content')
<div class="py-5 container">
    <div class="card shadow-sm rounded-lg">
        <div class="card-header text-center bg-primary text-white p-3" style="font-size: 32px; font-weight: 600;">
            User Information
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="w-50">{{ $user->name }}</td>
                            <td class="w-50">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
