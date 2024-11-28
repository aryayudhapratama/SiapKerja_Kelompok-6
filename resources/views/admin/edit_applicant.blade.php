<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Applicant Status</h2>
        <form action="{{ route('admin.applicant.update', $applicant->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{ $applicant->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="{{ $applicant->email }}" readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" @if($applicant->status == 'pending') selected @endif>Pending</option>
                    <option value="accepted" @if($applicant->status == 'accepted') selected @endif>Accepted</option>
                    <option value="rejected" @if($applicant->status == 'rejected') selected @endif>Rejected</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('applicants.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
