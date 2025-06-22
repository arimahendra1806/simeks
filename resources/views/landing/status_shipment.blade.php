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

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/styles/icon-font.min.css" />

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
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5
                                                class="text-muted mb-3 pb-2 border-bottom border-2 border-primary d-inline-block">
                                                <i class="bi bi-person me-2"></i> Informasi Pembeli
                                            </h5>
                                            <h5 class="text-muted mb-1"><strong>Kode Transaksi:</strong>
                                                {{ $penjualan->kode_transaksi }}</h5>
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
                                                <i class="bi bi-receipt me-2"></i> Informasi Pengiriman
                                            </h5>
                                            <h5 class="text-muted mb-0"><strong>Status Saat Ini:</strong> <br>
                                                {{ $pengiriman->statusPengiriman->isi }}</h5><br>
                                            <h5 class="text-muted mb-1"><strong>Keterangan:</strong> <br>
                                                {{ $pengiriman->keterangan }}</h5><br>
                                        </div>
                                        <div class="col-md-6 text-md-start mt-3 mt-md-0">
                                            <h5
                                                class="text-muted mb-3 pb-2 border-bottom border-2 border-primary d-inline-block">
                                                <i class="bi bi-receipt me-2"></i> Alamat Awal
                                            </h5>
                                            <h5 class="text-muted mb-1">
                                                {{ $pengiriman->alamat_mulai ?? '-' }}
                                            </h5>
                                        </div>
                                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                            <h5
                                                class="text-muted mb-3 pb-2 border-bottom border-2 border-primary d-inline-block">
                                                <i class="bi bi-receipt me-2"></i> Alamat Tujuan
                                            </h5>
                                            <h5 class="text-muted mb-1">
                                                {{ $pengiriman->alamat_selesai ?? '-' }}
                                            </h5>
                                        </div>
                                        <div class="col-md-12 text-md-end mt-3 mt-md-0">
                                            <?php
                                            $is_alamat = $pengiriman->alamat_mulai && $pengiriman->alamat_selesai ? true : false;
                                            ?>
                                            <a href="{{ $is_alamat ? 'https://www.google.com/maps/dir/?api=1&origin=' . urlencode($pengiriman->alamat_mulai) . '&destination=' . urlencode($pengiriman->alamat_selesai) : 'javascript:void(0)' }}"
                                                {{ $is_alamat ? 'target="_blank"' : '' }}
                                                class="btn btn-dark btn-sm mt-1">
                                                <i class="fa fa-map me-2"></i> Cek Lokasi Pengiriman
                                            </a>
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
                                                    <th class="text-start">Satuan</th>
                                                    <th class="text-end">QTY</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $item)
                                                    <tr>
                                                        <td>
                                                            {{ $item->produk->nama }}
                                                        </td>
                                                        <td class="text-start">
                                                            {{ $item->satuan->nama }}</td>
                                                        <td class="text-end">
                                                            {{ $item->kuantitas }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    @if ($pengiriman->status_pengiriman > 7)
                                        <textarea class="form-control @error('keterangan_kirim') is-invalid @enderror"
                                            placeholder="Masukkan keterangan pengiriman..." id="keterangan_kirim" name="keterangan_kirim" cols="1"
                                            rows="5" required @if ($pengiriman->status_pengiriman == 9) disabled @endif>{{ old('keterangan_kirim', $pengiriman->keterangan_kirim) }}</textarea>
                                        @error('keterangan_kirim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif

                                    @if ($pengiriman->status_pengiriman != 9)
                                        <div class="d-grid gap-2 mt-2">
                                            <a href="javascript:void(0)" class="btn btn-success btn-lg"
                                                id="btn-status">
                                                <i class="fa fa-check me-2">
                                                    @php
                                                        $next_status = $pengiriman->status_pengiriman + 1;
                                                        $status = App\Models\Pilihan::where('parameter', $next_status)
                                                            ->where('nama', 'status_pengiriman')
                                                            ->first();

                                                        echo $status->isi;
                                                    @endphp
                                                </i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="d-grid gap-2 mt-2">
                                            <a href="{{ url('/') }}" class="btn btn-primary">
                                                <i class="fa fa-home me-2"></i>
                                                Kembali ke Halaman Utama
                                            </a>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-12 text-md-end mt-3 mt-md-0">
                                            <?php
                                            $is_alamat = $pengiriman->alamat_mulai && $pengiriman->alamat_selesai ? true : false;
                                            ?>
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary btn-sm mt-1 btn_lokasi">
                                                <i class="fa fa-map me-2"></i> Perbarui kondisi dan lokasi Anda
                                                Sekarang
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="btn btn-danger btn-sm mt-1 btn_darurat">
                                                <i class="fa fa-warning me-2"></i> Darurat? Beri tahu ke Admin
                                                Sekarang
                                            </a>
                                        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="modal_darurat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DARURAT SEGERA LAPORKAN ADMIN</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($pengiriman->status_pengiriman != 9)
                            <div class="col-md-12">
                                <p class="text-muted">Jika Anda mengalami masalah atau situasi darurat terkait
                                    pengiriman,
                                    silakan laporkan kepada admin kami dengan mengisi form di bawah ini. Admin akan
                                    segera
                                    menghubungi Anda via WhatsApp.</p>
                                <form id="form_darurat" action="{{ route('pengiriman_darurat') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="pengiriman_id" value="{{ $pengiriman->id }}">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Pesan Darurat</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4"
                                            placeholder="Deskripsikan masalah atau situasi darurat Anda" required></textarea>
                                    </div>
                                    <button type="button" class="btn btn-danger btn_save_darurat"
                                        onclick="confirm_darurat()">
                                        <i class="fa fa-send me-2"></i>
                                        Kirim Laporan Darurat</button>
                                </form>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <p class="text-muted mb-0">Riwayat laporan darurat:</p>
                                @if ($laporan->isEmpty())
                                    <p class="text-muted"><small>Belum ada laporan darurat yang dibuat.</small></p>
                                @else
                                    <ul style="max-height: 300px; overflow-y: auto;">
                                        @foreach ($laporan as $item)
                                            <li>
                                                <strong>{{ $item->created_at->format('d M Y H:i') }}</strong><br>
                                                {{ $item->keterangan }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        @if ($pengiriman->status_pengiriman != 9)
                            @if (!$laporan->isEmpty())
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <p class="text-muted mb-0">Atau Anda dapat menghubungi admin kami melalui
                                            WhatsApp
                                            dengan menekan tombol di bawah ini:</p>
                                        @if ($pengiriman->adminPengiriman->phone == null)
                                            <p class="text-danger">Admin belum mengisi nomor WhatsApp, silakan hubungi
                                                admin melalui nomor telepon perusahaan.</p>
                                            <a href="https://wa.me/6285190000236" target="_blank"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-whatsapp me-2"></i> Hubungi Perusahaan via WhatsApp
                                            </a>
                                        @else
                                            <a href="https://wa.me/{{ $pengiriman->adminPengiriman->phone }}"
                                                target="_blank" class="btn btn-success btn-sm">
                                                <i class="fa fa-whatsapp me-2"></i> Hubungi Admin via WhatsApp
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_lokasi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERBARUI KONDISI DAN LOKASI ANDA</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($pengiriman->status_pengiriman != 9)
                            <div class="col-md-12">
                                <p class="text-muted">
                                    Jika Anda ingin memperbarui kondisi dan lokasi Anda saat ini, silakan isi form di
                                    bawah ini. Admin akan segera menerima informasi terbaru Anda.
                                </p>
                                <form id="form_lokasi" action="{{ route('pengiriman_lokasi') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="pengiriman_id" value="{{ $pengiriman->id }}">
                                    <input type="hidden" name="lat">
                                    <input type="hidden" name="lng">
                                    <div class="mb-3">
                                        <label for="keterangan_lokasi" class="form-label">Pesan Kondisi Saat
                                            Ini</label>
                                        <textarea class="form-control" id="keterangan_lokasi" name="keterangan_lokasi" rows="4"
                                            placeholder="Deskripsikan kondisi Anda saat ini" required></textarea>
                                    </div>
                                    <button type="button" class="btn btn-danger btn_save_lokasi"
                                        onclick="confirm_lokasi()">
                                        <i class="fa fa-send me-2"></i>
                                        Kirim Perbaruan</button>
                                </form>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <p class="text-muted mb-0">Riwayat pembaruan:</p>
                                @if ($lokasi->isEmpty())
                                    <p class="text-muted"><small>Belum ada perbaruan kondisi.</small></p>
                                @else
                                    <ul style="max-height: 300px; overflow-y: auto;">
                                        @foreach ($lokasi as $item)
                                            <li>
                                                <strong>{{ $item->created_at->format('d M Y H:i') }}</strong><br>
                                                {{ $item->keterangan }} <br>
                                                <a href="{{ $item->lat && $item->lng ? 'https://www.google.com/maps/dir/?api=1&origin=' . urlencode($item->lat . ',' . $item->lng) . '&destination=' . urlencode($pengiriman->alamat_selesai) : 'javascript:void(0)' }}"
                                                    {{ $item->lat && $item->lng ? 'target="_blank"' : '' }}
                                                    class="btn btn-dark btn-sm mt-1">
                                                    <i class="fa fa-map me-2"></i> Cek Lokasi
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

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

    @if (env('MIDTRANS_IS_PRODUCTION'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
        </script>
    @endif

    <script>
        let status = {{ $pengiriman->status_pengiriman }};

        $('#btn-status').click(function(e) {
            e.preventDefault();

            if (status > 7) {
                if ($('#keterangan_kirim').val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Keterangan pengiriman tidak boleh kosong!',
                    });
                    return;
                }
            }

            Swal.fire({
                title: 'Anda yakin ingin mengupdate status pengiriman?',
                text: "Pastikan data yang anda inputkan benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('status_shipment_update') }}",
                        method: "POST",
                        data: {
                            id: "{{ $pengiriman->id }}",
                            status: "{{ $pengiriman->status_pengiriman + 1 }}",
                            keterangan_kirim: $('#keterangan_kirim').val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            })
        });

        $('.btn_darurat').click(function(e) {
            e.preventDefault();
            $('#modal_darurat').modal('show');
        })

        $('.btn_lokasi').click(function(e) {
            e.preventDefault();
            $('#modal_lokasi').modal('show');
        })

        function confirm_darurat() {
            if ($('#keterangan').val().trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pesan darurat tidak boleh kosong!',
                });
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pesan akan dikirim ke admin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_darurat').submit();
                }
            });
        }

        function confirm_lokasi() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    $('[name="lat"]').val(lat);
                    $('[name="lng"]').val(lng);
                    console.log("Lokasi disimpan:", lat, lng);

                    // var mapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                    // window.open(mapsUrl, '_blank');

                }, function(error) {
                    console.error("Gagal ambil lokasi:", error.message);
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                console.warn("Browser tidak mendukung Geolocation.");
            }

            if ($('#keterangan_lokasi').val().trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pesan perbaruai kondisi dan lokasi tidak boleh kosong!',
                });
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pesan akan dikirim ke admin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    setTimeout(function() {
                        $('#form_lokasi').submit();
                    }, 1000);
                }
            });
        }
    </script>

</body>

</html>
