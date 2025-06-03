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

        // Maintenance frequency data for the last 12 months
        $maintenance_stats = DB::select("
            SELECT 
                DATE_FORMAT(maintenance_date, '%Y-%m') as month,
                COUNT(*) as total_repairs,
                SUM(CASE WHEN status = 'serviceable' THEN 1 ELSE 0 END) as fixed_count,
                SUM(CASE WHEN status = 'unserviceable' THEN 1 ELSE 0 END) as unfixed_count
            FROM maintenance_records 
            WHERE maintenance_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            GROUP BY DATE_FORMAT(maintenance_date, '%Y-%m')
            ORDER BY month ASC
        ");

        // Prepare data for the chart
        $months = [];
        $total_repairs = [];
        $fixed_repairs = [];
        $unfixed_repairs = [];

        foreach($maintenance_stats as $stat) {
            $months[] = date('M Y', strtotime($stat->month . '-01'));
            $total_repairs[] = $stat->total_repairs;
            $fixed_repairs[] = $stat->fixed_count;
            $unfixed_repairs[] = $stat->unfixed_count;
        }
    @endphp
    <nav class="navbar navbar-dark navbar-expand-lg" 
        style="background: linear-gradient(to right, #13459E, #287ECF);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Asset Me In</a>
            <div class="d-flex align-items-center">
                <span id="clock" class="fs-5 fw-semibold text-light me-3"></span>

                @auth
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn shadow-sm" style="background: #0C53A5; color: white; font-weight: 600;">
                        Logout
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById("clock").textContent = now.toLocaleString();
        }
        setInterval(updateTime, 1000);
        updateTime(); 
    </script>


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
    
    <script>
        const maintenanceMonths = {!! json_encode($months) !!};
        const totalRepairs = {!! json_encode($total_repairs) !!};
        const fixedRepairs = {!! json_encode($fixed_repairs) !!};
        const unfixedRepairs = {!! json_encode($unfixed_repairs) !!};

        new Chart("maintenanceChart", {
            type: "bar",
            data: {
                labels: maintenanceMonths,
                datasets: [{
                    label: "Total Repairs",
                    data: totalRepairs,
                    borderColor: "#0C53A5",
                    backgroundColor: "rgba(12, 83, 165, 0.1)",
                    fill: true,
                    tension: 0.4
                }, {
                    label: "Fixed (Serviceable)",
                    data: fixedRepairs,
                    borderColor: "#10B981",
                    backgroundColor: "rgba(16, 185, 129, 0.1)",
                    fill: false,
                    tension: 0.4
                }, {
                    label: "Not Fixed (Unserviceable)",
                    data: unfixedRepairs,
                    borderColor: "#EF4444",
                    backgroundColor: "rgba(239, 68, 68, 0.1)",
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                // title: {
                //     display: true,
                //     text: "Maintenance Frequency - Last 12 Months",
                //     fontSize: 18,
                //     fontColor: "#0C53A5",
                //     fontStyle: "bold"
                // },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Repairs'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });
    </script>
</body>
</html>