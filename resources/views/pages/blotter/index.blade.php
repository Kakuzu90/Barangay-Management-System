@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Blotter Lists
	@endif
@endsection

@section("body")
	
<div class="page-header">
	<h1 class="page-title my-auto">Blotter Lists</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Incident</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Blotter Lists</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header justify-content-between">
				<div class="card-title">
						Manage Blotters
				</div>
				@can("blotter-store")
				<a
					href="{{ route("blotters.create") }}" class="btn btn-sm btn-primary btn-wave waves-light"
				>
					<i class="ti ti-plus fw-semibold align-middle me-1"></i> Create Blotter
				</a>
				@endcan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Complainant Name</th>
								<th>Respondent Name</th>
								<th>Involves</th>
								<th>Incident Date</th>
								<th>Date Hearing</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data["blotters"] as $item)
								<tr>
									<td>
										<div class="d-flex justify-content-start align-items-center">
											<div class="avatar avatar-sm">
												<img src="{{ $item->complaint->avatar() }}" alt="Resident Avatar" />
											</div>
											<div class="d-flex flex-column ms-2">
												<p class="fw-bolder mb-0 fs-14">{{ $item->complaint->fullname }}</p>
												<span>
													Age:
													<span class="badge bg-danger">{{ $item->complaint->age }}</span>
													Gender: 
													<span class="text-default">{{ $item->complaint->gender }}</span>
												</span>
											</div>
										</div>
									</td>
									<td>
										<div class="d-flex justify-content-start align-items-center">
											<div class="avatar avatar-sm">
												<img src="{{ $item->respondent->avatar() }}" alt="Resident Avatar" />
											</div>
											<div class="d-flex flex-column ms-2">
												<p class="fw-bolder mb-0 fs-14">{{ $item->respondent->fullname }}</p>
												<span>
													Age:
													<span class="badge bg-danger">{{ $item->respondent->age }}</span>
													Gender: 
													<span class="text-default">{{ $item->respondent->gender }}</span>
												</span>
											</div>
										</div>
									</td>
									<td class="align-middle">
										@if($item->involvesArray() > 0)
										@foreach ($item->involvesArray() as $involve)
											<span class="badge fs-12 bg-outline-secondary mb-1">{{ $involve }}</span>								
										@endforeach
										@else
											<span class="badge fs-12 bg-outline-secondary">None</span>
										@endif
									</td>
									<td>
										<span class="badge fs-12 bg-outline-primary">{{ $item->incident_date->format("F d, Y") }}</span>
									</td>
									<td>
										@if ($item->date_hearing)
										<span class="badge fs-12 bg-outline-primary">{{ $item->date_hearing->format("F d, Y") }}</span>
										@else
										<span>Not Yet</span>
										@endif
									</td>
									<td>
										<span class="badge fs-12 bg-{{ $item->color() }}">{{ $item->status }}</span>
									</td>
									<td class="align-middle">
										@can("blotter-index")
											<a href="{{ route("blotters.generate", $item->id) }}"
												class="btn btn-icon btn-sm btn-dark btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Download Summon"
												>
												<i class="ti ti-download fs-16"></i>
											</a>
										@endcan
										@can("blotter-store")
											<a href="{{ route("blotters.show", $item->id) }}"
												class="btn btn-icon btn-sm btn-primary btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="View Blotter"
												>
												<i class="ti ti-eye fs-16"></i>
											</a>
										@endcan
										@can("blotter-update")
											<a href="{{ route("blotters.edit", $item->id) }}"
												class="btn btn-icon btn-sm btn-success btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $item->complaint->fullname }}"
											>
											<i class="ti ti-edit fs-16"></i>
										</a>
										@endcan
										@can("blotter-delete")
											<button type="button"
												data-route="{{ route("blotters.destroy", $item->id) }}"
												data-title="{{ $item->complaint->fullname }}"
												class="delete btn btn-icon btn-sm btn-danger btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Delete {{ $item->complaint->fullname }}"
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

@can("blotter-delete")
	@include("pages.modals.delete")
@endcan

@endsection

@section("scripts")
	<script src="{{ asset("assets/js/form-validation.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script>
		$(document).ready(function() {
			$("#datatable").DataTable({
				order: [[5, "asc"], [4, "asc"], [3, "asc"], [0, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();

			@can("blotter-delete")
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