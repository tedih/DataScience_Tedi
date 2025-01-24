<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: linear-gradient(135deg, #74b9ff, #a29bfe, #fd79a8);
            background-size: 200% 200%;
            animation: gradientBG 6s ease infinite;
            color: #fff;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            text-align: center;
            width: 100%;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 48px; /* Increased font size slightly */
            color: #fff;
            margin-bottom: 20px;
        }

        .buttons {
            position: relative;
            width: 100%;
        }

        .logout-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c0392b;
        }

        .input-button, .reference-button, .control-panel-button, .view-reference-button {
            padding: 15px 30px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0; /* Adds spacing between buttons */
        }

        .input-button:hover, .reference-button:hover, .control-panel-button:hover, .view-reference-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Hello, {{ auth()->user()->name }}</h1>
        </div>

        <!-- Email button -->
        <div class="buttons">
            <a href="{{ route('send.email.view') }}">
                <button class="input-button">Email</button>
            </a>
        </div>

        <!-- Reference Letter button -->
        <div class="buttons">
            <a href="{{ route('reference_create') }}">
                <button class="reference-button">Add a new reference Letter</button>
            </a>
        </div>

        <!-- View Reference Letters button -->
        <div class="buttons">
            <a href="{{ route('user.reference_letters.index') }}">
                <button class="view-reference-button">View Reference Letters</button>
            </a>
        </div>

        <!-- User Profile button (replacing User Control Panel) -->
        <div class="buttons">
            <a href="{{ route('user.index') }}">
                <button class="control-panel-button">My Profile</button>
            </a>
        </div>

        <!-- Logout button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>
