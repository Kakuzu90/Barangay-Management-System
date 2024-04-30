@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Resident Lists
	@endif
@endsection

@section("body")
	
<div class="page-header">
	<h1 class="page-title my-auto">Resident Lists</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Resident Lists</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header justify-content-between">
				<div class="card-title">
						Manage Residents
				</div>
				@can("resident-store")
				<a
					href="{{ route("residents.create") }}" class="btn btn-sm btn-primary btn-wave waves-light"
				>
					<i class="ti ti-plus fw-semibold align-middle me-1"></i> Create Resident
				</a>
				@endcan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Resident Name</th>
								<th>Civil Status</th>
								<th>Phone Number</th>
								<th>Education Level</th>
								<th>Purok</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data["residents"] as $item)
								<tr>
									<td>
										<div class="d-flex justify-content-start align-items-center">
											<div class="avatar avatar-sm">
												<img src="{{ $item->avatar() }}" alt="Resident Avatar" />
											</div>
											<div class="d-flex flex-column ms-2">
												<p class="fw-bolder mb-0 fs-14">{{ $item->fullname }}</p>
												<span>
													Age:
													<span class="badge bg-danger">{{ $item->age }}</span>
													Gender: 
													<span class="text-default">{{ $item->gender }}</span>
												</span>
											</div>
										</div>
									</td>
									<td>
										<span>{{ $item->civil_status }}</span>
									</td>
									<td>
										<span>{{ $item->phone_number }}</span>
									</td>
									<td>
										<span>{{ $item->education_level }}</span>
									</td>
									<td>
										<span class="badge bg-primary fs-12">{{ $item->purok->name ?? '-' }}</span>
									</td>
									<td class="align-middle">
										@can("resident-index")
											<a href="{{ route("residents.show", $item->id) }}"
												class="btn btn-icon btn-sm btn-primary btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="View {{ $item->fullname }}"
												>
												<i class="ti ti-eye fs-16"></i>
											</a>
										@endcan
										@can("resident-update")
											<a href="{{ route("residents.edit", $item->id) }}"
												class="btn btn-icon btn-sm btn-success btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $item->fullname }}"
											>
											<i class="ti ti-edit fs-16"></i>
										</a>
										@endcan
										@can("resident-delete")
											<button type="button"
												data-route="{{ route("residents.destroy", $item->id) }}"
												data-title="{{ $item->fullname }}"
												class="delete btn btn-icon btn-sm btn-danger btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Delete {{ $item->fullname }}"
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

@can("resident-delete")
	@include("pages.modals.delete")
@endcan
@endsection

@section("scripts")
	<script src="{{ asset("assets/js/form-validation.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script>
		$(document).ready(function() {
			$("#datatable").DataTable({
				order: [[4, "asc"], [0, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();

			@can("resident-delete")
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