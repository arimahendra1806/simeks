<!DOCTYPE html>

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
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Pelayanan</a></li>
                    <li><a href="#portfolio">Produk</a></li>
                    {{-- <li><a href="#team">Tim</a></li> --}}
                    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="#contact">Kontak Kami</a></li>
                    <li>
                        <div class="gtranslate_wrapper"></div>
                        <script>
                            window.gtranslateSettings = {
                                "default_language": "id",
                                "detect_browser_language": true,
                                "languages": ["id", "en"],
                                "wrapper_selector": ".gtranslate_wrapper"
                            }
                        </script>
                    </li>
                </ul>
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
                <h2 data-aos="fade-up" data-aos-delay="100">Jelajahi Dunia Rempah-Rempah Premium</h2>
                <p data-aos="fade-up" data-aos-delay="200">Menghubungkan Pasar Global dengan Rempah-Rempah Berkualitas
                    dari Indonesia</p>
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="#about" class="btn-get-started">Kenali Kami Lebih Dekat</a>
                    {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                        class="glightbox btn-watch-video d-flex align-items-center"><i
                            class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h3>Menyediakan Rempah-Rempah Berkualitas Dunia</h3>
                        <img src="{{ asset('assets') }}/image/about-2.jpg" class="img-fluid rounded-4 mb-4"
                            alt="">
                        <p>Kami menyediakan produk berkualitas tinggi dengan komitmen untuk memberikan pengalaman
                            terbaik. Meskipun kami menghadapi berbagai tantangan dalam industri ini, kami selalu
                            berusaha untuk memberikan layanan yang terbaik bagi setiap klien kami.</p>

                        <p>Kami memahami kebutuhan pasar dan berfokus pada penyediaan solusi yang efisien. Kami
                            memastikan setiap produk yang kami hasilkan memenuhi standar tertinggi, dengan menjaga
                            integritas dan kualitas.</p>

                        <p>Kami percaya pada inovasi dan komitmen untuk memperbaiki setiap proses kami, memberikan
                            nilai lebih kepada pelanggan dan menjaga hubungan yang berkelanjutan.</p>

                        <div class="position-relative mt-4 mb-4">
                            <img src="{{ asset('assets') }}/image/about-3.jpg" class="img-fluid rounded-4"
                                alt="">
                            {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                    class="glightbox pulsating-play-btn"></a> --}}
                        </div>
                        <p>
                            Kami menawarkan pengiriman yang dapat menjangkau seluruh dunia melalui ekspedisi kapal
                            laut, memastikan rempah-rempah premium kami sampai ke tujuan dengan aman dan tepat
                            waktu.
                        </p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                Kami hadir untuk memenuhi kebutuhan pasar global dengan menyediakan rempah-rempah
                                terbaik dari Indonesia.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Jahe Kering</strong> - Kaya
                                        akan kandungan minyak atsiri, jahe kering premium ini memiliki penampilan yang
                                        menarik dan terbentuk dengan baik tanpa lubang, memastikan kualitas terbaik
                                        untuk berbagai aplikasi.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Jahe Segar</strong> - Jahe
                                        segar dipanen dengan hati-hati pada tingkat kematangan penuh untuk memastikan
                                        kualitas terbaik dan tersedia dalam berbagai ukuran, mulai dari 80g hingga 250g,
                                        dapat disesuaikan untuk memenuhi spesifikasi pembeli, dengan pengolahan yang
                                        teliti untuk menjaga keunggulannya.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Kunyit Kering</strong> -
                                        Tersedia dalam berbagai tingkat curcumin untuk memenuhi berbagai kebutuhan,
                                        kunyit iris ini memiliki warna cerah dan dipotong secara manual untuk menjaga
                                        bentuk dan ketebalannya.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Jari Kunyit</strong> -
                                        Tersedia dalam spesifikasi polesan tunggal, polesan ganda, atau tanpa polesan,
                                        jari kunyit ini memerlukan waktu persiapan kurang dari satu bulan, memastikan
                                        efisiensi tanpa mengorbankan kualitas.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Lada Hitam</strong> - Sumber
                                        terbaik dari perkebunan di Bangka dan Lampung, diakui secara global sebagai lada
                                        terbaik di dunia, menawarkan kualitas tak tertandingi dan spesifikasi GL yang
                                        dapat disesuaikan mulai dari 500-600 untuk memenuhi kebutuhan pembeli yang
                                        beragam.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Lada Putih</strong> - Sumber
                                        terbaik dari perkebunan di Bangka dan Lampung, Lada Putih Muntok diakui secara
                                        global sebagai lada terbaik di dunia, menawarkan kualitas tak tertandingi dan
                                        spesifikasi GL yang dapat disesuaikan mulai dari 600-630 untuk memenuhi
                                        kebutuhan pembeli yang beragam.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Pinang</strong> - Pinang dari
                                        varietas Betara, yang berasal dari Jambi, dikenal karena kualitas superiornya
                                        dengan kandungan alkaloid dan tanin yang tinggi. Memiliki warna cerah yang
                                        mencolok dan melalui proses pengeringan dengan sinar matahari untuk memastikan
                                        kualitas optimal. Tersedia dalam bentuk utuh dan setengah belah, dapat disiapkan
                                        sesuai spesifikasi pembeli.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Kapulaga</strong> - Dikenal
                                        sebagai "Ratu Rempah", Kapulaga Jawa dari Indonesia memiliki warna yang menarik
                                        dari putih hingga keemasan dan kandungan kelembapan di bawah 10%, diproses
                                        dengan hati-hati untuk menjaga kualitas unggulnya.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Lengkuas</strong> - Diperoleh
                                        dari perkebunan dataran tinggi untuk kualitas luar biasa, lengkuas premium ini
                                        kaya akan galangin untuk rasa dan aroma yang kuat, dengan kandungan cineol
                                        tinggi yang menjadikannya ideal untuk penggunaan medis.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Kayu Manis</strong> - Ditanam
                                        di Kerinci, wilayah utama untuk produksi kayu manis, rempah premium ini tersedia
                                        dalam berbagai ukuran potongan dan dapat disesuaikan untuk memenuhi spesifikasi
                                        pembeli.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Pala</strong> - Dikenal
                                        sebagai Pala Siau dari Maluku, Indonesia adalah eksportir pala terbesar di
                                        dunia. Menawarkan kandungan minyak atsiri yang tinggi dan berbagai spesifikasi,
                                        termasuk grade ABC, cacat (SS), mace, patah, dan pala dengan kulit.</span></li>

                                <li><i class="bi bi-check-circle-fill"></i> <span><strong>Cengkeh</strong> - Dipetik
                                        dengan tangan dari cengkeh Lalpari terbaik, terklasifikasi AB6 untuk kualitas
                                        premium, memiliki kandungan minyak yang kaya, ukuran seragam, dan aroma yang
                                        kuat, menjadikannya ideal untuk berbagai aplikasi.</span></li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        {{-- <section id="stats" class="stats section light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="232"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Happy Clients</p>
                            </div>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="521"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Projects</p>
                            </div>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-headset color-green flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="1463"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Hours Of Support</p>
                            </div>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-people color-pink flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="15"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Hard Workers</p>
                            </div>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section> --}}
        <!-- /Stats Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Pelayanan</h2>
                <p>Ketahui Pelayanan Kami<br></p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('assets') }}/image/service-1.jpg" class="img-fluid service-img"
                                    alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="javascript:void(0)" class="stretched-link">
                                    <h3>Pengiriman Global</h3>
                                </a>
                                <p>Kami menawarkan pengiriman rempah-rempah terbaik ke seluruh dunia melalui ekspedisi
                                    laut yang aman dan tepat waktu, memastikan produk sampai dengan kualitas
                                    terbaik.</p>

                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('assets') }}/image/service-2.jpg" class="img-fluid service-img"
                                    alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-broadcast"></i>
                                </div>
                                <a href="javascript:void(0)" class="stretched-link">
                                    <h3>Kontrol Kualitas Ketat</h3>
                                </a>
                                <p>Setiap produk kami melalui proses seleksi dan pengujian yang ketat untuk memastikan
                                    hanya rempah-rempah berkualitas tinggi yang kami kirimkan kepada pelanggan.</p>

                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('assets') }}/image/service-3.jpg" class="img-fluid service-img"
                                    alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-easel"></i>
                                </div>
                                <a href="javascript:void(0)" class="stretched-link">
                                    <h3>Customisasi Pesanan</h3>
                                </a>
                                <p>Kami menyediakan layanan khusus untuk mempersiapkan produk rempah sesuai dengan
                                    spesifikasi dan kebutuhan Anda, dari ukuran hingga pengolahan khusus.</p>

                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section>
        <!-- /Services Section -->

        <!-- Clients Section -->
        {{-- <section id="clients" class="clients section light-background">

            <div class="container" data-aos="fade-up">

                <div class="row gy-4">

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/clients/client-1.png"
                            class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/clients/client-2.png"
                            class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/clients/client-3.png"
                            class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/clients/client-4.png"
                            class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/clients/client-5.png"
                            class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/clients/client-6.png"
                            class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                </div>

            </div>

        </section> --}}
        <!-- /Clients Section -->

        <!-- Features Section -->
        {{-- <section id="features" class="features section">

            <div class="container">

                <ul class="nav nav-tabs row  d-flex" data-aos="fade-up" data-aos-delay="100">
                    <li class="nav-item col-3">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                            <i class="bi bi-binoculars"></i>
                            <h4 class="d-none d-lg-block">Modi sit est dela pireda nest</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                            <i class="bi bi-box-seam"></i>
                            <h4 class="d-none d-lg-block">Unde praesenti mara setra le</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                            <i class="bi bi-brightness-high"></i>
                            <h4 class="d-none d-lg-block">Pariatur explica nitro dela</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                            <i class="bi bi-command"></i>
                            <h4 class="d-none d-lg-block">Nostrum qui dile node</h4>
                        </a>
                    </li>
                </ul><!-- End Tab Nav -->

                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                    <div class="tab-pane fade active show" id="features-tab-1">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i>
                                        <spab>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</spab>
                                    </li>
                                    <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit
                                            in voluptate velit</span>.</li>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                            trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                                </ul>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/working-1.jpg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End Tab Content Item -->

                    <div class="tab-pane fade" id="features-tab-2">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>Neque exercitationem debitis soluta quos debitis quo mollitia officia est</h3>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit
                                            in voluptate velit.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Provident mollitia neque rerum
                                            asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</span>
                                    </li>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                            trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/working-2.jpg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End Tab Content Item -->

                    <div class="tab-pane fade" id="features-tab-3">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>Voluptatibus commodi ut accusamus ea repudiandae ut autem dolor ut assumenda</h3>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit
                                            in voluptate velit.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Provident mollitia neque rerum
                                            asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</span>
                                    </li>
                                </ul>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/working-3.jpg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End Tab Content Item -->

                    <div class="tab-pane fade" id="features-tab-4">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>Omnis fugiat ea explicabo sunt dolorum asperiores sequi inventore rerum</h3>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit
                                            in voluptate velit.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                            trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/working-4.jpg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End Tab Content Item -->

                </div>

            </div>

        </section> --}}
        <!-- /Features Section -->

        <!-- Services 2 Section -->
        {{-- <section id="services-2" class="services-2 section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Services</h2>
                <p>CHECK OUR SERVICES</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-briefcase icon flex-shrink-0"></i>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Lorem Ipsum</a></h4>
                                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas
                                    molestias excepturi sint occaecati cupiditate non provident</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-card-checklist icon flex-shrink-0"></i>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Dolor Sitema</a></h4>
                                <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                    aliquip ex ea commodo consequat tarad limino ata</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-bar-chart icon flex-shrink-0"></i>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Sed ut perspiciatis</a>
                                </h4>
                                <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-binoculars icon flex-shrink-0"></i>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Magni Dolores</a></h4>
                                <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                    qui officia deserunt mollit anim id est laborum</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-brightness-high icon flex-shrink-0"></i>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Nemo Enim</a></h4>
                                <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                    blanditiis praesentium voluptatum deleniti atque</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-calendar4-week icon flex-shrink-0"></i>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Eiusmod Tempor</a></h4>
                                <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam
                                    libero tempore, cum soluta nobis est eligendi</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section> --}}
        <!-- /Services 2 Section -->

        <!-- Testimonials Section -->
        {{-- <section id="testimonials" class="testimonials section dark-background">

            <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/testimonials-bg.jpg" class="testimonials-bg"
                alt="">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/testimonials/testimonials-1.jpg"
                                    class="testimonial-img" alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum
                                        suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et.
                                        Maecen aliquam, risus at semper.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/testimonials/testimonials-2.jpg"
                                    class="testimonial-img" alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum
                                        quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat
                                        irure amet legam anim culpa.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/testimonials/testimonials-3.jpg"
                                    class="testimonial-img" alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla
                                        quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore
                                        quis sint minim.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/testimonials/testimonials-4.jpg"
                                    class="testimonial-img" alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                        fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore
                                        quem dolore labore illum veniam.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/testimonials/testimonials-5.jpg"
                                    class="testimonial-img" alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor
                                        noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam
                                        esse veniam culpa fore nisi cillum quid.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section> --}}
        <!-- /Testimonials Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Produk</h2>
                <p>KETAHUI PRODUK KAMI</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">Semua</li>
                        @foreach ($categories as $item)
                            <li data-filter=".filter-{{ $item->id }}">{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                    <!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        @foreach ($products as $item)
                            <div
                                class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $item->kategori_id }}">
                                <div class="portfolio-content h-100">
                                    <img src="{{ asset('assets/uploads/produk/') }}/{{ $item->produkByFoto->first()->file }}"
                                        class="img-fluid produk-img" alt="">
                                    <div class="portfolio-info">
                                        <h4>{{ $item->kategori->nama }}</h4>
                                        <p>{{ $item->nama }}</p>
                                        <!-- Menambahkan gambar-gambar tambahan untuk lightbox -->
                                        @foreach ($item->produkByFoto as $image)
                                            <div class="text-center ms-3">
                                                <a href="{{ asset('assets/uploads/produk/') }}/{{ $image->file }}"
                                                    title="{{ $item->deskripsi }}"
                                                    data-gallery="portfolio-{{ $item->id }}"
                                                    class="glightbox preview-link">
                                                    <i class="bi bi-zoom-in"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                        {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                                class="bi bi-link-45deg"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- End Portfolio Item -->
                        @endforeach

                    </div>
                    <!-- End Portfolio Container -->

                </div>

            </div>

        </section>
        <!-- /Portfolio Section -->

        <!-- Team Section -->
        {{-- <section id="team" class="team section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>CHECK OUR TEAM</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="pic"><img
                                    src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/team/team-1.jpg"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Walter White</h4>
                                <span>Chief Executive Officer</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="pic"><img
                                    src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/team/team-2.jpg"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Product Manager</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <div class="pic"><img
                                    src="{{ asset('assets/lib/Dewi-1.0.0/') }}/assets/img/team/team-3.jpg"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>William Anderson</h4>
                                <span>CTO</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section> --}}
        <!-- /Team Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Hubungi Kami</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-lg-12 ">
                        <div class="row gy-4">

                            <div class="col-lg-12">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p> Jl. Mutiara Citra Asri No.C1/23, RT.002/RW.011, Kerawean, Sumorame, Kec. Candi,
                                        Kabupaten Sidoarjo, Jawa Timur 61271</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Telepon Kami</h3>
                                    <p>+62851-9000-0236</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Kami</h3>
                                    <p>almeakausaeterna@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>
                    </div>

                    {{-- <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div> --}}
                    <!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

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

                <div class="col-lg-6 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#services">Pelayanan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#portfolio">Produk</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#contact">Kontak Kami</a></li>
                    </ul>
                </div>

                {{-- <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
                        <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                value="Subscribe"></div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div> --}}

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">ALMEA KAUSA ETERNA</strong> <span>All Rights
                    Reserved</span>
            </p>
            {{-- <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a
                    href=“https://themewagon.com>ThemeWagon
            </div> --}}
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

    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

</body>

</html>
