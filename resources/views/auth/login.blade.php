<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://keystoneacademic-res.cloudinary.com/image/upload/element/63/63892_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.75);
            border-radius: 10px;
            padding: 30px;
            max-width: 400px;
            margin: 80px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2 class="text-center">Login</h2>
            
            {{-- Display any error messages --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="loginAsAdmin" name="login_as_admin">
                    <label for="loginAsAdmin" class="form-check-label">Login as Admin</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                {{-- Link to the register page --}}
                <div class="mt-3 text-center">
                    Don't have an account? <a href="{{ route('register') }}" class="text-info">Register here</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
