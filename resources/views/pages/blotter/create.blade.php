@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Create New Blotter
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/flatpickr/flatpickr.min.css") }}">
@endsection

@section("body")
	
<div class="page-header">
	<h1 class="page-title my-auto">Create New Blotter</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Incident</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route("blotters.index") }}">Blotter Lists</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Create New Blotter</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-10 mx-auto">
		<div class="card custom-card">
			<form action="{{ route("blotters.store") }}" method="POST">
				@csrf
			<div class="card-header justify-content-end">
				<button type="submit" class="btn btn-primary" style="width: 200px;">
					Submit
				</button>
			</div>
			<div class="card-body row g-3 mt-0">
				<div class="col-xxl-4 col-md-6">
					<label class="form-label fs-14 text-dark">
						Complainant Name <span class="fw-bold text-danger">*</span>
					</label>
					<select name="complaint" 
						class="form-control select2-ajax" 
						data-select-placeholder="Search by last name..." 
						data-select-api="{{ route("api.search") }}" required></select>
				</div>
				<div class="col-xxl-4 col-md-6">
					<label class="form-label fs-14 text-dark">
						Respondent Name <span class="fw-bold text-danger">*</span>
					</label>
					<select name="respondent" 
						class="form-control select2-ajax" 
						data-select-placeholder="Search by last name..." 
						data-select-api="{{ route("api.search") }}" required></select>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/flatpickr.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
@endsection