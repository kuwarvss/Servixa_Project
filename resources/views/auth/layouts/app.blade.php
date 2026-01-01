<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="{{ asset('admin/css/admin-navbar.css') }}">
</head>
<body>

    @include('admin.partials.navbar')

    <div class="admin-content">
        @yield('content')
    </div>

    <script>
        document.getElementById('themeToggle')?.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme');
        });
    </script>
</body>
</html>
