<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://studyinturkey.com/wp-content/uploads/2021/06/kadir-has-university-3.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .container {
            max-width: 800px;
            margin-top: 100px;
        }

        .card {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            background-color: rgba(210, 180, 140, 0.8); /* Light brown */
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        .btn-lg {
            font-size: 18px;
            padding: 15px 30px;
            border-radius: 10px;
            width: 100%;
            margin: 10px 0;
        }

        .btn-light-brown {
            background-color: #d2b48c; /* Light brown */
            color: white;
            border: none;
        }

        .btn-light-brown:hover {
            background-color: #c0a573;
        }

        .btn-dark-brown {
            background-color: #8b4513; /* Dark brown */
            color: white;
            border: none;
        }

        .btn-dark-brown:hover {
            background-color: #6f3410;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Welcome, Admin {{ Auth::user()->name }}
        </div>

        <div class="card-body">
            <h4 class="mb-4">Admin Dashboard</h4>
            <p class="mb-4">Manage users, submissions, and reference letters efficiently.</p>

            <!-- Action buttons -->
            <div>
                <a href="{{ route('admin.users') }}" class="btn btn-light-brown btn-lg">
                    User Management
                </a>

                <a href="{{ route('admin.reference_letters.index') }}" class="btn btn-dark-brown btn-lg">
                    Reference Letters Management
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>


