<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Job</h2>
        <form action="{{ route('adminjobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $job->company_name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $job->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $job->address }}" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $job->category }}" required>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
                @if($job->picture)
                    <img src="{{ asset('storage/' . $job->picture) }}" alt="Current Job Picture" style="width: 100px; height: auto; margin-top: 10px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Job</button>
            <a href="{{ route('adminjobs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>