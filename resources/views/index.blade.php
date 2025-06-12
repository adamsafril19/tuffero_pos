<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tuffero Patisserie</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Dancing+Script&display=swap" rel="stylesheet">
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('/css/styleslanding.css') }}" rel="stylesheet">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">
                    <img src="{{ asset('assets/logo.png') }}" alt="Tuffero Logo" height="50">
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#product">Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header>
            <div id="mastheadCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/background1.jpg') }}" class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/background2.jpg') }}" class="d-block w-100" alt="Banner 2">
                    </div>
                </div>
                <!-- Controls (panah kiri & kanan) -->
                <button class="carousel-control-prev" type="button" data-bs-target="#mastheadCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mastheadCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-white text-brown" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                Kelezatan yang Menyapa dari Malang ke Seluruh Nusantara
                </h2>
                <hr class="divider divider-brown" />
                <p class="lead text-brown-75 mb-5" style="font-family: 'Open Sans', sans-serif; font-size: 1.125rem;">
                <strong>Tuffero Patisserie</strong> adalah rumah bagi aneka kue kering yang dibuat dengan cinta dan bahan terbaik. 
                Dari Malang, kami mengantarkan cita rasa yang menghangatkan ke seluruh penjuru Indonesia.
                Dengan lebih dari <strong>2.000 pesanan setiap harinya</strong>, kami bangga menjadi bagian dari 
                momen spesial Anda — baik secara online maupun di toko <em>offline</em> kami.
                </p>
                <a class="btn btn-brown btn-xl text-white" href="#product">Lihat Produk Kami</a>
            </div>
            </div>
        </div>
        </section>
        <!-- Product-->
        <section class="page-section bg-white text-brown" id="product">
        <div class="container px-4 px-lg-5">
            <!-- Judul & Alasan Kenapa Harus Beli -->
            <h2 class="text-center fw-bold mb-5" style="color: #7B3F00; font-family: 'Playfair Display', serif;">
            Kenapa harus beli kue di <span style="font-family: 'Dancing Script', cursive; font-size: 2rem;">Tuffero </span>
            <span style="color: #a35e0f;">Patisserie</span> 
            </h2>

            <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="row g-4">
                <div class="col-md-6 d-flex">
                    <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>
                    <div>
                    <h5 class="fw-bold mb-1" style="color:#7B3F00;">Manual Homemade</h5>
                    <p class="mb-0">Semua kue dibuat secara manual untuk menjamin rasa dan kualitas terbaik.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>
                    <div>
                    <h5 class="fw-bold mb-1" style="color:#7B3F00;">Tanpa Pengawet</h5>
                    <p class="mb-0">Kue dibuat higienis dan bebas bahan kimia tambahan.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>
                    <div>
                    <h5 class="fw-bold mb-1" style="color:#7B3F00;">Fresh Dari Oven</h5>
                    <p class="mb-0">Pesanan dikirimkan langsung setelah dipanggang.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>
                    <div>
                    <h5 class="fw-bold mb-1" style="color:#7B3F00;">Bahan Premium</h5>
                    <p class="mb-0">Kami menggunakan bahan asli, bukan abal-abal.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>
                    <div>
                    <h5 class="fw-bold mb-1" style="color:#7B3F00;">Harga Terjangkau</h5>
                    <p class="mb-0">Nikmati kelezatan premium tanpa menguras kantong.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>
                    <div>
                    <h5 class="fw-bold mb-1" style="color:#7B3F00;">Aman & Rapi</h5>
                    <p class="mb-0">Dikemas dengan baik agar aman saat dikirim ke seluruh Indonesia.</p>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <!-- Katalog Produk -->
            <h3 class="text-center mb-4" style="color: #7B3F00; font-family: 'Playfair Display', serif;">Produk Unggulan</h3>
            <div class="row gx-4 gy-5 justify-content-center">
            <!-- Produk 1: Macaron Box -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                <img src="assets/macaron1.jpg" class="card-img-top" alt="Macaron Box">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #7B3F00;">Macaron Box</h5>
                    <p class="card-text text-muted">Mini french macaron isi 5 mix rasa perboxnya <br>
                         dibuat dari bahan berkualitas coklat asli, pewarna aman, dan less sugar. 
                         Dikemas higienis dengan kertas foodgrade dan bisa dikirim ke seluruh Indonesia.</p>
                </div>
                </div>
            </div>

            <!-- Produk 2: Nastar -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                <img src="assets/nastar3.jpg" class="card-img-top" alt="Nastar Tuffero">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #7B3F00;">Nastar Tuffero</h5>
                    <p class="card-text text-muted">Nastar premium dengan isian selai nanas homemade yang lembut dan manis seimbang. 
                        Dibuat dari bahan pilihan, menghasilkan tekstur lumer di mulut. 
                        Dikemas higienis cocok untuk hampers atau sajian spesial.</p>
                </div>
                </div>
            </div>

            <!-- Produk 3: Fudgy Brownies -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                <img src="assets/brownies1.jpg" class="card-img-top" alt="Fudgy Brownies">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #7B3F00;">Fudgy Brownies</h5>
                    <p class="card-text text-muted">Brownies coklat dengan tekstur fudgy yang padat dan moist. 
                        Terbuat dari coklat asli dan bahan premium, menghadirkan rasa rich dan intens. 
                        Cocok sebagai camilan mewah atau hadiah istimewa.</p>
                </div>
                </div>
            </div>
            </div>
        </section>
        <!-- Portfolio-->
        <section id="portfolio" class="bg-white py-5">
        <div class="container px-4 px-lg-5">
            <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Di Balik Layar Bersama Tuffero Patisserie</h2>
            <p class="text-muted">Cuplikan proses kami saat melakukan wawancara dan observasi langsung dengan tim Tuffero Patisserie.</p>
            </div>
            <div class="row g-4">

            <!-- Foto Member 1 -->
            <div class="col-lg-6 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                <img src="assets/fotomember2.jpg" class="card-img-top" alt="Member 1 Wawancara Tuffero">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Sesi Wawancara Bersama Pihak Tuffero Patisserie</h5>
                    <p class="card-text text-muted">Tim kami mendalami visi dan cerita bisnis dari Tuffero Patisserie secara langsung untuk memahami karakter brand yang ingin ditampilkan.</p>
                </div>
                </div>
            </div>

            <!-- Foto Member 2 -->
            <div class="col-lg-6 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                <img src="assets/fotomember1.jpg" class="card-img-top" alt="Member 2 Diskusi Tuffero">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Diskusi Konsep Branding</h5>
                    <p class="card-text text-muted">Melalui pendekatan langsung, tim merancang solusi branding yang sesuai dengan identitas Tuffero Patisserie.</p>
                </div>
                </div>
            </div>

            </div>
        </div>
        </section>
        <!-- Contact-->
        <!-- Section: Google Maps Embed -->
        <section id="contact" class="w-100">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.097022716584!2d112.5894629!3d-7.5589024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78731d0a54b27b%3A0x1bcfd3a88c186abe!2sVilla%20Bukit%20Sengkaling%2C%20Landungsari%2C%20Kec.%20Dau%2C%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1718180000000" 
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
        </section>

        <!-- Section: Footer Contact Info -->
        <footer class="bg-brown text-white pt-5 pb-4">
        <div class="container">
            <div class="row text-start gy-4">

            <!-- Col 1: Logo & Deskripsi -->
            <div class="col-md-3">
                <img src="assets/logo.png" alt="Tuffero Logo" style="height: 50px;">
                <p class="mt-3 small text-light-emphasis">
                Produsen kue berkualitas dari Malang, menghadirkan rasa premium dari bahan terbaik.
                </p>
                <div class="mt-3">
                <a href="https://instagram.com/tuffero.patisserie" class="text-light me-3 fs-5"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light fs-5"><i class="bi bi-facebook"></i></a>
                </div>
            </div>

            <!-- Col 2: Useful Links -->
            <div class="col-md-3">
                <h6 class="fw-semibold text-uppercase mb-3">Tautan Bermanfaat</h6>
                <ul class="list-unstyled small">
                <li class="mb-2"><a href="#about" class="text-light text-decoration-none">Tentang Kami</a></li>
                <li class="mb-2"><a href="#news" class="text-light text-decoration-none">Berita & Artikel</a></li>
                <li class="mb-2"><a href="#products" class="text-light text-decoration-none">Produk Kami</a></li>
                <li><a href="#policy" class="text-light text-decoration-none">Kebijakan</a></li>
                </ul>
            </div>

            <!-- Col 3: Support -->
            <div class="col-md-3">
                <h6 class="fw-semibold text-uppercase mb-3">Dukungan</h6>
                <ul class="list-unstyled small">
                <li class="mb-2"><a href="#contact" class="text-light text-decoration-none">Hubungi Kami</a></li>
                <li class="mb-2"><a href="#faq" class="text-light text-decoration-none">FAQ</a></li>
                <li><a href="#careers" class="text-light text-decoration-none">Karir</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact Info -->
            <div class="col-md-3">
                <h6 class="fw-semibold text-uppercase mb-3">Informasi Kontak</h6>
                <ul class="list-unstyled small text-light-emphasis">
                <li class="mb-2">
                    <i class="bi bi-geo-alt-fill me-2 text-gold"></i>
                    Villa Bukit Sengkaling AG 8, Landungsari, Malang
                </li>
                <li class="mb-2">
                    <i class="bi bi-telephone-fill me-2 text-gold"></i>
                    081-252-507-880
                </li>
                <li>
                    <i class="bi bi-envelope-fill me-2 text-gold"></i>
                    info@tuffero.com
                </li>
                </ul>
            </div>

            </div>
        </div>
        </footer>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2025 - Kelompok 1</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/script.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>