<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@stack('frontend_title') | {{ 'Quizverse' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Swiper CSS for Header Slider -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"> -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/swipper-silder.css') }}">

        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Livewire styles -->
        @livewireStyles

        <style>
            /* Vibrant Blue Gradient for Positive Energy */
            .gradient-bg {
                background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
            }

            .gradient-bg-green {
                background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
            }

            .hover-lift {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .hover-lift:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
            }

            .feature-card {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.08) 100%);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            /* Smooth dropdown transitions */
            .dropdown-enter {
                opacity: 0;
                transform: translateY(-10px);
            }

            .dropdown-enter-active {
                opacity: 1;
                transform: translateY(0);
                transition: opacity 0.2s ease, transform 0.2s ease;
            }

            /* Enhanced hover effects */
            .link-hover {
                position: relative;
                transition: all 0.3s ease;
            }

            .link-hover::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -4px;
                left: 0;
                background: linear-gradient(90deg, #3b82f6, #10b981);
                transition: width 0.3s ease;
            }

            .link-hover:hover::after {
                width: 100%;
            }

            /* Pulse animation for CTA */
            @keyframes pulse-glow {
                0%, 100% {
                    box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
                }
                50% {
                    box-shadow: 0 0 30px rgba(59, 130, 246, 0.8);
                }
            }

            .pulse-glow {
                animation: pulse-glow 2s infinite;
            }

            /* Subtle card hover */
            .card-hover {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.25);
                border-color: rgba(59, 130, 246, 0.2);
            }

            /* Header slider styles */
            .header-slider {
                width: 100%;
                height: 100%;
                border-radius: 1rem;
                overflow: hidden;
            }

            .swiper-slide-header {
                border-radius: 1rem;
                overflow: hidden;
                position: relative;
                height: 400px;
            }

            .slide-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to right, rgba(37, 99, 235, 0.9), rgba(37, 99, 235, 0.7));
                display: flex;
                align-items: center;
                padding: 2rem;
            }

            .slide-content {
                max-width: 60%;
                color: white;
            }

            .swiper-pagination-bullet {
                width: 12px !important;
                height: 12px !important;
                background: white !important;
                opacity: 0.5 !important;
            }

            .swiper-pagination-bullet-active {
                opacity: 1 !important;
                background: #10b981 !important;
            }

            /* Floating animation */
            @keyframes float {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-20px);
                }
            }

            .floating {
                animation: float 6s ease-in-out infinite;
            }

            /* Typewriter effect */
            @keyframes typing {
                from { width: 0 }
                to { width: 100% }
            }

            .typewriter {
                overflow: hidden;
                white-space: nowrap;
                animation: typing 3.5s steps(40, end);
            }

            /* Gradient text animation */
            @keyframes gradient-shift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .gradient-animate {
                background: linear-gradient(-45deg, #3b82f6, #10b981, #8b5cf6, #ef4444);
                background-size: 400% 400%;
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                animation: gradient-shift 8s ease infinite;
            }

            /* Scroll animations */
            .fade-in {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.8s ease, transform 0.8s ease;
            }

            .fade-in.visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* Modern card with glass effect */
            .glass-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }

            /* Statistics counter animation */
            .counter {
                font-feature-settings: "tnum";
                font-variant-numeric: tabular-nums;
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col">
            <!-- header -->
            @include('frontend.partials.header')

            <!-- main content -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- footer -->
            @include('frontend.partials.footer')
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Swiper JS for Header Slider -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
        <script src="{{ asset('assets/frontend/script/swiper-bundle.min.js') }}"></script>

        <!-- Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            // Configure toastr options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right", // top right corner
                "timeOut": "3000"
            }
        </script>

        <script>
            // Trigger toastr based on Laravel flash messages
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if(session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if(session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        </script>

        <script>
            $(document).ready(function() {

                // Mobile menu toggle
                $('#mobileMenuBtn').on('click', function() {
                    $('#mobileMenu').toggleClass('hidden');
                });

                // User dropdown toggle with animation
                $('#userDropdownBtn').on('click', function(e) {
                    e.stopPropagation();
                    const menu = $('#userDropdownMenu');
                    menu.toggleClass('hidden');

                    if (!menu.hasClass('hidden')) {
                        menu.removeClass('dropdown-enter')
                            .addClass('dropdown-enter-active');
                    }
                });

                // Close dropdown when clicking outside
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('#userDropdownBtn, #userDropdownMenu').length) {
                        $('#userDropdownMenu').addClass('hidden');
                    }
                });

                // Smooth scrolling for anchor links
                $('a[href^="#"]').on('click', function(e) {
                    if (this.hash !== '') {
                        e.preventDefault();
                        const hash = this.hash;

                        $('html, body').animate({
                            scrollTop: $(hash).offset().top - 100
                        }, 800);
                    }
                });

                // Add hover effect to dropdown items
                $('#userDropdownMenu a, #mobileMenu a').hover(
                    function() {
                        $(this).css({
                            'transform': 'translateX(5px)',
                            'transition': 'transform 0.2s ease'
                        });
                    },
                    function() {
                        $(this).css('transform', 'translateX(0)');
                    }
                );

                // Scroll animation
                function checkScroll() {
                    $('.fade-in').each(function() {
                        const elementTop = $(this).offset().top;
                        const elementBottom = elementTop + $(this).outerHeight();
                        const viewportTop = $(window).scrollTop();
                        const viewportBottom = viewportTop + $(window).height();

                        if (elementBottom > viewportTop && elementTop < viewportBottom) {
                            $(this).addClass('visible');
                        }
                    });
                }

                // Check scroll on load and scroll
                $(window).on('scroll load', checkScroll);

                // Initialize counters
                $('.counter').each(function() {
                    $(this).prop('Counter', 0).animate({
                        Counter: $(this).text()
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });

                // Initialize Swiper header slider (jQuery version)
                const swiper = new Swiper('.header-slider', {
                    direction: 'horizontal',
                    loop: true,

                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },

                    speed: 800,

                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },

                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true
                    },

                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                });

            });
        </script>

        <!-- Livewire scripts -->
        @livewireScripts

        @stack('frontend_scripts')
    </body>
</html>
