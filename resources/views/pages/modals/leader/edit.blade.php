@can("purok-leader-update")
<div class="modal fade effect-slide-in-right" id="edit" tabindex="-1" 
	aria-labelledby="addTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-dialog-centered">
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
							<div class="mb-2">
								<label class="form-label fs-14 text-dark">Resident Name</label>
								<select name="resident" 
									class="form-control select2-ajax" 
									data-select-placeholder="Search by last name..." 
									data-select-api="{{ route("api.search") }}" required></select>
							</div>
							<div class="mb-2">
								<label class="form-label fs-14 text-dark">Purok</label>
								<select name="purok" class="select2-icon form-control" data-select-placeholder="Select a purok" required>
									@foreach ($data["puroks"] as $item)
											<option value="{{ $item->id }}" data-icon="ti ti-map-pin">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="mb-2">
								<label class="form-label fs-14 text-dark">Date From</label>
								<input type="text" name="date_from" class="form-control flatpickr-human-friendly" placeholder="Choose a date" required>
							</div>
							<div class="mb-2">
								<label class="form-label fs-14 text-dark">Date To</label>
								<input type="text" name="date_to" class="form-control flatpickr-human-friendly" placeholder="Choose a date" required>
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