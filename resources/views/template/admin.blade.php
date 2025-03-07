<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ALMEA KAUSA ETERNA') }}</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css"
        href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link href="<?= asset('assets/css') ?>/select2.min.css" rel="stylesheet">
    <link href="<?= asset('assets/css') ?>/select2-bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= asset('assets/lib/deskapp-master/') ?>/vendors/styles/style.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <link href="<?= asset('assets/css') ?>/custom.css" rel="stylesheet">

</head>

<body>
    <!-- Pre Loader -->
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="d-flex">
                <div class="loader-logo mr-2">
                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/favicon-32x32.png"
                        alt="" />
                </div>
                <h1>CV ALMEA KAUSA ETERNA</h1>
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Memproses...</div>
        </div>
    </div>

    @include('template.partials.admin.navbar')

    <!-- Rightbar -->
    @include('template.partials.admin.rightbar')
    <!-- End of Rightbar -->

    <!-- Sidebar -->
    @include('template.partials.admin.sidebar')
    <!-- End of Sidebar -->

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div style="min-height: calc(100vh - 200px);">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('template.partials.admin.footer')
            <!-- End of Footer -->
        </div>
    </div>

    <!-- Logout Modal-->
    {{-- @include('template.partials.admin.modal_logout') --}}
    <button class="welcome-modal-btn d-none">
        <i class="fa fa-download"></i> Download
    </button>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/core.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/script.min.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/process.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/layout-settings.js"></script>
    {{-- <script src="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/apexcharts/apexcharts.min.js"></script> --}}
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/datatables/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/datatables/js/dataTables.responsive.min.js">
    </script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/src/plugins/datatables/js/responsive.bootstrap4.min.js">
    </script>
    {{-- <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/dashboard3.js"></script> --}}
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?= asset('assets/js') ?>/configuration.js"></script>
    @stack('js')
    @include('template.partials.flash_message')
</body>

</html>
