@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Event Lists
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Event Lists</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Announcements</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Event Lists</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header justify-content-between">
				<div class="card-title">
						Manage Events
				</div>
				@can("event-store")
				<button
					type="button" class="btn btn-sm btn-primary btn-wave waves-light"
					data-bs-toggle="modal" data-bs-target="#add"
				>
					<i class="ti ti-plus fw-semibold align-middle me-1"></i> Create Event
				</button>
				@endcan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Title</th>
								<th>Body</th>
								<th>Puroks</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($events as $item)
								<tr>
									<td>
										<span class="text-primary fw-semibold">{{ $item->title }}</span>
									</td>
									<td>
										<span>{{ $item->body }}</span>
									</td>
									<td>
										@foreach (json_decode($item->for, true) as $row)
											<span class="badge bg-primary">{{ getPurokById($row) }}</span>
										@endforeach
									</td>
									<td class="align-middle">
										@can("event-update")
											<button type="button"
												data-route="{{ route("events.show", $item->id) }}"
												data-title="Edit {{ $item->title }}"
												class="edit btn btn-icon btn-sm btn-success btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $item->title }}"
											>
											<i class="ti ti-edit fs-16"></i>
										</button>
										@endcan
										@can("purok-delete")
											<button type="button"
												data-route="{{ route("events.show", $item->id) }}"
												data-title="{{ $item->title }}"
												class="delete btn btn-icon btn-sm btn-danger btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Delete {{ $item->title }}"
											>
											<i class="ti ti-trash fs-16"></i>
										</button>
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@include("pages.modals.event.add")
@include("pages.modals.event.edit")
@can("event-delete")
@include("pages.modals.delete")
@endcan
@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
	<script src="{{ asset("assets/js/form-validation.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script>
		$(document).ready(function() {
			$("#datatable").DataTable({
				order: [[0, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();

			@can("event-update")
				$(document).on("click", ".edit", function() {
					const route = $(this).data("route")
					const title = $(this).data("title")

					$("#edit #form-loader").removeClass("d-none")
					$("#edit #form-loader").addClass("d-block")
					$("#edit #form-container").removeClass("d-block")
					$("#edit #form-container").addClass("d-none")
					$("#edit").modal("show")

					$.ajax({
							url: route,
							type: "GET",
							dataType: "json",
							success: function(response) {
									$("#edit #form-loader").addClass("d-none")
									$("#edit #form-loader").removeClass("d-block")
									$("#edit #form-container").addClass("d-block")
									$("#edit #form-container").removeClass("d-none")
									$("#edit form").attr("action", route)

									$("#edit #editTitle").text(title)
									$("#edit input[name=title]").val(response.title)
									$("#edit textarea[name=body]").val(response.body)
									$("#edit select").val(response.for).trigger("change")
							}
					});
				})
			@endcan

			@can("position-delete")
			$(document).on("click", ".delete", function() {
				const route = $(this).data("route");
				const title = $(this).data("title");

				$("#delete #to-delete").text(title);
				$("#delete form").attr("action", route);
				$("#delete").modal("show");
			});
			@endcan
		});
	</script>
@endsection