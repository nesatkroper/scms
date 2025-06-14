<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School MS - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex min-vh-100">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-primary text-white" style="width: 280px;">
            <h2 class="fs-4 fw-bold">School MS</h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 text-start">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column">
            <!-- Header -->
            <header class="bg-white shadow p-3">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0 text-dark">Dashboard</h1>
                    <div class="text-muted">
                        Welcome, {{ auth()->user()->name }}
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-grow-1 container-fluid p-4">
                <!-- Key Metrics -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Total Students</h5>
                                <p class="card-text display-6 text-primary">150</p>
                                <p class="text-muted small">+5% from last term</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Active Classes</h5>
                                <p class="card-text display-6 text-primary">23</p>
                                <p class="text-muted small">2 new classes this week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Attendance Alerts</h5>
                                <p class="card-text display-6 text-danger">5</p>
                                <p class="text-muted small">Students with low attendance</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Activities</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Added new student to Grade 10
                                <span class="text-muted small">2 hours ago</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Scheduled Math class for Room 101
                                <span class="text-muted small">Yesterday</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Updated attendance for Grade 9
                                <span class="text-muted small">2 days ago</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-dark text-white py-3">
                <div class="container-fluid text-center">
                    <p class="mb-0">© {{ date('Y') }} School Management System. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>