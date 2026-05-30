<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart-Budget | Ezzati Catering</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="text-center">
        <!-- Logo -->
        <div class="mb-4">
            <x-application-logo class="w-25 h-25 text-secondary" />
        </div>

        <!-- Title -->
        <h1 class="fw-bold mb-2">Welcome to Smart-Budget</h1>
        <p class="text-muted mb-4">Efficient catering budget management for Ezzati Catering</p>

        <!-- Actions -->
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary px-4">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4">
                Register
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
