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
            
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
