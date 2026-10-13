<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | BaiSmile Dental Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">BaiSmile Dental Clinic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mainNavigation"><div class="navbar-nav ms-auto">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">Patients</a>
                <a class="nav-link {{ request()->routeIs('dentists.*') ? 'active' : '' }}" href="{{ route('dentists.index') }}">Dentists</a>
                <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">Appointments</a>
                <a class="nav-link {{ request()->routeIs('treatments.*') ? 'active' : '' }}" href="{{ route('treatments.index') }}">Treatments</a>
                <a class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">Payments</a>
            </div></div>
        </div>
    </nav>
    <main class="container py-4 py-lg-5">
        @if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>@endif
        @if(session('error'))<div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>@endif
        @yield('content')
    </main>
    <footer class="bg-dark text-light pt-5 pb-4 mt-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold text-warning mb-4">BaiSmile Dental Clinic</h5>
                    <p>Supporting healthier smiles with thoughtful dental care and organized patient services.</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Clinic</h5>
                    <p><a href="{{ route('patients.index') }}" class="text-reset text-decoration-none">Patients</a></p>
                    <p><a href="{{ route('dentists.index') }}" class="text-reset text-decoration-none">Our Dentists</a></p>
                    <p><a href="{{ route('appointments.index') }}" class="text-reset text-decoration-none">Appointments</a></p>
                    <p><a href="{{ route('treatments.index') }}" class="text-reset text-decoration-none">Treatments</a></p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Quick Links</h5>
                    <p><a href="{{ route('dashboard') }}" class="text-reset text-decoration-none">Dashboard</a></p>
                    <p><a href="{{ route('appointments.create') }}" class="text-reset text-decoration-none">Schedule a Visit</a></p>
                    <p><a href="{{ route('payments.index') }}" class="text-reset text-decoration-none">Payments</a></p>
                    <p><a href="{{ route('patients.create') }}" class="text-reset text-decoration-none">Add a Patient</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Contact</h5>
                    <p><i class="bi bi-house-door-fill me-3 text-secondary"></i>BaiSmile Dental Clinic</p>
                    <p><i class="bi bi-envelope-fill me-3 text-secondary"></i>Contact the clinic front desk</p>
                    <p><i class="bi bi-telephone-fill me-3 text-secondary"></i>For appointments and inquiries</p>
                </div>
            </div>
        </div>

        <div class="text-center p-3 border-top border-secondary">
            <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <span class="text-secondary small">© {{ now()->year }} BaiSmile Dental Clinic. All rights reserved.</span>
                <div class="mt-2 mt-sm-0">
                    <a href="{{ route('dashboard') }}" class="text-reset me-4">Dashboard</a>
                    <a href="{{ route('appointments.index') }}" class="text-reset me-4">Appointments</a>
                    <a href="{{ route('payments.index') }}" class="text-reset">Payments</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
