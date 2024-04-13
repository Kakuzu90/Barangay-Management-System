<!DOCTYPE html>
<html lang="en" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggle="close">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>
		@yield("title") | Barangay Record Management System
	</title>
	<link rel="icon shortcut" href="{{ asset("favicon.png") }}">

	<link rel="stylesheet" href="{{ asset("assets/libs/bootstrap/css/bootstrap.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/css/styles.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/css/icons.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/node-waves/waves.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/simplebar/simplebar.min.css") }}">

	<link rel="stylesheet" href="{{ asset("assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/datatables.net-bs5/css/responsive.bootstrap5.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/datatables.net-bs5/css/buttons.bootstrap5.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/toast/toastr.min.css") }}">

	@yield("styles")

	<link rel="stylesheet" href="{{ asset("assets/css/theme.css") }}">
</head>
<body>

	<div id="loader">
		<img src="{{ asset("assets/images/media/loader.svg") }}" alt="Loader SVG" />
	</div>

	<div class="page" id="app">
		<header class="app-header">
			<div class="main-header-container container-fluid py-20">
				<div class="header-content-left">

					<div class="header-element">
						<div class="horizontal-logo">
							<a href="{{ route("dashboard") }}" class="header-logo">
								<img src="{{ asset("favicon.png") }}" width="32" height="32" class="toggle-logo" alt="Brand Logo"/>
								<img src="{{ asset("favicon.png") }}" width="32" height="32" class="desktop-logo" alt="Brand Logo"/>
							</a>
						</div>
					</div>

					<div class="header-element">
						<a href="javascript:void(0);" aria-label="Hide Sidebar" 
							class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" 
							data-bs-toggle="sidebar">
							<span></span>
						</a>
					</div>

				</div>

				<div class="header-content-right">
					<div class="header-element main-profile-user">
						<a href="javascript:void(0);" 
							class="header-link dropdown-toggle" 
							id="mainHeaderProfile" data-bs-toggle="dropdown" 
							data-bs-auto-close="outside" aria-expanded="false">
							<div class="d-flex align-items-center">
								<div class="me-xxl-2 me-0">
									<img src="{{ asset("assets/images/avatar/administrator.png") }}" alt="img" width="32" height="32" class="rounded-circle" />
								</div>
								<div class="d-xxl-block d-none my-auto">
									<h6 class="fw-semibold mb-0 lh-1 fs-14">{{ auth()->user()->resident->fullname }}</h6>
									<span class="op-7 fw-normal d-block fs-11 text-danger">{{ auth()->user()->position->name }}</span>
								</div>
							</div>
						</a>

						<ul class="main-header-dropdown dropdown-menu pt-0 header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
							<li class="drop-heading d-block">
								<div class="text-center">
									<img src="{{ asset("assets/images/avatar/administrator.png") }}" alt="img" width="50" height="50" class="rounded-circle" />
									<h5 class="text-dark mt-2 mb-0 fs-14 fw-semibold">{{ auth()->user()->resident->fullname }}</h5>
									<small class="text-danger">{{ auth()->user()->position->name }}</small>
							 	</div>
					 		</li>
							@can("profile-settings")
							<li class="dropdown-item">
								<a class="d-flex w-100" href="#">
									<i class="ti ti-user-circle fs-18 me-2 text-primary"></i>
									Account Settings
								</a>
							</li>
							@endcan
							@can("system-settings")
							<li class="dropdown-item">
								<a class="d-flex w-100" href="#">
									<i class="ti ti-settings fs-18 me-2 text-primary"></i>
									System Settings
								</a>
							</li>
							@endcan
							<li class="dropdown-item">
								<a class="d-flex w-100" href="{{ route("logout") }}">
									<i class="ti ti-logout fs-18 me-2 text-primary"></i>
									Log Out
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>

		<aside class="app-sidebar sticky" id="sidebar">
			<div class="main-sidebar-header">
				<a href="{{ route("dashboard") }}" class="header-logo">
					<img src="{{ asset("favicon.png") }}" width="32" height="32" class="toggle-logo" alt="Brand Logo"/>
					<img src="{{ asset("favicon.png") }}" width="32" height="32" class="desktop-logo" alt="Brand Logo"/>
				</a>
			</div>

			<div class="main-sidebar" id="sidebar-scroll">
				<nav class="main-menu-container nav nav-pills flex-column sub-open">
					<div class="slide-left" id="slide-left">
						<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
					</div>

					@include("layouts.navigation.navigation")
					
				</nav>

				<div class="slide-right" id="slide-right">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
						<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
					</svg>
				</div>
			</div>
		</aside>

		<div class="main-content app-content">
			<div class="container-fluid">
				@yield("body")
			</div>
		</div>

		<footer class="footer mt-auto py-3 text-center">
			<div class="container">
					<span class="">
						Copyright © 2024.Barangay Record Management System All rights reserved
					</span>
			</div>
		</footer>
	</div>
	<div class="scrollToTop">
		<span class="arrow"><i class="ti ti-arrow-up"></i></span>
	</div>
	<div id="responsive-overlay"></div>

	<script src="{{ asset("assets/libs/jquery/jquery.min.js") }}"></script>
	<script src="{{ asset("assets/libs/@popperjs/core/umd/popper.min.js") }}"></script>
	<script src="{{ asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
	<script src="{{ asset("assets/js/defaultmenu.min.js") }}"></script>
	<script src="{{ asset("assets/libs/simplebar/simplebar.min.js") }}"></script>
	<script src="{{ asset("assets/libs/node-waves/waves.min.js") }}"></script>
	<script src="{{ asset("assets/js/sticky.js") }}"></script>
	<script src="{{ asset("assets/js/simplebar.js") }}"></script>

	<script src="{{ asset("assets/libs/toast/toastr.min.js") }}"></script>
	<script src="{{ asset("assets/js/customtoastr.js") }}"></script>
	@include("toast")

	<script src="{{ asset("assets/libs/datatables.net-bs5/js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js") }}"></script>
	<script src="{{ asset("assets/libs/datatables.net-bs5/js/dataTables.responsive.min.js") }}"></script>
	<script src="{{ asset("assets/libs/datatables.net-bs5/js/dataTables.buttons.min.js") }}"></script>

	@yield("scripts")
	
	<script src="{{ asset("assets/js/custom.js") }}"></script>
</body>
</html>