<script>
	$(window).on("load", function() {
		@if ($msg = Session::get("success"))
			Toast.notify("<h5>{{ $msg[0] }}</h5><p>{{ $msg[1] }}</p>", "success", {
				positionClass: "toast-top-center",
				closeButton: true,
				tapToDismiss: false,
				progressBar: true,
				rtl: false,
			})
		@endif
		@if ($msg = Session::get("update"))
			Toast.notify("<h5>{{ $msg[0] }}</h5><p>{{ $msg[1] }}</p>", "info", {
				positionClass: "toast-top-center",
				closeButton: true,
				tapToDismiss: false,
				progressBar: true,
				rtl: false,
			})
		@endif
		@if ($msg = Session::get("warning"))
			Toast.notify("<h5>{{ $msg[0] }}</h5><p>{{ $msg[1] }}</p>", "warning", {
				positionClass: "toast-top-center",
				closeButton: true,
				tapToDismiss: false,
				progressBar: true,
				rtl: false,
			})
		@endif
		@if ($msg = Session::get("delete"))
			Toast.notify("<h5>{{ $msg[0] }}</h5><p>{{ $msg[1] }}</p>", "warning", {
				positionClass: "toast-top-center",
				closeButton: true,
				tapToDismiss: false,
				progressBar: true,
				rtl: false,
			})
		@endif
		@error("verify_password")
		Toast.notify("<h5>Password Error</h5><p>{{ $message }}</p>", "error", {
				positionClass: "toast-top-center",
				closeButton: true,
				tapToDismiss: false,
				progressBar: true,
				rtl: false,
			})
		@enderror
	});
</script>