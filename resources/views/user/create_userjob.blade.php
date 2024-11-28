<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Application</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Submit Your Application</h2>

        <p><strong>Company Name:</strong> {{ $job->company_name }}</p>

        <form action="{{ route('userjobs.store', ['id' => $job->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
            </div>
            <div class="mb-3">
                <label for="cv" class="form-label">Upload CV</label>
                <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
                <div class="form-text">Only PDF files are allowed.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
