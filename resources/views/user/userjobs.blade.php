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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">SiapKerja</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('dashboard') }}#hero">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('userjobs') }}#jobs">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('userjobs') }}#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('userjobs') }}#contact">Contact</a>
                    </li>
                    <li class="nav-item">
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

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                <i class="bi bi-gear-fill me-2"></i>
                                Working for your success
                            </div>

                            <h1 class="mb-4">
                                Temukan Karirmu<br>
                                Raih Suksesmu!<br>
                                <span class="accent-text">Buka Pintu Karirmu</span>
                            </h1>

                            <p class="mb-4 mb-md-5">
                                SiapKerja adalah platform inovatif yang dirancang untuk menjembatani pencari kerja dengan peluang karir terbaik. Kami memahami bahwa setiap individu memiliki potensi unik untuk berkembang dan meraih kesuksesan.
                            </p>

                            <div class="hero-buttons">
                                <a href="#jobs" class="btn btn-primary me-0 me-sm-2 mx-1">Get Started</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                            <img src="{{ asset('assets/img/vect-illus.png') }}" alt="Hero Image" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <div class="stat-content">
                                <h4>3x Top Platform JobsSeeker</h4>
                                <p class="mb-0">Vestibulum ante ipsum</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="stat-content">
                                <h4>6.5k Avaible Jobs</h4>
                                <p class="mb-0">Nullam quis ante</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div class="stat-content">
                                <h4>80k Insight</h4>
                                <p class="mb-0">Etiam sit amet orci</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Top Salary</h4>
                                <p class="mb-0">Vestibulum ante ipsum</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Hero Section -->

        <!-- Jobs Section -->
        <section id="jobs" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Available Jobs</h2>
                <p>Temukan karir terbaikmu dengan menjelajahi daftar pekerjaan di bawah ini:</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">
                    @forelse ($jobs as $job)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-card d-flex flex-column align-items-center text-center">
                                <div class="flex-shrink-0 mb-4">
                                    <img src="{{ asset('storage/' . $job->picture) }}" alt="{{ $job->title }}"
                                        style="height: 150px; width: 300px; object-fit: cover; border-radius: 5px;">
                                </div>
                                <div>
                                    <h3>{{ $job->company_name }}</h3>
                                    <p>{{ Str::limit($job->description, 100) }}</p>
                                    <a href="{{ route('userjobs1.show', $job->id) }}" class="read-more">View Details
                                        <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No jobs available.</p>
                    @endforelse
                </div><!-- End Service Card -->

            </div>

        </section><!-- /Services Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <span class="about-meta">MORE ABOUT US</span>
                        <h2 class="about-title">Website SiapKerja</h2>
                        <p class="about-description">SiapKerja adalah platform inovatif yang dirancang untuk menjembatani pencari kerja dengan peluang karir terbaik. Kami memahami bahwa setiap individu memiliki potensi unik untuk berkembang dan meraih kesuksesan. Oleh karena itu, kami hadir untuk membantu kamu menemukan pekerjaan impian yang sesuai dengan minat, keahlian, dan tujuanmu.

                            Melalui berbagai fitur unggulan, SiapKerja tidak hanya mempermudah proses pencarian kerja, tetapi juga memberikan solusi bagi perusahaan dalam menemukan talenta terbaik yang sesuai dengan kebutuhan mereka. Dengan dukungan teknologi terkini, kami berkomitmen untuk menciptakan pengalaman yang cepat, efektif, dan dapat diandalkan bagi semua pengguna.
                        </p>

                        <div class="row feature-list-wrapper">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Lorem ipsum dolor sit amet</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Consectetur adipiscing elit</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Sed do eiusmod tempor</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Incididunt ut labore et</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Dolore magna aliqua</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Ut enim ad minim veniam</li>
                                </ul>
                            </div>
                        </div>

                        <div class="info-wrapper">
                            <div class="row gy-4">
                                <div class="col-lg-5">
                                    <div class="profile d-flex align-items-center gap-3">
                                        <img src="{{ asset('assets/img/yog.jpg') }}" alt="CEO Profile"
                                            class="profile-image">
                                        <div>
                                            <h4 class="profile-name">Yoga Al-Jazuli</h4>
                                            <p class="profile-position">Ketum &amp; CEO</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="contact-info d-flex align-items-center gap-2">
                                        <i class="bi bi-telephone-fill"></i>
                                        <div>
                                            <p class="contact-label">Call us anytime</p>
                                            <p class="contact-number">+123 456-789</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-wrapper">
                            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                                <img src="assets/img/about-5.webp" alt="Business Meeting"
                                    class="img-fluid main-image rounded-4">
                                <img src="assets/img/about-2.webp" alt="Team Discussion"
                                    class="img-fluid small-image rounded-4">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Clients</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Workers</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Untuk pertanyaan atau informasi lebih lanjut, Anda dapat menghubungi kami pada kontak berikut :</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Contact Info</h3>
                            <p>Untuk pertanyaan atau informasi lebih lanjut, Anda dapat menghubungi kami pada kontak berikut :</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Our Location</h4>
                                    <p>A108 Ketintang</p>
                                    <p>Surabaya, NY 535022</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Phone Number</h4>
                                    <p>+1 5589 55488 55</p>
                                    <p>+1 6678 254445 41</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Email Address</h4>
                                    <p>info@example.com</p>
                                    <p>contact@example.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Get In Touch</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante
                                ipsum primis.</p>

                            <form action="forms/contact.php" method="post" class="php-email-form"
                                data-aos="fade-up" data-aos-delay="200">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Subject" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>

                                        <button type="submit" class="btn">Send Message</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

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

</body>

</html>
