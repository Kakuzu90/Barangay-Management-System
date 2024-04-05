@extends("layouts.auth")

@section("title")
	Sign In
@endsection


@section("content")
	<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
		<div class="my-4 d-flex justify-content-center">
			<a href="{{ route("login") }}">
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
						<input type="text" name="username" class="form-control form-control-lg" placeholder="Enter your username" autofocus required />
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
					<p class="text-muted mt-3">Dont have an account? <a href="sign-up.html" class="text-primary">Sign Up</a></p>
				</div>
			</form>
			</div>
		</div>
	</div>
@endsection