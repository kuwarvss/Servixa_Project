<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-card">
    <div class="login-left">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h2>Welcome to Servixa platform</h2>
        <p>Create your account to get started.</p>
    </div>
    <div class="login-right">
        <h2>Signup</h2>

        <form method="POST" action="{{ route('signup') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" name="mobile" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Signup</button>

            <div class="text-center mt-3">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>
