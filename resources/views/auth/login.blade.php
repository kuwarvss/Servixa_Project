<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyProject</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for smooth animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        
        
    </style>
</head>
<body>

    <div class="login-card animate__animated animate__fadeIn">
        <!-- Left Section -->
        <div class="login-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h2>Servixa</h2>
            <p>Welcome back! Please login to your account.</p>
        </div>

        <!-- Right Section -->
        <div class="login-right">
            <h3 class="mb-4">Login</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </form>

            <p class="text-center mt-3">
                Don't have an account? <a href="{{ route('signup') }}">Sign Up</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
