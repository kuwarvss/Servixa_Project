<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Super Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/superAdmin-dashboard.css') }}" rel="stylesheet">
</head>

<body>

    {{-- 🔥 TOP NAVBAR --}}
    @include('superadmin.partials.topbar')

    {{-- 🔥 PAGE CONTENT --}}
    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
            .forEach(el => new bootstrap.Tooltip(el));

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(e1 => e1.remove());
        }, 3000);
    </script>

    @stack('scripts')
</body>
</html>
