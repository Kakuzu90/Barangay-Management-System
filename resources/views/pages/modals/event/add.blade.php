@can("event-store")
<div class="modal fade effect-slide-in-right" id="add" tabindex="-1" 
	aria-labelledby="addTitle" data-bs-keyboard="false"
	data-bs-backdrop="static" aria-hidden="true"
	>
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="addTitle">
					Create New Event
				</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
		<form action="{{ route("events.store") }}" method="POST">
		@csrf
			<div class="modal-body">
				<div class="mb-2">
					<label class="form-label fs-14 text-dark">Title</label>
					<input type="text" name="title" class="form-control" placeholder="Enter event title" required />
				</div>
				<div class="mb-2">
					<label class="form-label fs-14 text-dark">Body</label>
					<textarea name="body" placeholder="Enter event body" class="form-control" rows="2" required></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label fs-14 text-dark">Purok to Notify</label>
					<select name="for[]" class="select2-icon form-control" data-select-placeholder="Select a purok" multiple required>
						@foreach (getPurok() as $item)
							<option value="{{ $item->id }}" data-icon="ti ti-map-pin">{{ $item->name }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" name="notify" id="notify">
						<label class="form-check-label form-label fs-14 text-dark" for="notify">
							Notify Now!
						</label>
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