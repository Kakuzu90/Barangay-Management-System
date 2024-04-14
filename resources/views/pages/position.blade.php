@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Position Lists
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection

@section("body")

<div class="page-header">
	<h1 class="page-title my-auto">Position Lists</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Position Lists</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header justify-content-between">
				<div class="card-title">
						Manage Positions
				</div>
				@can("position-store")
				<button
					type="button" class="btn btn-sm btn-primary btn-wave waves-light"
					data-bs-toggle="modal" data-bs-target="#add"
				>
					<i class="ti ti-plus fw-semibold align-middle me-1"></i> Create Position
				</button>
				@endcan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Position Name</th>
								<th>Position Order</th>
								<th>Officials</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($positions as $item)
								<tr>
									<td>
										<span class="fw-bold text-primary">{{ $item->name }}</span>
									</td>
									<td>
										<span class="badge bg-primary fs-12">
											<i class="bi bi-view-stacked"></i>
											{{ $item->priority }}
										</span>
									</td>
									<td>
										<span class="badge bg-outline-dark fs-11">{{ $item->officials->count() }}</span>
									</td>
									<td class="align-middle">
										@can("position-update")
											<button type="button"
												data-route="{{ route("positions.show", $item->id) }}"
												data-title="Edit {{ $item->name }}"
												class="edit btn btn-icon btn-sm btn-success btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $item->name }}"
											>
											<i class="ti ti-edit fs-16"></i>
										</button>
										@endcan
										@can("position-delete")
											<button type="button"
												data-route="{{ route("positions.show", $item->id) }}"
												data-title="{{ $item->name }}"
												class="delete btn btn-icon btn-sm btn-danger btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Delete {{ $item->name }}"
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

@include("pages.modals.position.add")
@include("pages.modals.position.edit")
@can("position-delete")
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
				order: [[1, "asc"], [2, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();

			@can("position-update")
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
									$("#edit input[name=name]").val(response.name)
									$("#edit select[name=order]").val(response.priority).trigger("change")
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