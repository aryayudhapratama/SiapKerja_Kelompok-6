<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            @if($job->picture)
                <img src="{{ asset('storage/' . $job->picture) }}" class="card-img-top" alt="{{ $job->company_name }}" style="height: 300px; object-fit: cover;">
            @else
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image" style="height: 300px; object-fit: cover;">
            @endif
    
            <div class="card-body">
                <h3 class="card-title">{{ $job->company_name }}</h3>
                <p class="card-text"><strong>Description:</strong> {{ $job->description }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $job->address }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $job->category }}</p>
                <p class="card-text"><strong>Posted on:</strong> {{ $job->created_at->format('d M Y') }}</p>
    
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Jobs</a>
            </div>
        </div>
    </div>
</body>

</html>