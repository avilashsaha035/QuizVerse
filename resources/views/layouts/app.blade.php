<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@stack('frontend_title') | {{ 'Quizverse' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

        <!-- header -->
        @include('frontend.partials.header')

        <!-- main content -->
        <div class="min-h-screen flex flex-col justify-center items-center">
            @yield('content')
        </div>

        <!-- footer -->
        @include('frontend.partials.footer')


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Mobile menu toggle -->
        <script>
            $(function() {
                $('#mobileMenuBtn').on('click', function() {
                    $('#mobileMenu').toggleClass('hidden');
                });
            });
        </script>

        <!-- CTA buttons visible/expand -->
        <script>
            $(function() {
                // Toggle dropdown on button click
                $('#userDropdownBtn').on('click', function(e) {
                    e.stopPropagation();
                    $('#userDropdownMenu').toggleClass('hidden');
                });

                // Close dropdown when clicking outside
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('#userDropdownBtn, #userDropdownMenu').length) {
                        $('#userDropdownMenu').addClass('hidden');
                    }
                });
            });
        </script>
    </body>
</html>
