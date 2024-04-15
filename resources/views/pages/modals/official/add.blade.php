@can("barangay-official-store")
<div class="modal fade effect-slide-in-right" id="add" tabindex="-1" 
	aria-labelledby="addTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="addTitle">
					Create New Official
				</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
		<form action="{{ route("officials.store") }}" method="POST">
		@csrf
			<div class="modal-body">

				<div class="row g-2">
					<div class="col-md-12">
						<label class="form-label fs-14 text-dark">Resident Name</label>
						<select name="resident" 
							class="form-control select2-ajax" 
							data-select-placeholder="Search by last name..." 
							data-select-api="{{ route("api.search") }}" required></select>
					</div>
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Position</label>
						<select name="position" class="select2-icon form-control" data-select-placeholder="Select a position" required>
							@foreach ($data["positions"] as $item)
									<option value="{{ $item->id }}" data-icon="ti ti-section">{{ $item->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Username</label>
						<input type="text" class="form-control" name="username" placeholder="Enter username" required>
					</div>
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Password</label>
						<div class="input-group">
							<input type="password" class="form-control" id="password1" placeholder="Enter your password" name="password" required />
							<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password1', this)">
								<i class="ti ti-eye align-middle"></i>
							</button>
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Confirm Password</label>
						<div class="input-group">
							<input type="password" class="form-control" id="password2" placeholder="Enter your password" name="password_confirmation" required />
							<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password2', this)">
								<i class="ti ti-eye align-middle"></i>
							</button>
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Date From</label>
						<input type="text" name="date_from" class="form-control flatpickr-human-friendly" placeholder="Choose a date" required>
					</div>
					<div class="col-md-6">
						<label class="form-label fs-14 text-dark">Date To</label>
						<input type="text" name="date_to" class="form-control flatpickr-human-friendly" placeholder="Choose a date" required>
					</div>
				</div>

			</div>
			<div class="modal-footer p-2">
				<button type="submit" class="btn btn-primary btn-wave waves-light">Create</button>
				<button type="button" class="btn btn-dark btn-wave waves-light" data-bs-dismiss="modal">Close</button>
			</div>
		</form>
		</div>
	</div>
</div>
@endcan