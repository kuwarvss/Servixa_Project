<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to the Super Admin Dashboard</h1>
    <a href="{{ route('superadmin.create_admin') }}">Create Admin</a>
    <a href="{{ route('superadmin.manage_admin') }}">Manage Admins</a>
    <a href="{{ route('superadmin.logout') }}">Logout</a>
</body>
</html>