@extends("layouts.auth")

@section("title")
	Sign Up
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection

@section("content")
	<div class="col-md-7 col-sm-8 col-12">
		<div class="my-4 d-flex justify-content-center">
			<a href="{{ route("welcome") }}">
				<img src="{{ asset("favicon.png") }}" height="75" alt="Brand Logo"/>
			</a>
		</div>
		<div class="card custom-card">
			<div class="card-body p-5">
				<p class="h4 fw-semibold mb-2 text-center">Sign In</p>
				<p class="mb-4 text-muted op-7 fw-normal text-center">Barangay Record Management System</p>
			<form action="{{ route("sign-up.store") }}" method="POST">
				@csrf
				<div class="row gy-3">
					
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">
							First Name
						</label>
						<input value="{{ old("first_name") }}" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name" required />
						@error("first_name")
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
	
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">
							Middle Name
						</label>
						<input value="{{ old("middle_name") }}" type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Enter middle name" required />
						@error("middle_name")
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
	
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">
							Last Name
						</label>
						<input value="{{ old("last_name") }}" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last name" required />
						@error("last_name")
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Username</label>
						<input value="{{ old("username") }}" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Enter username" required>
						@error("username")
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Password</label>
						<div class="input-group">
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" placeholder="Enter your password" name="password" required />
							<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password1', this)">
								<i class="ti ti-eye align-middle"></i>
							</button>
						</div>
						@error("password")
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Confirm Password</label>
						<div class="input-group">
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password2" placeholder="Enter your password" name="password_confirmation" required />
							<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password2', this)">
								<i class="ti ti-eye align-middle"></i>
							</button>
						</div>
						@error("password")
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div class="col-12">
						<label class="form-label fs-14 text-dark">Position</label>
						<select name="position" class="select2-icon form-control" data-select-placeholder="Select a position" required>
							@foreach ($data["positions"] as $item)
									<option value="{{ $item->id }}" data-icon="ti ti-section">{{ $item->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-xl-12 d-grid mt-4">
						<button type="submit" class="btn btn-lg btn-primary">Sign Up</button>
					</div>
				</div>
				<div class="text-center my-3 authentication-barrier">
					<span>OR</span>
				</div>
				<div class="text-center">
					<p class="text-muted mt-3">Already have an account? <a href="{{ route("login") }}" class="text-primary">Sign In</a></p>
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
			<strong>Success:</strong> You have successfully registered!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
		</div>
		@endif
	</div>
@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/jquery/jquery.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
@endsection