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
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Jobs</h5>
                            <p class="card-text">Lorem</p>
                            <a href="{{ url('superjobs') }}" class="btn btn-success">See Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Applicants</h5>
                            <p class="card-text">Lorem.</p>
                            <a href="{{ url('superapps') }}" class="btn btn-success">See Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        
                        <div class="card-body">
                            <h5 class="card-title">User</h5>
                            <p class="card-text">Lorem</p>
                            <a href="{{ url('superusers') }}" class="btn btn-success">See Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
