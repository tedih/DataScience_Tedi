<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Reference Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333333;
            text-align: center;
        }

        label {
            font-size: 14px;
            color: #555555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"],
        textarea,
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 14px;
            color: #555555;
        }

        input[type="email"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        textarea {
            resize: none;
            height: 80px;
        }

        button {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            input[type="email"],
            textarea,
            input[type="file"],
            button {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Submit Reference Letter</h1>

        <!-- Reference letter submission form -->
        <form action="{{ route('reference_store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF token for form security -->

            <label for="sender_email">Your Email</label>
            <input type="email" id="sender_email" name="sender_email" required>

            <label for="receiver_email">Email of the person writting this letter</label>
            <input type="email" id="receiver_email" name="receiver_email" required>

            <label for="message">Message/ Some extra notes</label>
            <textarea id="message" name="message" placeholder="Write your message here..."></textarea>

            <label for="reference_letter_pdf">Upload Reference Letter (PDF/Word)</label>
            <input type="file" id="reference_letter_pdf" name="reference_letter_pdf" accept=".pdf,.doc,.docx" required>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
