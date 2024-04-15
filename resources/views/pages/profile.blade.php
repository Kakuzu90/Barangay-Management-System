@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Account Settings
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/flatpickr/flatpickr.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/croppie/croppie.css") }}">
@endsection

@section("body")

<div class="page-header">
	<h1 class="page-title my-auto">Account Settings</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">My Account</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Account Settings</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-3">
		<div class="card custom-card">
			<form action="{{ route("account-settings.avatar") }}" method="POST">
				@csrf
				@method("PATCH")
				<div class="card-header justify-content-end d-none" id="upload-header">
					<button type="submit" class="btn btn-sm btn-success btn-wave waves-light">
						Save Profile
					</button>
				</div>
				<div class="card-body">
					<input type="file" id="profile-photo" hidden accept="image/*" />
					<input type="text" name="profile" hidden />
					<div id="uploaded-container" class="d-flex justify-content-center align-items-center flex-column">
						<div class="avatar avatar-rounded avatar-xxl mb-2" style="width: 10rem; height: 10rem;">
							<img src="{{ $data["user"]->resident->avatar() }}" data-avatar="{{ $data["user"]->resident->avatar() }}" id="profile" alt="Avatar" />
						</div>
						<div class="d-flex">
							<label
								for="profile-photo"
								class="btn btn-sm btn-outline-success btn-wave waves-light"
							>
								<i class="ti ti-photo fs-14"></i> Select Profile
							</label>
							<button type="button" class="btn-cancel btn btn-sm btn-outline-danger btn-wave waves-light ms-2 d-none">
								<i class="bi bi-x"></i> Cancel
							</button>
						</div>
					</div>
					<div class="d-none" id="upload-container">
						<div id="upload-prompt"></div>
						<div class="mt-2 text-center">
							<button type="button" class="btn-crop btn btn-sm btn-success btn-wave waves-light">
								<i class="bi bi-crop"></i> Crop
							</button>
							<button type="button" class="btn-cancel btn btn-sm btn-outline-danger btn-wave waves-light">
								<i class="bi bi-x"></i> Cancel
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="card custom-card">
			<form action="{{ route("account-settings.account") }}" method="POST">
				@csrf
				@method("PATCH")
				<div class="card-header justify-content-between">
					<h4 class="card-title mb-0">Account Information</h4>
					<button type="submit" class="btn btn-success btn-wave waves-light">
						Save Changes
					</button>
				</div>
				<div class="card-body">
					<div class="row g-3 mt-0">
						@if (!$data["user"]->resident->isAdmin())
						<div class="col-12">
							<p class="text-dark mb-0">
								<b class="text-danger">Important:</b> Updating your position will temporarily deactivate your account for security reasons. Please wait until an administrator reactivates your account.
							</p>
						</div>
						@endif
						<div class="col-xxl-12">
							<label class="form-label fs-14 text-dark">
								Username <span class="fw-bold text-danger">*</span>
							</label>
							<input type="text" value="{{ $data["user"]->username }}" name="username" class="form-control @error("username") is-invalid @enderror" placeholder="Enter username" required >
							@error("username")
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						@if (!$data["user"]->resident->isAdmin())
						<div class="col-xxl-12">
							<label class="form-label fs-14 text-dark">
								Position <span class="fw-bold text-danger">*</span>
							</label>
							<select name="position" class="select2-icon form-control @error("position") is-invalid @enderror" data-select-placeholder="Select a status" required>
								@foreach ($data["positions"] as $item)
										<option value="{{ $item->id }}" data-icon="ti ti-section">{{ $item->name }}</option>
								@endforeach
							</select>
							@error("position")
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						@endif
						<div class="col-xxl-12">
							<label class="form-label fs-14 text-dark">
								Password <span class="fw-bold text-danger">*</span>
							</label>
							<div class="input-group">
								<input type="password" class="form-control" id="password1" placeholder="Enter your password" name="password" required />
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
					</div>
				</div>
			</form>
		</div>

		<div class="card custom-card">
			<form action="{{ route("account-settings.password") }}" method="POST">
				@csrf
				@method("PATCH")
				<div class="card-header justify-content-between">
					<h4 class="card-title mb-0">Password Information</h4>
					<button type="submit" class="btn btn-success btn-wave waves-light">
						Change Password
					</button>
				</div>
				<div class="card-body">
					<div class="row g-3 mt-0">
						<div class="col-xxl-12">
							<label class="form-label fs-14 text-dark">
								Current Password <span class="fw-bold text-danger">*</span>
							</label>
							<div class="input-group">
								<input type="password" class="form-control" id="password2" placeholder="Enter your current password" name="current" required />
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
						<div class="col-xxl-12">
							<label class="form-label fs-14 text-dark">
								New Password <span class="fw-bold text-danger">*</span>
							</label>
							<div class="input-group">
								<input type="password" class="form-control" id="password3" placeholder="Enter your new password" name="password" required />
								<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password3', this)">
									<i class="ti ti-eye align-middle"></i>
								</button>
							</div>
							@error("password")
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-xxl-12">
							<label class="form-label fs-14 text-dark">
								Confirm Password <span class="fw-bold text-danger">*</span>
							</label>
							<div class="input-group">
								<input type="password" class="form-control" id="password4" placeholder="Confirm your new password" name="password_confirmation" required />
								<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password4', this)">
									<i class="ti ti-eye align-middle"></i>
								</button>
							</div>
							@error("password")
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>

	<div class="col-xl-9">
		<div class="card custom-card">
			<form action="{{ route("account-settings.general") }}" method="POST">
				@csrf
				@method("PUT")
			<div class="card-header justify-content-between">
				<h4 class="card-title mb-0">General Information</h4>
				<button type="submit" class="btn btn-success btn-wave waves-light" style="width: 200px;">
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
					<input value="{{ $data["user"]->resident?->first_name }}" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name" required />
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
					<input value="{{ $data["user"]->resident?->middle_name }}" type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Enter middle name" required />
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
					<input value="{{ $data["user"]->resident?->last_name }}" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last name" required />
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
					<input value="{{ $data["user"]->resident?->maiden_name }}" type="text" name="maiden" class="form-control" placeholder="Enter maiden name" />
				</div>

				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
					<label class="form-label fs-14 text-dark">
						Nickname <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $data["user"]->resident?->nickname }}" type="text" name="nickname" class="form-control" placeholder="Enter nickname"  />
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
					<input value="{{ $data["user"]->resident?->citizenship }}" type="text" name="citizenship" class="form-control @error('citizenship') is-invalid @enderror" placeholder="Enter citizenship" required />
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
					<input value="{{ $data["user"]->resident?->education_level }}" type="text" name="education" class="form-control @error('education') is-invalid @enderror" placeholder="Enter education level" required />
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
					<input value="{{ $data["user"]->resident?->date_birth?->format("Y-m-d") }}" type="text" name="date_birth" class="form-control flatpickr-human-friendly @error('date_birth') is-invalid @enderror" placeholder="Choose a date" required />
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
						@foreach ($data["puroks"] as $item)
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
					<textarea name="place_birth" class="form-control @error('place_birth') is-invalid @enderror" placeholder="Enter place of birth" required>{{ $data["user"]->resident?->place_birth }}</textarea>
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
					<textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter current address" required>{{ $data["user"]->resident?->address }}</textarea>
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
					<input value="{{ $data["user"]->resident?->mother_name }}" type="text" name="mother" class="form-control" placeholder="Enter mother's name" />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Father's Name <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $data["user"]->resident?->father_name }}" type="text" name="father" class="form-control" placeholder="Enter father's name" />
				</div>

				<div class="col-12">
					<h4 class="card-title text-primary border-bottom pb-2">Contact Person Incase of Emergency</h4>
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Contact Person's Name <span class="text-muted">( Optional )</span>
					</label>
					<input value="{{ $data["user"]->resident?->contact_person }}" type="text" name="contact_person" class="form-control" placeholder="Enter contact person's name" />
				</div>

				<div class="col-md-6">
					<label class="form-label fs-14 text-dark">
						Contact Person's Address  <span class="text-muted">( Optional )</span>
					</label>
					<textarea name="contact_address" class="form-control" placeholder="Enter address">{{ $data["user"]->resident?->contact_address }}</textarea>
				</div>
				
			</div>

			</form>
		</div>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/croppie/croppie.js") }}"></script>
	<script src="{{ asset("assets/libs/cleave.js/cleave.min.js") }}"></script>
	<script src="{{ asset("assets/libs/cleave.js/addons/cleave-phone.ph.js") }}"></script>
	<script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/flatpickr.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>

	<script>
		$('.phone-number').each(function() {
			var cleave = new Cleave(this, {
				prefix: '+63',
				uppercase: true
			});
			const value = '{{ $data["user"]->resident->phone_number }}'
			cleave.setRawValue(value)
		})
		
		$("select[name=gender]").val('{{ $data["user"]?->resident->gender }}').trigger("change");
		$("select[name=civil_status]").val('{{ $data["user"]?->resident->civil_status }}').trigger("change");
		$("select[name=purok]").val('{{ $data["user"]?->resident->purok_id }}').trigger("change");
		@if (!$data["user"]->resident->isAdmin())
		$("select[name=position]").val('{{ $data["user"]->position_id }}').trigger("change");
		@endif

		$image = $("#upload-prompt").croppie({
			enableExif: true,
			viewport: {
					width: 200,
					height: 200,
					type: "square"
			},
			boundary: {
					width: 220,
					height: 220
			}
		});

		$(document).on('change', '#profile-photo', function() {
			let reader = new FileReader();
			reader.onload = function (e) {
				$image.croppie('bind', {
					url: e.target.result
				})			
			}
			reader.readAsDataURL(this.files[0]);

			$("#uploaded-container").addClass("d-none");
			$("#uploaded-container").removeClass("d-block");
			$("#upload-container").addClass("d-block");
			$("#upload-container").removeClass("d-none");
		});

		$(document).on("click", ".btn-cancel", function() {
			const image = $("#profile").data("avatar");
			$('#profile').attr('src', image)
			$("#profile-photo").val(null);
			$("#upload-header").addClass("d-none");
			$("#upload-header").removeClass("d-block");
			$("#uploaded-container .btn-cancel").addClass("d-none");
			$("#uploaded-container .btn-cancel").removeClass("d-block");
			$("#uploaded-container").addClass("d-block");
			$("#uploaded-container").removeClass("d-none");
			$("#upload-container").addClass("d-none");
			$("#upload-container").removeClass("d-block");
		});

		$(document).on('click', '.btn-crop', function() {
			$image.croppie('result', {
				type : 'canvas',
				size : 'viewport',
			}).then(function(response) {
				$("#profile-photo").val(null);
				$("#upload-header").addClass("d-block");
				$("#upload-header").removeClass("d-none");
				$("#uploaded-container .btn-cancel").addClass("d-block");
				$("#uploaded-container .btn-cancel").removeClass("d-none");
				$("#uploaded-container").addClass("d-block");
				$("#uploaded-container").removeClass("d-none");
				$("#upload-container").addClass("d-none");
				$("#upload-container").removeClass("d-block");
				$('#profile').attr('src', response)
				$('input[name=profile]').val(response)
			});
		});

		</script>
@endsection