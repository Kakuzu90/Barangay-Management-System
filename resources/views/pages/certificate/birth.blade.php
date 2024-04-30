@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Issue Birth Certification
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/flatpickr/flatpickr.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Birth Certification</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Forms</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Birth Certification</li>
		</ol>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h4 class="card-title">Forms</h4>
	</div>
	<div class="card-body">
		<form action="{{ route("certificate.store.birth") }}" method="POST">
			@csrf
			<div class="row g-3">
				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Requested</label>
					<select name="resident" 
						class="form-control select2-ajax" 
						data-select-placeholder="Search by last name..." 
						data-select-api="{{ route("api.search") }}" required></select>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">OR Number</label>
					<input type="text" value="{{ old("or_number") }}" name="or_number" class="form-control" placeholder="Enter or number" required />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Child Name</label>
					<textarea name="child" placeholder="Enter child name" class="form-control" required>{{ old("child") }}</textarea>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Gender
					</label>
					<select name="gender" class="select2-icon form-control @error("gender") is-invalid @enderror" data-select-placeholder="Select a gender" required>
						@foreach (sexs() as $item)
								<option value="{{ $item }}" data-icon="ti ti-gender-intergender">{{ $item }}</option>
						@endforeach
					</select>
					@error("gender")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Date Of Birth
					</label>
					<input value="{{ old("date_birth") }}" type="text" name="date_birth" class="form-control flatpickr-human-friendly @error('date_birth') is-invalid @enderror" placeholder="Choose a date" required />
					@error("date_birth")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				
				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Place of Birth
					</label>
					<textarea name="place_birth" class="form-control @error('place_birth') is-invalid @enderror" placeholder="Enter place of birth" required>{{ old("place_birth") }}</textarea>
					@error("place_birth")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Mother's Name
					</label>
					<input value="{{ old("mother") }}" type="text" name="mother" class="form-control" placeholder="Enter mother's name" />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Father's Name
					</label>
					<input value="{{ old("father") }}" type="text" name="father" class="form-control" placeholder="Enter father's name" />
				</div>

				<div class="col-12">
					<label class="form-label fs-14 text-dark">Password</label>
					<div class="input-group">
						<input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password" name="password" required />
						<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password', this)">
							<i class="ti ti-eye align-middle"></i>
						</button>
					</div>
					<span class="mt-2">
						<b class="text-danger">Important:</b> For security reasons, we must verify your identity when you seek to generate a certificate. Please provide your password to proceed.
					</span>
				</div>
				<div class="col-12">
					<button
						type="submit"
						class="btn btn-primary btn-wave waves-light"
					>
						Generate Form
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script src="{{ asset("assets/js/flatpickr.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
@endsection