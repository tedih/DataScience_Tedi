<!-- resources/views/user/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .profile-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-card table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .profile-card th, .profile-card td {
            padding: 12px;
            border-bottom: 1px solid #f1f1f1;
            text-align: left;
        }

        .profile-card th {
            background-color: #f7f7f7;
            color: #4CAF50;
        }

        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to Your Profile</h1>
</header>

<div class="container">
    @php
        $user = Auth::user();
    @endphp

    @if($user)
        <div class="profile-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                </tbody>
            </table>

            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>

            <a href="{{ route('user.edit', $user->id) }}" class="button">Edit Profile</a>
        </div>
    @else
        <p>You are not logged in.</p>
    @endif
</div>

</body>
</html>
