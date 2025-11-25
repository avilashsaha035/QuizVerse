<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ 'Quizverse' }} | @stack('title')</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="Eduport- LMS, Education and Course Theme">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/apexcharts/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css') }}">

    <!-- Font Awesome (latest) -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Theme CSS (includes Bootstrap 5.3.3) -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
</head>

<body>
    <main>
        <!-- Sidebar -->
        @include('backend.partials.sidebar')

        <div class="page-content">
            <!-- Navbar -->
            @include('backend.partials.navbar')

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Back to top -->
    <div class="back-top">
        <i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>

    <!-- jQuery (still useful for other plugins, but CKEditor doesn’t depend on it) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>window.$ = window.jQuery = jQuery;</script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- CKEditor 5 Classic build -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <!-- Vendors -->
    <script src="{{ asset('backend/assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('backend/assets/js/functions.js') }}"></script>

    <!-- Page-level scripts -->
    @stack('scripts')

</body>
</html>
