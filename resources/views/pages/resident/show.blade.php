@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	{{ $resident->fullname }} Profile
	@endif
@endsection

@section("body")
	
<div class="page-header">
	<h1 class="page-title my-auto">Resident Profile</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route("residents.index") }}">Resident Lists</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Resident Profile</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-3">

		<div class="card custom-card overflow-hidden">
			<div class="card-body border-bottom">
				<div class="d-sm-flex  main-profile-cover">
					<span class="avatar avatar-xxl me-3">
						<img src="{{ $resident->avatar() }}" alt="Resident Avatar" class="avatar avatar-xxl" />
					</span>
					<div class="flex-fill main-profile-info my-auto">
						<h5 class="fw-semibold mb-1 ">{{ $resident->fullname }}</h5>
						<div>
							<p class="mb-1 text-muted">
								{{ $resident->address }}
							</p>
							<p class="fs-12 op-7 mb-0">  
								<span class="me-3 d-inline-flex align-items-center">
									<i class="ti ti-gender-femme me-1 align-middle"></i>
									{{ $resident->gender }}
								</span> 
								<span class="d-inline-flex align-items-center">
									<i class="ti ti-map-pin me-1 align-middle"></i>
									{{ $resident->purok->name ?? '-' }}
								</span> 
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card custom-card">
			<div class="p-4  border-bottom border-block-end-dashed">
				<p class="fs-15 mb-2 me-4 fw-semibold">Personal Info :</p> 
				<ul class="list-group">

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Maiden Name :
							</div>
							<span class="fs-12 text-muted">{{ $resident->maiden_name ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Nick Name :
							</div>
							<span class="fs-12 text-muted">{{ $resident->nickname ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Citizenship :
							</div>
							<span class="fs-12 text-muted">{{ $resident->citizenship ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Civil Status :
							</div>
							<span class="fs-12 text-muted">{{ $resident->civil_status ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Education Level :
							</div>
							<span class="fs-12 text-muted">{{ $resident->education_level ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Date of Birth :
							</div>
							<span class="fs-12 text-muted">{{ $resident->date_birth->format("F d, Y") ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Age :
							</div>
							<span class="fs-12 text-muted">{{ $resident->age ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Mother's Name :
							</div>
							<span class="fs-12 text-muted">{{ $resident->mother_name ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Father's Name :
							</div>
							<span class="fs-12 text-muted">{{ $resident->father_name ?? '-' }}</span>
						</div>
					</li>

				</ul>
			</div>

			<div class="p-4 border-bottom">
				<p class="fs-15 mb-2 me-4 fw-semibold">Contact Information :</p>
				<ul class="list-group">

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Phone Number :
							</div>
							<span class="fs-12 text-muted">{{ $resident->phone_number ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Place of Birth :
							</div>
							<span class="fs-12 text-muted">{{ $resident->place_birth ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Contact Person's Name :
							</div>
							<span class="fs-12 text-muted">{{ $resident->contact_person ?? '-' }}</span>
						</div>
					</li>

					<li class="list-group-item border-0">
						<div class="d-flex flex-wrap align-items-center">
							<div class="me-2 fw-semibold">
								Contact Person's Address :
							</div>
							<span class="fs-12 text-muted">{{ $resident->contact_address ?? '-' }}</span>
						</div>
					</li>

				</ul>
			</div>

		</div>
	</div>

	<div class="col-md-9">
		<div class="card custom-card">
			<div class="card-header">
				<div class="card-title">
					List of Cases Involve
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Complainant Name</th>
								<th>Respondent Name</th>
								<th>Incident Date</th>
								<th>Date Hearing</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cases as $item)
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
											<a href="{{ route("blotters.edit", $item->id) }}"
												class="btn btn-icon btn-sm btn-primary btn-wave waves-light"
												data-bs-toggle="tooltip" data-bs-placement="top" title="View Blotter"
												>
												<i class="ti ti-eye fs-16"></i>
											</a>
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

@endsection

@section("scripts")
<script>
	$(document).ready(function() {
		$("#datatable").DataTable({
			ordering: false,
			lengthMenu: false,
			language: {
					searchPlaceholder: 'Search...',
					sSearch: '',
			},
		});
		$("#datatable_length").remove();
	});
</script>
@endsection