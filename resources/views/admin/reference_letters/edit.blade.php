<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reference Letter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Reference Letter</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.reference_letters.update', $referenceLetter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="sender_email" class="form-label">Sender Email</label>
                <input type="email" name="sender_email" id="sender_email" class="form-control" value="{{ $referenceLetter->sender_email }}" required>
            </div>

            <div class="mb-3">
                <label for="receiver_email" class="form-label">Receiver Email</label>
                <input type="email" name="receiver_email" id="receiver_email" class="form-control" value="{{ $referenceLetter->receiver_email }}" required>
            </div>

            <!-- Change from textarea to file input for reference_letter -->
            <div class="mb-3">
                <label for="reference_letter" class="form-label">Reference Letter (PDF/Word)</label>
                <input type="file" name="reference_letter" id="reference_letter" class="form-control" accept=".pdf,.doc,.docx">
                @if($referenceLetter->reference_letter)
                    <small>Current File: <a href="{{ asset('storage/' . $referenceLetter->reference_letter) }}" target="_blank">{{ $referenceLetter->reference_letter }}</a></small>
                @endif
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control">{{ $referenceLetter->message }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">Update Reference Letter</button>
        </form>
    </div>
</body>
</html>
