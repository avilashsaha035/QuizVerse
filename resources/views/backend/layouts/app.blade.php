<!DOCTYPE html>
<html lang="en">
<head>
	<title>Eduport- LMS, Education and Course Theme</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Eduport- LMS, Education and Course Theme">

	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')

		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})

			}
		})

	</script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/apexcharts/css/apexcharts.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css') }}">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">

</head>

<body>
    <main>
        <!-- Sidebar START -->
        <nav class="navbar sidebar navbar-expand-xl navbar-dark bg-dark">

            <!-- Navbar brand for xl START -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="index.html">
                    <img class="navbar-brand-item" src="{{ asset('backend/assets/images/logo-light.svg') }}" alt="">
                </a>
            </div>
            <!-- Navbar brand for xl END -->

            <div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1" id="offcanvasSidebar">
                <div class="offcanvas-body sidebar-content d-flex flex-column bg-dark">

                    <!-- Sidebar menu START -->
                    <ul class="navbar-nav flex-column" id="navbar-sidebar">

                        <!-- Menu item 1 -->
                        <li class="nav-item"><a href="admin-dashboard.html" class="nav-link active"><i class="bi bi-house fa-fw me-2"></i>Dashboard</a></li>

                        <!-- Title -->
                        <li class="nav-item ms-2 my-2">Pages</li>

                        <!-- menu item 2 -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapsepage" role="button" aria-expanded="false" aria-controls="collapsepage">
                                <i class="bi bi-basket fa-fw me-2"></i>Courses
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column" id="collapsepage" data-bs-parent="#navbar-sidebar">
                                <li class="nav-item"> <a class="nav-link" href="admin-course-list.html">All Courses</a></li>
                                <li class="nav-item"> <a class="nav-link" href="admin-course-category.html">Course Category</a></li>
                                <li class="nav-item"> <a class="nav-link" href="admin-course-detail.html">Course Detail</a></li>
                            </ul>
                        </li>

                        <!-- Menu item 3 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-student-list.html"><i class="fas fa-user-graduate fa-fw me-2"></i>Students</a></li>

                        <!-- Menu item 4 -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapseinstructors" role="button" aria-expanded="false" aria-controls="collapseinstructors">
                                <i class="fas fa-user-tie fa-fw me-2"></i>Instructors
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column" id="collapseinstructors" data-bs-parent="#navbar-sidebar">
                                <li class="nav-item"> <a class="nav-link" href="admin-instructor-list.html">Instructors</a></li>
                                <li class="nav-item"> <a class="nav-link" href="admin-instructor-detail.html">Instructor Detail</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin-instructor-request.html">Instructor requests
                                        <span class="badge text-bg-success rounded-circle ms-2">2</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu item 5 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-review.html"><i class="far fa-comment-dots fa-fw me-2"></i>Reviews</a></li>

                        <!-- Menu item 6 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-earning.html"><i class="far fa-chart-bar fa-fw me-2"></i>Earnings</a></li>

                        <!-- Menu item 7 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-setting.html"><i class="fas fa-user-cog fa-fw me-2"></i>Admin Settings</a></li>

                        <!-- Menu item 8 -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapseauthentication" role="button" aria-expanded="false" aria-controls="collapseauthentication">
                                <i class="bi bi-lock fa-fw me-2"></i>Authentication
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column" id="collapseauthentication" data-bs-parent="#navbar-sidebar">
                                <li class="nav-item"> <a class="nav-link" href="sign-up.html">Sign Up</a></li>
                                <li class="nav-item"> <a class="nav-link" href="sign-in.html">Sign In</a></li>
                                <li class="nav-item"> <a class="nav-link" href="forgot-password.html">Forgot Password</a></li>
                                <li class="nav-item"> <a class="nav-link" href="admin-error-404.html">Error 404</a></li>
                            </ul>
                        </li>

                        <!-- Title -->
                        <li class="nav-item ms-2 my-2">Documentation</li>

                        <!-- Menu item 9 -->
                        <li class="nav-item"> <a class="nav-link" href="docs/index.html"><i class="far fa-clipboard fa-fw me-2"></i>Documentation</a></li>

                        <!-- Menu item 10 -->
                        <li class="nav-item"> <a class="nav-link" href="docs/changelog.html"><i class="fas fa-sitemap fa-fw me-2"></i>Changelog</a></li>
                    </ul>
                    <!-- Sidebar menu end -->

                    <!-- Sidebar footer START -->
                    <div class="px-3 mt-auto pt-3">
                        <div class="d-flex align-items-center justify-content-between text-primary-hover">
                                <a class="h5 mb-0 text-body" href="admin-setting.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings">
                                    <i class="bi bi-gear-fill"></i>
                                </a>
                                <a class="h5 mb-0 text-body" href="index.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Home">
                                    <i class="bi bi-globe"></i>
                                </a>
                                <a class="h5 mb-0 text-body" href="sign-in.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Sign out">
                                    <i class="bi bi-power"></i>
                                </a>
                        </div>
                    </div>
                    <!-- Sidebar footer END -->

                </div>
            </div>
        </nav>
        <!-- Sidebar END -->

        @yield('content')
    </main>

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('backend/assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('backend/assets/js/functions.js') }}"></script>

</body>

</html>
