@extends('layouts.superadmin')
@section('content')
    <!-- Content -->
    <div class="content mt-2">
        <div class="col-lg-10 mx-auto">
            @if(session('success'))
                <script>
                    setTimeout(() => {
                        alert("{{ session('success') }}");
                    });
                </script>
            @endif
            <div class="alert alert-success text-center fw-semibold">Welcome To Dashboard SuperAdmin</div>
            
            <!-- Row for cards -->
            <div class="row mt-4">
                <!-- Card for Jobs -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                            <span>List Jobs</span>
                            <a href="{{ url('superjobs') }}" class="btn btn-light btn-sm">Go To Page <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="custom-scroll">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-primary" style="position: sticky; top: 0; z-index: 1020;">
                                        <tr>
                                            <th style="text-align:center">ID Company</th>
                                            <th style="text-align:center">Company Name</th>
                                            <th style="text-align:center">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jobs as $job)
                                            <tr>
                                                <td style="text-align:center">{{ $job->id }}</td>
                                                <td style="text-align:center">{{ $job->title }}</td>
                                                <td style="text-align:center">{{ $job->category }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No jobs found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card for Applicants -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
                            <span>List Applicants</span>
                            <a href="{{ url('superapps') }}" class="btn btn-light btn-sm">Go To Page <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="custom-scroll">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-success" style="position: sticky; top: 0; z-index: 1020;">
                                        <tr>
                                            <th style="text-align:center">ID</th>
                                            <th style="text-align:center">Name</th>
                                            <th style="text-align:center">Company</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($applicants as $applicant)
                                            <tr>
                                                <td style="text-align:center">{{ $applicant->id }}</td>
                                                <td style="text-align:center">{{ $applicant->name }}</td>
                                                <td style="text-align:center">{{ $applicant->company }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No applicants found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card for Users -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white fw-bold d-flex justify-content-between align-items-center">
                            <span>List Users</span>
                            <a href="{{ url('superusers') }}" class="btn btn-light btn-sm">Go To Page <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="custom-scroll">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-warning" style="position: sticky; top: 0; z-index: 1020;">
                                        <tr>
                                            <th style="text-align:center">ID</th>
                                            <th style="text-align:center">Name</th>
                                            <th style="text-align:center">Roles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td style="text-align:center">{{ $user->id }}</td>
                                                <td style="text-align:center">{{ $user->name }}</td>
                                                <td style="text-align:center">{{ $user->role }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No users found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scroll {
            max-height: 270px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 5px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
