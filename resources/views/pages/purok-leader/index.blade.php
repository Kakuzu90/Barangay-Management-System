@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Purok Leader Lists
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/flatpickr/flatpickr.min.css") }}">
@endsection


@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Purok Leader Lists</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Purok Leader Lists</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header justify-content-between">
				<div class="card-title">
						Manage Purok Leaders
				</div>
				@can("purok-leader-store")
				<button
					type="button" class="btn btn-sm btn-primary btn-wave waves-light"
					data-bs-toggle="modal" data-bs-target="#add"
				>
					<i class="ti ti-plus fw-semibold align-middle me-1"></i> Create Purok Leader
				</button>
				@endcan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Full Name</th>
								<th>Phone Number</th>
								<th>Purok</th>
								<th>Term From</th>
								<th>Term To</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data["leaders"] as $item)
								<tr>
									<td>
										<div class="d-flex justify-content-start align-items-center">
											<div class="avatar avatar-sm">
												<img src="{{ $item->resident->avatar() }}" alt="Resident Avatar" />
											</div>
											<div class="d-flex flex-column ms-2">
												<p class="fw-bolder mb-0 fs-14">{{ $item->resident->fullname }}</p>
												<span>
													Age:
													<span class="badge bg-danger">{{ $item->resident->age }}</span>
													Gender: 
													<span class="text-default">{{ $item->resident->gender }}</span>
												</span>
											</div>
										</div>
									</td>
									<td>
										<span>{{ $item->resident->phone_number }}</span>
									</td>
									<td>
										<span class="badge fs-12 bg-primary">{{ $item->purok->name }}</span>
									</td>
									<td>
										<span class="text-dark">{{ $item->term_from->format("F d, Y") }}</span>
									</td>
									<td>
										<span class="text-dark">{{ $item->term_to->format("F d, Y") }}</span>
									</td>
									<td>
										<span class="badge fs-12 bg-{{ $item->color() }}">{{ $item->text() }}</span>
									</td>
									<td class="align-middle">
										@can("resident-index")
											<a href="{{ route("residents.show", $item->resident_id) }}"
												class="btn btn-icon btn-sm btn-primary btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="View {{ $item->resident->fullname }}"
												>
												<i class="ti ti-eye fs-16"></i>
											</a>
										@endcan
										@can("purok-leader-update")
											<button type="button"
												data-route="{{ route("purok-leaders.show", $item->id) }}"
												data-title="Edit {{ $item->resident->fullname }}"
												class="edit btn btn-icon btn-sm btn-success btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $item->resident->fullname }}"
											>
											<i class="ti ti-edit fs-16"></i>
										</button>
										@endcan
										@can("purok-leader-delete")
											<button type="button"
												data-route="{{ route("purok-leaders.show", $item->id) }}"
												data-title="{{ $item->resident->fullname }}"
												class="delete btn btn-icon btn-sm btn-danger btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Delete {{ $item->resident->fullname }}"
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

@include("pages.modals.leader.add")
@include("pages.modals.leader.edit")
@can("purok-leader-delete")
	@include("pages.modals.delete")
@endcan
@endsection 

@section("scripts")
	<script src="{{ asset("assets/libs/flatpickr/flatpickr.min.js") }}"></script>
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/flatpickr.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script src="{{ asset("assets/js/form-validation.js") }}"></script>
	<script>
		$(document).ready(function() {
			$("#datatable").DataTable({
				order: [[5, "asc"], [2, "asc"], [0, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();

			@can("purok-leader-update")
				$(document).on("click", ".edit", function() {
					const route = $(this).data("route")
					const title = $(this).data("title")

					$("#edit #form-loader").removeClass("d-none")
					$("#edit #form-loader").addClass("d-block")
					$("#edit #form-container").removeClass("d-block")
					$("#edit #form-container").addClass("d-none")
					$("#edit").modal("show")

					$("#edit select[name=resident]").empty().trigger("change");

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

									const newOption = new Option(response.fullname, response.resident)
									$(newOption).attr("data-avatar", response.avatar)

									$("#edit #editTitle").text(title)
									$("#edit select[name=purok]").val(response.purok).trigger("change")
									$("#edit input[name=date_from]").val(response.date_from);
									$("#edit input[name=date_to]").val(response.date_to);

									$("#edit select[name=resident]").append(newOption).trigger("change");

									$(".flatpickr-human-friendly").each(function() {
										flatpickr(this, {
												altInput: true,
												altFormat: "F j, Y",
												dateFormat: "Y-m-d",
										});
									});
							}
					});
				})
			@endcan

			@can("purok-leader-delete")
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