<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? 'Auth' }} | Rajawali Rent</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/animate.css">

    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/aos.css">

    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/jquery.timepicker.css">


    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/icomoon.css">
    <link rel="stylesheet" href="{{ asset('carbook-master') }}/css/style.css">
    <style>
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .whatsapp-button a img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .whatsapp-button a img:hover {
            transform: scale(1.1);
        }
    </style>
    @stack('css')

</head>

<body>

    <!-- Nav -->
    @include('layouts.frontend.navbar')
    <!-- End Nav -->

    <!-- Header -->
    <!-- End Header -->

    <!-- Content -->
    @yield('content')
    <!-- End Content -->

    <!-- Footer -->
    @include('layouts.frontend.footer')
    <!-- End Footer -->

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>
    <!-- End loader -->

    <!-- WhatsApp Button -->
    <div class="whatsapp-button">
        <a href="https://wa.me/1234567890?text=Hello!%20I%20need%20more%20information." target="_blank">
            <img src="{{ asset('carbook-master') }}/images/Logo-Whastapp.png" alt="WhatsApp Button" />
        </a>
    </div>



    @stack('scripts')

    <script src="{{ asset('carbook-master') }}/js/jquery.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/popper.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery.easing.1.3.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery.stellar.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/aos.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery.animateNumber.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('carbook-master') }}/js/jquery.timepicker.min.js"></script>
    <script src="{{ asset('carbook-master') }}/js/scrollax.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
    <!-- <script src="{{ asset('carbook-master') }}/js/google-map.js"></script> -->
    <script src="{{ asset('carbook-master') }}/js/main.js"></script>

</body>

</html>