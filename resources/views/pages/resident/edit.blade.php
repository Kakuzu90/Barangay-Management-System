@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Edit {{ $resident->fullname }}
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/flatpickr/flatpickr.min.css") }}">
@endsection

@section("body")

<div class="page-header">
	<h1 class="page-title my-auto">Edit {{ $resident->fullname }}</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route("residents.index") }}">Resident Lists</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Edit {{ $resident->fullname }}</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-10 mx-auto">
		<div class="card custom-card">
			<form action="{{ route("residents.update", $resident->id) }}" method="POST">
				@csrf
				@method("PUT")
			<div class="card-header justify-content-end">
				<button type="submit" class="btn btn-success" style="width: 200px;">
					Save Changes
				</button>
			</div>
			<div class="card-body row g-3 mt-0">
		
				<div class="col-12">
					<h4 class="card-title text-primary border-bottom pb-2">Basic Information</h4>
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						First Name <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ $resident->first_name }}" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name" required />
					@error("first_name")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Middle Name <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ $resident->middle_name }}" type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Enter middle name" required />
					@error("middle_name")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Last Name <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ $resident->last_name }}" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last name" required />
					@error("last_name")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Maiden Name <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $resident->maiden_name }}" type="text" name="maiden" class="form-control" placeholder="Enter maiden name" />
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Nickname <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $resident->nickname }}" type="text" name="nickname" class="form-control" placeholder="Enter nickname"  />
				</div>
				
				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Phone Number <span class="fw-bold text-danger">*</span>
					</label>
					<input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror phone-number" placeholder="(+63)" minlength="13" maxlength="13"  required />
					@error("phone_number")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Gender <span class="fw-bold text-danger">*</span>
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

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Citizenship <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ $resident->citizenship }}" type="text" name="citizenship" class="form-control @error('citizenship') is-invalid @enderror" placeholder="Enter citizenship" required />
					@error("citizenship")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Civil Status <span class="fw-bold text-danger">*</span>
					</label>
					<select name="civil_status" class="select2-icon form-control @error("civil_status") is-invalid @enderror" data-select-placeholder="Select a status" required>
						@foreach (civilStatus() as $item)
								<option value="{{ $item }}" data-icon="ti ti-hierarchy">{{ $item }}</option>
						@endforeach
					</select>
					@error("civil_status")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Education Level <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ $resident->education_level }}" type="text" name="education" class="form-control @error('education') is-invalid @enderror" placeholder="Enter education level" required />
					@error("education")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 has-validation">
					<label class="form-label fs-14 text-dark">
						Date Of Birth <span class="fw-bold text-danger">*</span>
					</label>
					<input value="{{ $resident->date_birth->format("Y-m-d") }}" type="text" name="date_birth" class="form-control flatpickr-human-friendly @error('date_birth') is-invalid @enderror" placeholder="Choose a date" required />
					@error("date_birth")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Purok <span class="fw-bold text-danger">*</span>
					</label>
					<select name="purok" class="select2-icon form-control @error("purok") is-invalid @enderror" data-select-placeholder="Select a purok" required>
						@foreach ($puroks as $item)
								<option value="{{ $item->id }}" data-icon="ti ti-map-pin">{{ $item->name }}</option>
						@endforeach
					</select>
					@error("purok")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Place of Birth <span class="fw-bold text-danger">*</span>
					</label>
					<textarea name="place_birth" class="form-control @error('place_birth') is-invalid @enderror" placeholder="Enter place of birth" required>{{ $resident->place_birth }}</textarea>
					@error("place_birth")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Current Address <span class="fw-bold text-danger">*</span>
					</label>
					<textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter current address" required>{{ $resident->address }}</textarea>
					@error("address")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-12">
					<h4 class="card-title text-primary border-bottom pb-2">Other Information</h4>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Mother's Name <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $resident->mother_name }}" type="text" name="mother" class="form-control" placeholder="Enter mother's name" />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Father's Name <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $resident->father_name }}" type="text" name="father" class="form-control" placeholder="Enter father's name" />
				</div>

				<div class="col-12">
					<h4 class="card-title text-primary border-bottom pb-2">Contact Person Incase of Emergency</h4>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Contact Person's Name <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $resident->contact_person }}" type="text" name="contact_person" class="form-control" placeholder="Enter contact person's name" />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Contact Person's Address  <span class="text-muted">( Optional )</span>
					</label>
					<textarea name="contact_address" class="form-control" placeholder="Enter address">{{ $resident->contact_address }}</textarea>
				</div>
				
			</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/cleave.js/cleave.min.js") }}"></script>
	<script src="{{ asset("assets/libs/cleave.js/addons/cleave-phone.ph.js") }}"></script>
	<script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/flatpickr.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>

	<script>
		 $('.phone-number').each(function() {
			var cleave = new Cleave(this, {
				prefix: '+63',
				uppercase: true
			});
			const value = '{{ $resident->phone_number }}'
			cleave.setRawValue(value)
		})
		
		$("select[name=gender]").val('{{ $resident->gender }}').trigger("change");
		$("select[name=civil_status]").val('{{ $resident->civil_status }}').trigger("change");
		$("select[name=purok]").val('{{ $resident->purok_id }}').trigger("change");
	</script>
@endsection