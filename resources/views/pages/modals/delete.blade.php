<div class="modal fade effect-slide-in-right" id="delete" tabindex="-1" 
	aria-label="Delete Prompt" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<form method="POST" class="needs-validation" novalidate>
		@csrf
		@method("DELETE")
			<div class="modal-body text-center">
				<i class="bi bi-question-octagon-fill display-1 text-danger"></i>
				<h3>Warning!</h3>
				<p class="text-muted">Are you sure you want to delete <span class="text-danger fw-bold" id="to-delete"></span> data?</p>

				<div>
					<div class="input-group has-validation">
						<input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password" name="password" required />
						<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password', this)">
							<i class="ti ti-eye align-middle"></i>
						</button>
						<div class="invalid-feedback text-start">
							Password field is required.
						</div>
					</div>
					<span class="mt-2">
						<b class="text-danger">Important:</b> For security reasons, we must verify your identity when you seek to erase valuable data. Please provide your password to proceed.
					</span>
				</div>

			</div>
			<div class="modal-footer p-2 d-flex justify-content-center">
				<button type="submit" class="btn btn-outline-danger btn-wave waves-light">Yes, delete it!</button>
				<button type="button" class="btn btn-dark btn-wave waves-light" data-bs-dismiss="modal">No, cancel it</button>
			</div>
		</form>
		</div>
	</div>
</div>
