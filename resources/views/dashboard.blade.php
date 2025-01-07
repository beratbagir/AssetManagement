@extends('back.layouts.pages-layout')

@section('pageTitle', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center text-dark fw-bold">Dashboard</h2>
        <div class="row g-4">
            <!-- Summary Cards -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Total Assets</h5>
                        <h2 class="fw-bold text-primary">{{ $totalAssets }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Deployed</h5>
                        <h2 class="fw-bold text-success">{{$deployedCount}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Pending</h5>
                        <h2 class="fw-bold text-warning">{{$pendingCount}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Ready to Deploy</h5>
                        <h2 class="fw-bold text-info">{{$readytoDeployCount}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-dark fw-bold">Asset Status</div>
                    <div class="card-body">
                        <canvas id="assetStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Veri Tablosu -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Asset Data Table</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Asset Name</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Assigned To</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assets as $asset)
                                <tr>
                                    <td>{{ $asset->name }}</td>
                                    <td>{{ $asset->product->name }}</td>
                                    <td>{{ $asset->status }}</td>
                                    <td>{{ $asset->assigned_to }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Asset Status Chart
            const assetStatusCtx = document.getElementById('assetStatusChart').getContext('2d');
            new Chart(assetStatusCtx, {
                type: 'pie',
                data: {
                    labels: ['Deployed', 'Pending', 'Ready to Deploy'],
                    datasets: [{
                        data: [{{$deployedCount}}, {{$pendingCount}}, {{$readytoDeployCount}}],
                        backgroundColor: ['#28a745', '#ffc107', '#17a2b8']
                    }]
                }
            });

        </script>
@endsection
