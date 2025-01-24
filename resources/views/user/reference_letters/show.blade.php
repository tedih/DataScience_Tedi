<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference Letter Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .reference-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .reference-card h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .reference-card p {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .btn-back {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="reference-card">
        <h3>Reference Letter from {{ $referenceLetter->sender_email }}</h3>
        <p><strong>Message:</strong> {{ $referenceLetter->message ?? 'No message provided.' }}</p>
        <p><strong>File:</strong> <a href="{{ Storage::url($referenceLetter->reference_letter_pdf) }}" target="_blank">{{ basename($referenceLetter->reference_letter_pdf) }}</a></p>

        <a href="{{ route('user.reference_letters.index') }}" class="btn-back">Back to Reference Letters</a>
    </div>
</div>

</body>
</html>

