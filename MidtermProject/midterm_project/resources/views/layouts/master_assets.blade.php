<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory/Asset Tracking System')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
</head>
<body>
    @php
        $in_use = DB::select("Select COUNT(*) as in_use from assets where status = 'in_use'");
        
        $under_maintenance = DB::select("Select COUNT(*) as under_maintenance from assets where status = 'under_maintenance'");
        
        $broken = DB::select("Select COUNT(*) as broken from assets where status = 'broken'");
    @endphp
    <nav class="navbar navbar-dark navbar-expand-lg" 
        style="background: linear-gradient(to right, #13459E, #287ECF);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Asset Me In</a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script>
        let inUse = parseInt("{{ $in_use[0]->in_use }}");
        let under_maintenance = parseInt("{{ $under_maintenance[0]->under_maintenance }}");
        let broken = parseInt("{{ $broken[0]->broken }}");
        const xValues = ["In Use", "Under Maintenance", "Broken"];
        const yValues = [inUse, under_maintenance, broken];
        const barColors = [
        "#1D4ED8",
        "#0F7552",
        "#EF4444"
        ];

        new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Asset Status",
                fontSize: 18,
                fontColor: "#0C53A5",
                fontStyle: "bold"
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 15,
                }
            }
        }
    });
    </script>
</body>
</html>