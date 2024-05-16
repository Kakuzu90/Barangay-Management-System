<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-click" data-menu-position="fixed" data-theme-mode="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Barangay Management System | Nangka</title>

	<link rel="icon shortcut" href="{{ asset("favicon.png") }}">
	
	<link rel="stylesheet" href="{{ asset("assets/libs/bootstrap/css/bootstrap.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/css/styles.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/css/icons.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/node-waves/waves.min.css") }}">
	
</head>
<body class="landing-body">

	<div class="landing-page-wrapper">
		<header class="app-header">
			<div class="main-header-container container-fluid">
				<div class="header-content-left">

					<div class="header-element">
						<div class="horizontal-logo">
							<a href="{{ route("welcome") }}" class="header-logo">
								<img src="{{ asset("favicon.png") }}" class="toggle-logo" alt="Brand Logo" />
								<img src="{{ asset("favicon.png") }}" class="toggle-white" alt="Brand Logo" />
								<img src="{{ asset("favicon.png") }}" class="toggle-dark" alt="Brand Logo" />
							</a>
						</div>
					</div>

					<div class="header-element">
						<a href="javascript:void(0);" aria-label="anchor" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
							<span class="open-toggle">
								<i class="ti ti-menu-2 fs-20"></i>
							</span>
						</a>
					</div>

				</div>

				<div class="header-content-right">
					<div class="header-element align-items-center">
						<div class="btn-list d-lg-none d-flex">
							<a href="{{ route("sign-up.index") }}" class="btn btn-sm-w-sm btn-wave waves-light btn-outline-primary">
								New User
							</a>
							<a href="{{ route("login") }}" class="btn btn-sm-w-sm btn-wave waves-light btn-primary">
								Log In
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<aside class="app-sidebar sticky" id="sidebar">
			<div class="container-xl p-0">
				<div class="main-sidebar">
					<nav class="main-menu-container nav nav-pills sub-open">
						<div class="landing-logo-container">
							<div class="horizontal-logo">
								<a href="{{ route("welcome") }}" class="header-logo">
									<img src="{{ asset("favicon.png") }}" class="desktop-logo" alt="Brand Logo" />
									<img src="{{ asset("favicon.png") }}" class="desktop-white" alt="Brand Logo" />
								</a>
							</div>
						</div>
						<div class="slide-left" id="slide-left">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
						</div>
            
						<ul class="main-menu">

							<li class="slide">
								<a class="side-menu__item" href="#home">
										<span class="side-menu__label">Home</span>
								</a>
							</li>

							<li class="slide">
								<a class="side-menu__item" href="#mission">
										<span class="side-menu__label">Mission</span>
								</a>
							</li>

							<li class="slide">
								<a class="side-menu__item" href="#vision">
										<span class="side-menu__label">Vision</span>
								</a>
							</li>

							<li class="slide">
								<a class="side-menu__item" href="#official">
										<span class="side-menu__label">Official</span>
								</a>
							</li>

						</ul>
						<div class="slide-right" id="slide-right">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg>
						</div>
						<div class="d-lg-flex d-none">
							<div class="btn-list d-lg-flex d-none mt-lg-2 mt-xl-0 mt-0">
								<a href="{{ route("sign-up.index") }}" class="btn btn-w-sm btn-wave btn-outline-primary">
										New User
								</a>
								<a href="{{ route("login") }}" class="btn btn-w-sm btn-wave btn-primary">
									Log In
								</a>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</aside>

		<div class="main-content landing-main">
			<div class="landing-banner" id="home">
				<section class="section">
					<div class="container px-sm-0 main-banner-container pb-0">
						<div class="row">
							<div class="col-xl-6 col-lg-6 animation-zidex pos-relative my-auto">
								<h5 class="fw-semibold">Manage Your Records</h5>
								<h1 class="text-start fw-bold mb-3 lh-base">Barangay Management System <span class="text-primary">Nangka</span></h1>
								<p class="pb-3 mb-3">
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam voluptatem animi ipsam aut ipsum officia ex voluptate laboriosam, sequi excepturi in cum quo dolores commodi distinctio totam explicabo deserunt quis!
								</p>

								<a href="{{ route("login") }}" class="btn ripple btn-min w-lg me-2 btn-primary">
									<i class="fe fe-play me-2"></i> Get Started
								</a>
							</div>
							<div class="col-xl-6 col-lg-6 my-auto text-end">
								<img src="{{ asset("assets/images/landing/background 1.jpg") }}" alt="Barangay" class="w-100" />
							</div>
						</div>
					</div>
				</section>
			</div>

			<section class="section section-bg" id="mission">
				<div class="container text-center">
					<p class="fs-18 fw-medium mb-1">
						<span class="landing-section-heading">Mission</span>
					</p>
					<span class="landing-title"></span>
				</div>
				<div class="row justify-content-center align-items-center g-0">
						<div class="col-xxl-5 col-xl-5 col-lg-5 customize-image text-center">
							<div class="text-lg-end">
								<img src="{{ asset("assets/images/landing/Team goals-pana.png") }}" alt="Mission" class="img-fluid" />
							</div>
						</div>
						<div class="col-xxl-5 col-xl-5 col-lg-5 my-auto text-start pt-5 pb-0 px-lg-2 px-5">
								
						</div>
				</div>
			</section>

			<section class="section section-bg" id="vision">
				<div class="container text-center">
					<p class="fs-18 fw-medium mb-1">
						<span class="landing-section-heading">Vision</span>
					</p>
					<span class="landing-title"></span>
				</div>
				<div class="row justify-content-center align-items-center g-0">
					<div class="col-xxl-5 col-xl-5 col-lg-5 my-auto text-start pt-5 pb-0 px-lg-2 px-5">
								
					</div>
					<div class="col-xxl-5 col-xl-5 col-lg-5 customize-image text-center">
						<div class="text-lg-end">
							<img src="{{ asset("assets/images/landing/Vision statement-amico.png") }}" alt="Vision" class="img-fluid" />
						</div>
					</div>
				</div>
			</section>

		</div>

	</div>

	<div class="scrollToTop">
		<span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
	</div>
	<div id="responsive-overlay"></div>
	
	<script src="{{ asset("assets/libs/@popperjs/core/umd/popper.min.js") }}"></script>
	<script src="{{ asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
	<script src="{{ asset("assets/js/defaultmenu.min.js") }}"></script>
	<script src="{{ asset("assets/js/landing.js") }}"></script>
	<script src="{{ asset("assets/js/sticky.js") }}"></script>
	<script src="{{ asset("assets/libs/node-waves/waves.min.js") }}"></script>
</body>
</html>