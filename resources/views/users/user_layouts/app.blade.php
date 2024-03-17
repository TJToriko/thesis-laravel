<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('page_title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/Hillside_logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	{{-- toastr --}}
	<link rel="stylesheet" type="text/css" href="{{  asset('adminassets/plugins/toastr/toastr.css') }}">
	{{-- sweetalert2 --}}
	<link rel="stylesheet" type="text/css" href="{{  asset('adminassets/plugins/sweetalert2/sweetalert2.css') }}">

    {{-- leaflet cdn --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>

    <!-- =======================================================
    * Template Name: Green
    * Updated: May 30 2023 with Bootstrap v5.3.0
    * Template URL: https://bootstrapmade.com/green-free-one-page-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    </head>

    <body>

        <!-- ======= Top Bar ======= -->
        @include('users.user_layouts.topnav')
    
        <!-- ======= Header ======= -->
        @include('users.user_layouts.header')
        <!-- End Header -->
    
        <!-- ======= Hero Section ======= -->
        @yield('hero')
        <!-- End Hero -->
    
        <main id="main">

            @yield('content')
            
        </main>
    
        <!-- ======= Footer ======= -->
        @include('users.user_layouts.footer')
        <!-- End Footer -->
    
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
{{-- sweetalert2 --}}
<script src="{{ asset('adminassets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- toastr --}}
<script type="text/javascript" src="{{ asset('adminassets/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    
        <!-- Template Main JS File -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script>
            @if(Session::has('message'))
                var type="{{ Session::get('alert-type','info') }}"
                  switch(type){
                    case 'info':
                      toastr.info("{{ Session::get('message') }}");
                      break;
                    case 'success':
                      toastr.success("{{ Session::get('message') }}");
                      break;
                    case 'warning':
                      toastr.warning("{{ Session::get('message') }}");
                      break;
                    case 'error':
                      toastr.error("{{ Session::get('message') }}");
                      break;
                  }        
            @endif
        </script>
        
        <script>
            $(document).on("click", "#delete", function(e){
                e.preventDefault();
                var link = $(this).attr("href");
        
                Swal.fire({
                    title: "Are you sure you want to Delete this?",
                    text: "Once Deleted, It will be Permanently Deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Delete",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            });
        </script>
    </body>
  
</html>

<script>
        // Get the elements
    const toggleIcon01 = document.getElementById("toggle-icon-01");
    const toggleP01 = document.getElementById("toggle-p-01");
    
    // Add click event listener for the first element
    toggleIcon01.addEventListener("click", function () {
        if (toggleP01.style.display === "none") {
        toggleP01.style.display = "block";
        toggleIcon01.classList.remove("bx-plus");
        toggleIcon01.classList.add("bx-minus");
        } else {
        toggleP01.style.display = "none";
        toggleIcon01.classList.remove("bx-minus");
        toggleIcon01.classList.add("bx-plus");
        }
    });
    
    const toggleIcon02 = document.getElementById("toggle-icon-02");
    const toggleP02 = document.getElementById("toggle-p-02");
    
    toggleIcon02.addEventListener("click", function () {
        if (toggleP02.style.display === "none") {
        toggleP02.style.display = "block";
        toggleIcon02.classList.remove("bx-plus");
        toggleIcon02.classList.add("bx-minus");
        } else {
        toggleP02.style.display = "none";
        toggleIcon02.classList.remove("bx-minus");
        toggleIcon02.classList.add("bx-plus");
        }
    });
    
    const toggleIcon03 = document.getElementById("toggle-icon-03");
    const toggleP03 = document.getElementById("toggle-p-03");
    
    toggleIcon03.addEventListener("click", function () {
        if (toggleP03.style.display === "none") {
        toggleP03.style.display = "block";
        toggleIcon03.classList.remove("bx-plus");
        toggleIcon03.classList.add("bx-minus");
        } else {
        toggleP03.style.display = "none";
        toggleIcon03.classList.remove("bx-minus");
        toggleIcon03.classList.add("bx-plus");
        }
    });
    
    const toggleIcon04 = document.getElementById("toggle-icon-04");
    const toggleP04 = document.getElementById("toggle-p-04");
    
    toggleIcon04.addEventListener("click", function () {
        if (toggleP04.style.display === "none") {
        toggleP04.style.display = "block";
        toggleIcon04.classList.remove("bx-plus");
        toggleIcon04.classList.add("bx-minus");
        } else {
        toggleP04.style.display = "none";
        toggleIcon04.classList.remove("bx-minus");
        toggleIcon04.classList.add("bx-plus");
        }
    });
    
    const toggleIcon05 = document.getElementById("toggle-icon-05");
    const toggleP05 = document.getElementById("toggle-p-05");
    
    toggleIcon05.addEventListener("click", function () {
        if (toggleP05.style.display === "none") {
        toggleP05.style.display = "block";
        toggleIcon05.classList.remove("bx-plus");
        toggleIcon05.classList.add("bx-minus");
        } else {
        toggleP05.style.display = "none";
        toggleIcon05.classList.remove("bx-minus");
        toggleIcon05.classList.add("bx-plus");
        }
    });
    
    const toggleIcon06 = document.getElementById("toggle-icon-06");
    const toggleP06 = document.getElementById("toggle-p-06");
    
    toggleIcon06.addEventListener("click", function () {
        if (toggleP06.style.display === "none") {
        toggleP06.style.display = "block";
        toggleIcon06.classList.remove("bx-plus");
        toggleIcon06.classList.add("bx-minus");
        } else {
        toggleP06.style.display = "none";
        toggleIcon06.classList.remove("bx-minus");
        toggleIcon06.classList.add("bx-plus");
        }
    });
    
    const toggleIcon07 = document.getElementById("toggle-icon-07");
    const toggleP07 = document.getElementById("toggle-p-07");
    
    toggleIcon07.addEventListener("click", function () {
        if (toggleP07.style.display === "none") {
        toggleP07.style.display = "block";
        toggleIcon07.classList.remove("bx-plus");
        toggleIcon07.classList.add("bx-minus");
        } else {
        toggleP07.style.display = "none";
        toggleIcon07.classList.remove("bx-minus");
        toggleIcon07.classList.add("bx-plus");
        }
    });
    
    const toggleIcon08 = document.getElementById("toggle-icon-08");
    const toggleP08 = document.getElementById("toggle-p-08");
    
    toggleIcon08.addEventListener("click", function () {
        if (toggleP08.style.display === "none") {
        toggleP08.style.display = "block";
        toggleIcon08.classList.remove("bx-plus");
        toggleIcon08.classList.add("bx-minus");
        } else {
        toggleP08.style.display = "none";
        toggleIcon08.classList.remove("bx-minus");
        toggleIcon08.classList.add("bx-plus");
        }
    });
    
    const toggleIcon09 = document.getElementById("toggle-icon-09");
    const toggleP09 = document.getElementById("toggle-p-09");
    
    toggleIcon09.addEventListener("click", function () {
        if (toggleP09.style.display === "none") {
        toggleP09.style.display = "block";
        toggleIcon09.classList.remove("bx-plus");
        toggleIcon09.classList.add("bx-minus");
        } else {
        toggleP09.style.display = "none";
        toggleIcon09.classList.remove("bx-minus");
        toggleIcon09.classList.add("bx-plus");
        }
    });
    
    const toggleIcon10 = document.getElementById("toggle-icon-10");
    const toggleP10 = document.getElementById("toggle-p-10");
    
    toggleIcon10.addEventListener("click", function () {
        if (toggleP10.style.display === "none") {
        toggleP10.style.display = "block";
        toggleIcon10.classList.remove("bx-plus");
        toggleIcon10.classList.add("bx-minus");
        } else {
        toggleP10.style.display = "none";
        toggleIcon10.classList.remove("bx-minus");
        toggleIcon10.classList.add("bx-plus");
        }
    });
    
    const toggleIcon11 = document.getElementById("toggle-icon-11");
    const toggleP11 = document.getElementById("toggle-p-11");
    
    toggleIcon11.addEventListener("click", function () {
        if (toggleP11.style.display === "none") {
        toggleP11.style.display = "block";
        toggleIcon11.classList.remove("bx-plus");
        toggleIcon11.classList.add("bx-minus");
        } else {
        toggleP11.style.display = "none";
        toggleIcon11.classList.remove("bx-minus");
        toggleIcon11.classList.add("bx-plus");
        }
    });
    
    // Repeat the above code for policies 3 to 11
</script>