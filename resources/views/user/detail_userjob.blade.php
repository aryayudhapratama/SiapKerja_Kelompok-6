<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SiapKerja - PPL Kel 06</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Header -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">SiapKerja</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('userjobs.index') }}#hero">Dashboard</a>
                    </li>
                    <li><a href="{{ route('userjobs.index') }}#jobs" class="nav-link active">Jobs</a></li>
                    <li><a href="{{ route('userjobs.index') }}#about">About</a></li>
                    <li><a href="{{ route('userjobs.index') }}#contact">Contact</a></li>
                    <li>
                        <a class="nav-link" href="{{ url('history') }}">History</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="btn-getstarted nav-link" href="#" onclick="logout(event)">Logout</a>
            </a>
        </div>
    </header>
    <!-- End Header -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function logout(event) {
            event.preventDefault();

            // SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1bd602',
                cancelButtonColor: '#d12a00',
                confirmButtonText: 'Yes, log out!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit(); // Submit the logout form if confirmed
                }
            });
        }
    </script>

    <!-- Main Section -->
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <div class="card">
                    @if ($job->picture)
                        <img src="{{ asset('storage/' . $job->picture) }}" class="card-img-top"
                            alt="{{ $job->company_name }}" style="height: 500px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image"
                            style="height: 300px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title">{{ $job->company_name }}</h3>
                        <p class="card-text"><strong>Description:</strong> {{ $job->description }}</p>
                        <p class="card-text"><strong>Address:</strong> {{ $job->address }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $job->category }}</p>
                        <p class="card-text"><strong>Posted on:</strong> {{ $job->created_at->format('d M Y') }}</p>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('userjobs.index') }}" class="btn-getstarted mb-3"
                                style="transition: background-color 0.3s ease; padding: 10px 20px; text-decoration: none; background-color: #b2b2b2; color: white; border-radius: 20px;"
                                onmouseover="this.style.backgroundColor='#0056b3';"
                                onmouseout="this.style.backgroundColor=' #b2b2b2';">
                                Back to Jobs
                            </a>
                            <button id="apply-job-btn" class="btn btn-getstartedd mb-3" data-bs-toggle="modal"
                                data-bs-target="#applyModal-{{ $job->id }}">
                                Apply
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->
    </main>
    
    <!-- End Main Section -->

    <!-- Modal -->
    <div class="modal fade" id="applyModal-{{ $job->id }}" tabindex="-1" aria-labelledby="applyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Submit Your Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Apply -->
                    <form action="{{ route('userjobs.store', ['id' => $job->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="cv" class="form-label">Upload CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" accept=".pdf"
                                required>
                            <div class="form-text">Only PDF files are allowed.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">SiapKerja</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Ketintang</p>
                        <p>Surabaya, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Hic solutasetp</h4>
                    <ul>
                        <li><a href="#">Molestiae accusamus iure</a></li>
                        <li><a href="#">Excepturi dignissimos</a></li>
                        <li><a href="#">Suscipit distinctio</a></li>
                        <li><a href="#">Dilecta</a></li>
                        <li><a href="#">Sit quas consectetur</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nobis illum</h4>
                    <ul>
                        <li><a href="#">Ipsam</a></li>
                        <li><a href="#">Laudantium dolorum</a></li>
                        <li><a href="#">Dinera</a></li>
                        <li><a href="#">Trodelas</a></li>
                        <li><a href="#">Flexo</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SiapKerja-Kelompok6</strong> <span>All Rights
                    Reserved</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
