<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory/Asset Tracking System')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-success navbar-expand-lg fw-bold" style="background: linear-gradient(to right, #13459E, #287ECF);">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home', ['id' => $asset->id]) }}">Maintenance Record</a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
