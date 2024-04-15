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
	<link rel="stylesheet" href="{{ asset("assets/libs/tagify/tagify.css") }}">
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
				<button type="submit" class="btn btn-primary btn-wave waves-light" style="width: 200px;">
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

				<div class="col-xxl-4 col-md-6">
					<label class="form-label fs-14 text-dark">
						Date Incident <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ old("incident_date") }}" type="text" name="incident_date" class="form-control flatpickr-human-friendly @error('incident_date') is-invalid @enderror" placeholder="Choose a date" required />
					@error("incident_date")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xxl-4 col-md-6">
					<label class="form-label fs-14 text-dark">
						Date Hearing
					</label>
					<input value="{{ old("date_hearing") }}" type="text" name="date_hearing" class="form-control flatpickr-human-friendly @error('date_hearing') is-invalid @enderror" placeholder="Choose a date" />
					@error("date_hearing")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xxl-4 col-md-6">
					<label class="form-label fs-14 text-dark">
						Involves
					</label>
					<input 
						type="text" name="involves" 
						class="tagify form-control h-auto" 
						placeholder="Type the name here and press enter"
						aria-label="Involves Tagify"
						/>
				</div>

				<div class="col-xxl-4 col-md-6">
					<label class="form-label fs-14 text-dark">
						Place of Incident <span class="fw-bold text-danger">*</span>
					</label>
					<textarea name="incident_location" class="form-control @error('incident_location') is-invalid @enderror" placeholder="Enter place of birth" required>{{ old("incident_location") }}</textarea>
					@error("incident_location")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

			</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/tagify/tagify.min.js") }}"></script>
	<script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/flatpickr.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
	<script>
		const tagify = new Tagify($(".tagify")[0]);
	</script>
@endsection