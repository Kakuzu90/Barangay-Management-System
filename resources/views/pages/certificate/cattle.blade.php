@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Issue Cattle Certificate
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection


@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Cattle Certificate</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Forms</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Cattle Certificate</li>
		</ol>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h4 class="card-title">Forms</h4>
	</div>
	<div class="card-body">
		<form action="{{ route("certificate.store.cattle") }}" method="POST">
			@csrf
			<div class="row g-3">
				
				<div class="col-md-12">
					<label class="form-label fs-14 text-dark">OR Number</label>
					<input type="text" value="{{ old("or_number") }}" name="or_number" class="form-control" placeholder="Enter or number" required />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Official Witness</label>
					<select name="witness" 
						class="form-control select2-ajax" 
						data-select-placeholder="Search by last name..." 
						data-select-api="{{ route("api.search") }}" required></select>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Owner</label>
					<select name="owner" 
						class="form-control select2-ajax" 
						data-select-placeholder="Search by last name..." 
						data-select-api="{{ route("api.search") }}" required></select>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Hayop</label>
					<textarea name="hayop" placeholder="Separate (,) if more than one" class="form-control" required>{{ old("hayop") }}</textarea>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Kasarian</label>
					<textarea name="kasarian" placeholder="Separate (,) if more than one" class="form-control" required>{{ old("kasarian") }}</textarea>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Edad</label>
					<textarea name="edad" placeholder="Separate (,) if more than one" class="form-control" required>{{ old("edad") }}</textarea>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">Color</label>
					<textarea name="color" placeholder="Separate (,) if more than one" class="form-control" required>{{ old("color") }}</textarea>
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
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
@endsection