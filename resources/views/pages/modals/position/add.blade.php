@can("position-store")
<div class="modal fade effect-slide-in-right" id="add" tabindex="-1" 
	aria-labelledby="addTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="addTitle">
					Create New Position
				</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
		<form action="{{ route("positions.store") }}" method="POST">
		@csrf
			<div class="modal-body">
				<div class="mb-2">
					<label class="form-label fs-14 text-dark">Position Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter position name" required />
				</div>
				<div class="mb-2">
					<label class="form-label fs-14 text-dark">Position Order</label>
					<select name="order" class="select2-icon form-control" data-select-placeholder="Select a position order" required>
						@for ($i = 1; $i < getPriorityRange() + 1; $i++)
								<option value="{{ $i }}" data-icon="bi bi-view-stacked">{{ $i }}</option>
						@endfor
					</select>
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