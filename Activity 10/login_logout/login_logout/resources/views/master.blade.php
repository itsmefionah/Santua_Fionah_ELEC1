<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body >
<div class="bg-primary text-white p-3 d-flex justify-content-between align-items-center">
    <span class="h5 mb-0">Activity 10</span>
    <form method="POST" action="{{ route('logout') }}" class="mb-0">
        @csrf
        <button type="submit" class="btn" style="background-color: #003366; color: white; border: none; padding: 0.5rem 1rem;  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            Logout
        </button>
    </form>
</div>
@yield('content')
</body>
</html>