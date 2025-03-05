<!DOCTYPE html>
<html lang="en">

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
    <!-- End Google Tag Manager -->

    <link href="<?= asset('assets/css') ?>/custom.css" rel="stylesheet">

</head>

<body class="login-page" style="height: 100vh !important">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="javascript:void(0)" class="text-dark">
                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/favicon-32x32.png"
                        class="mr-4" />
                    SISTEM INFORMASI MANAJEMEN EKSPOR
                </a>
            </div>
            <div class="login-menu d-none">
                <ul>
                    <li><a href="javascript:void(0)">Register</a></li>
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/core.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/script.min.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/process.js"></script>
    <script src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/scripts/layout-settings.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <script src="<?= asset('assets/js') ?>/configuration.js"></script>

    @stack('js')

</body>

</html>
