<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Reference Letter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Send Reference Letter Email</h2>
        
        <!-- Success or Error Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('send.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="sender_email" class="form-label">Sender's Email</label>
                <input type="email" class="form-control" id="sender_email" name="sender_email" required>
            </div>
            <div class="mb-3">
                <label for="receiver_email" class="form-label">Receiver's Email</label>
                <input type="email" class="form-control" id="receiver_email" name="receiver_email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Email</button>
        </form>
    </div>
</body>
</html>
