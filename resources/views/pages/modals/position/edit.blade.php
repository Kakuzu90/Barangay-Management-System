@can("position-update")
<div class="modal fade effect-slide-in-right" id="edit" tabindex="-1" 
	aria-labelledby="addTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div id="form-loader">
				<div class="text-center py-2">
					<div class="spinner-border" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</div>
			<div id="form-container" class="d-none">
				<form method="POST">
					@csrf
					@method("PUT")
						<div class="modal-body">
							<div class="mb-2">
								<label class="form-label fs-14 text-dark">Position Name</label>
								<input type="text" name="name" class="form-control" placeholder="Enter position name" required />
							</div>
							<div class="mb-2">
								<label class="form-label fs-14 text-dark">Position Order</label>
								<select name="order" class="select2-icon form-control" data-select-placeholder="Select a position order" required>
									@for ($i = 1; $i < getPriorityRange(); $i++)
									<option value="{{ $i }}" data-icon="bi bi-view-stacked">{{ $i }}</option>
									@endfor
								</select>
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