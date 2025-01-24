<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference Letters</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3>Reference Letters</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sender Email</th>
                    <th>Receiver Email</th>
                    <th>Reference Letter</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referenceLetters as $referenceLetter)
                    <tr>
                        <td>{{ $referenceLetter->id }}</td>
                        <td>{{ $referenceLetter->sender_email }}</td>
                        <td>{{ $referenceLetter->receiver_email }}</td>
                        <td>{{ Str::limit($referenceLetter->reference_letter, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.reference_letters.edit', $referenceLetter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.reference_letters.destroy', $referenceLetter->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

