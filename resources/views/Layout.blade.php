<!DOCTYPE html>
<html lang="en">

<head>
    <title>مسعود خان</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ url('public/andrea/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/aos.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ url('public/andrea/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />


    <style>
        .english-alignment {
            text-align: left;
            direction: ltr;
        }

        .urdu-alignment {
            text-align: right;
            direction: rtl;
        }


        body {
            direction: rtl
        }

        @media only screen and (max-width: 768px) {
            body {
                direction: ltr
            }

        }

        /* Mobile styles */
        @media (max-width: 600px) {
            .mobile-class {
                padding-left: 20px;
                margin-left: 20px;
                padding-right: 10px;

            }
        }
    </style>
</head>

<body>

    <div class="modal" id="lightbox" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <img src="" id="lightboximg">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Check if the modal with ID "lightbox" exists
            if ($("#lightbox").length === 0) {
                // If not, create the modal
                $('body').append(`
                    <div class="modal fade" id="lightbox" tabindex="-1" role="dialog" aria-labelledby="lightboxLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lightboxLabel">Lightbox Modal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Modal body content -->
                                    This is the lightbox modal content.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            }
        });

        function openlightbox(image) {
            $('#lightbox').modal('show')
            $('#lightboximg').attr('src', image)
        }
    </script>


    <div id="colorlib-page">
        <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        <aside id="colorlib-aside" role="complementary" class="js-fullheight">
            <nav id="colorlib-main-menu" role="navigation">
                <ul>
                    <li class="{{ request()->is('/') ? 'colorlib-active' : '' }}"><a
                            href="{{ url('/') }}">Home</a></li>
                    <li class="{{ request()->is('about') ? 'colorlib-active' : '' }}"><a
                            href="{{ url('about') }}">About</a></li>
                    <li class="{{ request()->is('blog') ? 'colorlib-active' : '' }}"><a
                            href="{{ url('blog') }}">Blog</a></li>
                    <li class="{{ request()->is('contact') ? 'colorlib-active' : '' }}"><a
                            href="{{ url('contact') }}">Contact</a></li>
                    <li class="{{ request()->is('search') ? 'colorlib-active' : '' }}"><a
                            href="{{ url('http://localhost/urdublog/search?search=') }}">Search</a></li>
                </ul>
            </nav>

            <div class="colorlib-footer">
                <h1 id="colorlib-logo" class="mb-4"><a href="{{ url('/') }}"
                        style="padding-bottom: 44px; background-image: url({{ url('public/andrea/images/bg_1.jpg') }});">مسعود<span>خان</span></a>
                </h1>
                <div class="mb-5">
                    {{--  <h3>Subscribe for newsletter</h3>
                    <form action="#" class="colorlib-subscribe-form">
                        <div class="form-group d-flex">
                            <div class="icon"><span class="icon-paper-plane"></span></div>
                            <input type="text" class="form-control" placeholder="Enter Email Address">
                        </div>
                    </form> --}}
                </div>
                <p class="pfooter"></p>
            </div>
        </aside>
        <div id="colorlib-main" style="float: left">
            @yield('content')
        </div>
    </div>

    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>
    <script src="{{ url('public/andrea/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/popper.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ url('public/andrea/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/aos.js') }}"></script>
    <script src="{{ url('public/andrea/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ url('public/andrea/js/scrollax.min.js') }}"></script>
    <!--     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&amp;sensor=false">
    </script>
    <script src="{{ url('public/andrea/js/google-map.js') }}"></script> -->
    <script src="{{ url('public/andrea/js/main.js') }}"></script>


    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script> -->
    <!--    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
        integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
        data-cf-beacon='{"rayId":"7e2df44fbe7c1bcd","version":"2023.4.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}'
        crossorigin="anonymous"></script> -->
</body>

<!-- Mirrored from preview.colorlib.com/theme/andrea/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Jul 2023 06:16:14 GMT -->

</html>
