<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>E-Learning</title>
    <meta content="E-Learning" name="description">
    <meta content="E-Learning" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('web') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('web') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('web') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('web') }}/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Impact
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

    @include('template-web.navbar')

    @yield('content')

    <footer class="footer accent-background" id="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a class="logo d-flex align-items-center" href="index.html">
                        <span class="sitename">E-Learning</span>
                    </a>
                    <p>E-Learning adalah platform pembelajaran online yang memungkinkan siswa untuk mengakses materi
                        pembelajaran dan mengikuti ujian secara online.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>



            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Impact</strong> <span>SMP N 3 INUMAN</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->

            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a class="scroll-top d-flex align-items-center justify-content-center" href="#" id="scroll-top"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
    @include('sweetalert::alert')
    <!-- Vendor JS Files -->
    <script src="{{ asset('web') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('web') }}/assets/js/main.js"></script>

</body>

</html>
