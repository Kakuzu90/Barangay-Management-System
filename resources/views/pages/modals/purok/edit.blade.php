@can("purok-update")
<div class="modal fade effect-slide-in-right" id="edit" tabindex="-1" 
	aria-labelledby="editTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div id="form-loader">
				<div class="text-center my-5">
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
						<label class="form-label fs-14 text-dark">Purok Name</label>
						<input type="text" name="name" class="form-control" placeholder="Enter purok name" required />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success btn-wave waves-light">Save Changes</button>
						<button type="button" class="btn btn-dark btn-wave waves-light" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan