@can("barangay-official-update")
<div class="modal fade effect-slide-in-right" id="edit" tabindex="-1" 
	aria-labelledby="addTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div id="form-loader">
				<div class="text-center py-2">
					<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</div>
			<div id="form-container" class="d-none">
				<form method="POST">
					@csrf
					@method("PUT")
						<div class="modal-header">
							<h6 class="modal-title" id="editTitle"></h6>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
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
										<input type="password" class="form-control" id="password3" placeholder="Enter your password" name="password" />
										<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password3', this)">
											<i class="ti ti-eye align-middle"></i>
										</button>
									</div>
								</div>
								<div class="col-md-6">
									<label class="form-label fs-14 text-dark">Confirm Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="password4" placeholder="Enter your password" name="password_confirmation" />
										<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password4', this)">
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
								<div class="col-12 mt-3 d-flex justify-content-start align-items-center">
									<label class="form-label fs-14 text-dark">Account Status</label>
									<label for="account">
										<div class="toggle toggle-danger">
											<span></span>
										</div>
									</label>
									<input type="checkbox" name="status" id="account" hidden />
								</div>
							</div>

						</div>
						<div class="modal-footer p-2">
							<button type="submit" class="btn btn-success btn-wave waves-light">Save Changes</button>
							<button type="button" class="btn btn-dark btn-wave waves-light" data-bs-dismiss="modal">Close</button>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
@endcan