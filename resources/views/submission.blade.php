<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Reference Letter</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }

        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-container input[type="file"] {
            padding: 8px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            background-color: #3498db;
            color: #fff;
            padding: 14px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #2980b9;
        }

        .alert {
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            color: white;
            text-align: center;
        }

        .alert.success {
            background-color: #2ecc71;
        }

        .alert.error {
            background-color: #e74c3c;
        }

        .form-container .input-group {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Submit Reference Letter</h1>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('submission.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Submitter Email (No default value, user must fill it in) -->
            <div class="input-group">
                <label for="submitter_email">Your Email</label>
                <input type="email" id="submitter_email" name="submitter_name" value="" required>
            </div>

            <!-- Student Email (Autofilled with logged-in user's email) -->
            <div class="input-group">
                <label for="student_email">Student's Email</label>
                <input type="email" id="student_email" name="student_name" value="{{ Auth::user()->email ?? '' }}" required>
            </div>

            <!-- Optional Message -->
            <div class="input-group">
                <label for="message">Message (Optional)</label>
                <textarea id="message" name="message" rows="4"></textarea>
            </div>

            <!-- Reference Letter Upload -->
            <div class="input-group">
                <label for="reference_letter">Upload Reference Letter (PDF only)</label>
                <input type="file" id="reference_letter" name="reference_letter" accept=".pdf" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
