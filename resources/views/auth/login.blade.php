@extends("layouts.auth")

@section("title")
	Sign In
@endsection


@section("content")
	<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
		<div class="my-4 d-flex justify-content-center">
			<a href="{{ route("welcome") }}">
				<img src="{{ asset("favicon.png") }}" height="75" alt="Brand Logo"/>
			</a>
		</div>
		<div class="card custom-card">
			<div class="card-body p-5">
				<p class="h4 fw-semibold mb-2 text-center">Sign In</p>
				<p class="mb-4 text-muted op-7 fw-normal text-center">Barangay Record Management System</p>
			<form action="{{ route("login.stored") }}" method="POST">
				@csrf
				<div class="row gy-3">
					<div class="col-xl-12">
						<label class="form-label text-default">Username</label>
						<input type="text" 
							name="username" class="form-control form-control-lg @error("failed") is-invalid @enderror" 
							placeholder="Enter your username"
							value="{{ old("username") }}"
							autofocus required />
						@error("failed")
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-xl-12">
						<label class="form-label text-default">Password</label>
						<div class="input-group">
							<input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password" name="password" required />
							<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password', this)">
								<i class="ti ti-eye align-middle"></i>
							</button>
						</div>
					</div>
					<div class="col-xl-12 mb-2">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" name="remember" id="defaultCheck1">
							<label class="form-check-label text-muted fw-normal" for="defaultCheck1">
									Remember me
							</label>
						</div>
					</div>
					<div class="col-xl-12 d-grid mt-2">
						<button type="submit" class="btn btn-lg btn-primary">Sign In</button>
					</div>
				</div>
				<div class="text-center my-3 authentication-barrier">
					<span>OR</span>
				</div>
				<div class="text-center">
					<p class="text-muted mt-3">Dont have an account? <a href="{{ route("sign-up.index") }}" class="text-primary">Sign Up</a></p>
				</div>
			</form>
			</div>
		</div>

		@if (Session::get("status"))
		<div class="alert alert-success alert-dismissible fade show custom-alert-icon shadow-sm" role="alert">
			<svg class="svg-success" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
				<path d="M0 0h24v24H0z" fill="none"/>
				<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
			</svg>
			<strong>Success:</strong> You have successfully logout!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
		</div>
		@endif
	</div>
@endsection