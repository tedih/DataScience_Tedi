<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email or save draft</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 30px;
            width: 400px;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }

        label {
            font-weight: bold;
            color: #555555;
            display: block;
            margin-bottom: 5px;
        }

        input, select, textarea, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 0.9rem;
            display: none;
        }

        .success {
            background-color: #4CAF50;
            color: white;
        }

        .error {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Send email or save draft in db</h1>

        <!-- Display success or error message -->
        @if (session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('.message').style.display = 'none';
                }, 3000); // Hide after 3 seconds
            </script>
        @elseif(session('error'))
            <div class="message error">
                {{ session('error') }}
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('.message').style.display = 'none';
                }, 3000); // Hide after 3 seconds
            </script>
        @endif

        <form action="{{ route('input.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="sender_email">Sender Email</label>
            <input type="email" name="sender_email" id="sender_email" placeholder="Enter sender's email" value="{{ auth()->user()->email ?? '' }}" required>

            <label for="receiver_email">Receiver Email</label>
            <input type="email" name="receiver_email" id="receiver_email" placeholder="Enter receiver's email" required>

            <label for="reference_letter_pdf">Reference Letter (PDF)</label>
            <input type="file" name="reference_letter_pdf" id="reference_letter_pdf" accept=".pdf,.doc,.docx">

            <label for="message">Message (Optional)</label>
            <textarea name="message" id="message" rows="4" placeholder="Enter a message (optional)"></textarea>

            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="draft">Save as Draft</option>
                <option value="sent">Send Email</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
