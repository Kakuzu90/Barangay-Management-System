<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-style="light" data-menu-style="light" data-toggle="close">
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
	<link rel="stylesheet" href="{{ asset("assets/css/icons.min.css") }}">

	@yield("styles")
	<style>
		.authentication-bg {
			height: 100%;
			width: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
			z-index: 1;
		}
	</style>

</head>
<body>

	<div class="authentication-bg">
		<div class="container-lg">
			<div class="row justify-content-center authentication authentication-basic align-items-center h-100">
				@yield("content")
			</div>
		</div>
	</div>

	<script src="{{ asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
</body>
</html>