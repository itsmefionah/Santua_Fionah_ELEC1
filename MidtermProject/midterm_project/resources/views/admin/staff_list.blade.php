<!DOCTYPE html>
<html>
<head>
    <title>Staff List</title>
</head>
<body>
    <h2>Staff Users</h2>

    <a href="/admin/staff/create">+ Add New Staff</a>

    <ul>
        @foreach ($staffUsers as $staff)
        <li>{{ $staff->name }} - {{ $staff->email }}</li>
        @endforeach
    </ul>
</body>
</html>
