<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ALMEA KAUSA ETERNA</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('assets') }}/image/logo.png" rel="icon">
    <link href="{{ asset('assets') }}/image/logo.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet">
    <link href="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
    <style>
        .portfolio .portfolio-content .portfolio-info .preview-link,
        .portfolio .portfolio-content .portfolio-info .details-link {
            left: calc(50% - 15px) !important;
        }

        .produk-img {
            max-height: 250px !important;
            min-height: 250px !important;
            width: 100% !important;
        }

        .service-img {
            max-height: 300px !important;
            min-height: 300px !important;
            width: 100% !important;
        }
    </style>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="javascript:void(0)" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets') }}/image/logo.png" alt="">
                <h1 class="sitename ms-3">ALMEA KAUSA ETERNA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul></ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- <a class="cta-btn" href="index.html#about">Get Started</a> --}}

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="{{ asset('assets') }}/image/bg-home.jpg" alt="" data-aos="fade-in">

            <div class="container d-flex flex-column align-items-center">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-lg border-0">
                                <div class="card-body p-5">
                                    <h4 class="text-muted mb-3">
                                        Terima kasih telah melakukan pembayaran. <br>
                                        Berikut adalah detail transaksi
                                        Anda:
                                    </h4>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5
                                                class="text-muted mb-3 pb-2 border-bottom border-2 border-primary d-inline-block">
                                                <i class="bi bi-person me-2"></i> Informasi Pembeli
                                            </h5>
                                            <h5 class="text-muted mb-1"><strong>Nama:</strong>
                                                {{ $penjualan->pembeli->nama }}
                                            </h5>
                                            <h5 class="text-muted mb-1"><strong>Email:</strong>
                                                {{ $penjualan->pembeli->email }}
                                            </h5>
                                            <h5 class="text-muted mb-0"><strong>Telepon:</strong>
                                                {{ $penjualan->pembeli->telepon }}</h5>
                                        </div>
                                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                            <h5
                                                class="text-muted mb-3 pb-2 border-bottom border-2 border-primary d-inline-block">
                                                <i class="bi bi-receipt me-2"></i> Informasi Transaksi
                                            </h5>
                                            <h5 class="text-muted mb-1"><strong>Kode Transaksi:</strong>
                                                {{ $penjualan->kode_transaksi }}</h5>
                                            <h5 class="text-muted mb-1"><strong>Kode Pembayaran:</strong>
                                                {{ $bayar->kode_bayar }}</h5>
                                            <h5 class="text-muted mb-0"><strong>Tanggal Invoice:</strong>
                                                {{ date('d M Y H:i', strtotime($penjualan->created_at)) }}</h5>
                                        </div>
                                    </div>

                                    <h5
                                        class="text-muted mb-3 pb-2 border-bottom border-2 border-primary d-inline-block">
                                        <i class="bi bi-bag me-2"></i> Daftar Produk
                                    </h5>

                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Produk</th>
                                                    <th class="text-end">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $item)
                                                    <tr>
                                                        <td>
                                                            {{ $item->kuantitas }}x {{ $item->produk->nama }} (Rp
                                                            {{ format_currency($item->harga) }})
                                                        </td>
                                                        <td class="text-end">Rp
                                                            {{ format_currency($item->total) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-4">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between text-success fs-4">
                                                <strong>Total Terbayar
                                                    ({{ $bayar->statusKategori->isi }}):</strong>
                                                <span>Rp
                                                    {{ format_currency($bayar->nominal) }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between fs-4">
                                                <strong>Sisa Pembayaran :</strong>
                                                <span>Rp
                                                    {{ format_currency($penjualan->sisa_pembayaran) }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="d-grid gap-2 mt-5">
                                        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Halaman
                                            Utama</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">ALMEA KAUSA ETERNA</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Mutiara Citra Asri No.C1/23</p>
                        <p>Kerawean, Sumorame, Kec. Candi, Kabupaten Sidoarjo, Jawa Timur 61271</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>0851-9000-0236</span></p>
                        <p><strong>Email:</strong> <span>almeakausaeterna@gmail.com</span></p>
                    </div>

                    <div class="social-links d-flex mt-4">
                        <a href="https://wa.me/6285190000236" target="_blank"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.facebook.com/share/VuQmnJV3m4wr2rTN/?mibextid=LQQJ4d" target="_blank"><i
                                class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/almeakausaeterna?igsh=cm51aWgxOTN0NWl0" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/cv-almea-kausa-eterna/" target="_blank"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">ALMEA KAUSA ETERNA</strong> <span>All Rights
                    Reserved</span>
            </p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/js/main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
