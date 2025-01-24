<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reference Letters</title>
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

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .reference-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .reference-card h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .reference-card p {
            font-size: 14px;
            color: #666;
        }

        .reference-card a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .reference-card a:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #f1f1f1;
        }

        th {
            background-color: #f7f7f7;
            color: #4CAF50;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Your Reference Letters</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($referenceLetters as $referenceLetter)
        <div class="reference-card">
            <h3>Reference Letter from {{ $referenceLetter->sender_email }}</h3>
            <p><strong>Message:</strong> {{ $referenceLetter->message ?? 'No message provided.' }}</p>
            <p><strong>File:</strong> <a href="{{ Storage::url($referenceLetter->reference_letter_pdf) }}" target="_blank">{{ basename($referenceLetter->reference_letter_pdf) }}</a></p>

            <a href="{{ route('user.reference_letters.show', $referenceLetter->id) }}">View Details</a>
        </div>
    @endforeach
</div>

</body>
</html>
