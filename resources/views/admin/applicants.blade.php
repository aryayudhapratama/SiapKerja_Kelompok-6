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

    <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">SiapKerja</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        {{-- <a class="nav-link active" href="">Dashboard</a> --}}
                        <a href="{{ route('admin.index') }}#hero" class="nav-link active">Dashboard</a>
                    </li>
                    <li>
                        {{-- <a href="#jobs">Jobs</a> --}}
                        <a href="{{ route('admin.index') }}#jobs" class="nav-link active">Jobs</a>
                    </li>
                    <li>
                        {{-- <a href="#about">About</a> --}}
                        <a href="{{ route('admin.index') }}#about" class="nav-link active">About</a>
                    </li>
                    <li>
                        {{-- <a href="#contact">Contact</a> --}}
                        <a href="{{ route('admin.index') }}#contact" class="nav-link active">Contact</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ url('adminjobs') }}">Add Jobs</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ url('applicants') }}">Applicants</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="btn-getstarted nav-link" href="{{ url('/') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </a>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container mt-5">
                <h2 class="mb-4">List of All Applicants</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="alert alert-info">Applicants List</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>CV</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applicants as $index => $applicant)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $applicant->name }}</td>
                                <td>{{ $applicant->email }}</td>
                                <td>{{ $applicant->company }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $applicant->cv) }}" target="_blank">Download CV</a>
                                </td>
                                <td>
                                    <span
                                        class="badge 
                                        @if ($applicant->status == 'pending') bg-warning 
                                        @elseif($applicant->status == 'accepted') bg-success 
                                        @else bg-danger @endif">
                                        {{ ucfirst($applicant->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $applicant->id }}"
                                        data-name="{{ $applicant->name }}" data-email="{{ $applicant->email }}"
                                        data-company="{{ $applicant->company }}"
                                        data-status="{{ $applicant->status }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $applicant->id }}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                    <form id="delete-form-{{ $applicant->id }}"
                                        action="{{ route('admin.applicant.destroy', $applicant->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No applicants found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section><!-- /Hero Section -->
        {{-- Edit --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Applicant Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="edit-id" name="id">
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Name:</label>
                                <input type="text" id="edit-name" name="name" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-email" class="form-label">Email:</label>
                                <input type="email" id="edit-email" name="email" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-company" class="form-label">Company:</label>
                                <input type="text" id="edit-company" name="company" class="form-control"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-status" class="form-label">Status:</label>
                                <select id="edit-status" name="status" class="form-select" required>
                                    <option value="pending">Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const applicantId = this.dataset.id;
                const actionUrl = `/applicants/${applicantId}`; // Sesuaikan endpoint dengan 'applicants'
                document.getElementById('editForm').action = actionUrl;
                document.getElementById('edit-id').value = this.dataset.id;
                document.getElementById('edit-name').value = this.dataset.name;
                document.getElementById('edit-email').value = this.dataset.email;
                document.getElementById('edit-company').value = this.dataset.company;
                document.getElementById('edit-status').value = this.dataset.status;

                const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id; // Mengambil ID dari atribut data-id
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(`delete-form-${id}`);
                        if (form) {
                            form.submit(); // Mengirimkan form delete
                        } else {
                            console.error(`Form with ID delete-form-${id} not found.`);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
