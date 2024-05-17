@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Blotter Details
	@endif
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Blotter Details</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Incident</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route("blotters.index") }}">Blotter Lists</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Blotter Details</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-4">

		<div class="card custom-card overflow-hidden">
			<div class="card-header d-flex justify-content-end">
				<h4 class="card-title mb-0">Complainant</h4>
			</div>
			<div class="card-body border-bottom">
				<div class="d-sm-flex  main-profile-cover">
					<span class="avatar avatar-xxl me-3">
						<img src="{{ $blotter->complaint->avatar() }}" alt="Resident Avatar" class="avatar avatar-xxl" />
					</span>
					<div class="flex-fill main-profile-info my-auto">
						<h5 class="fw-semibold mb-1 ">{{ $blotter->complaint->fullname }}</h5>
						<div>
							<p class="mb-1 text-muted">
								{{ $blotter->complaint->address }}
							</p>
							<p class="fs-12 op-7 mb-0">  
								<span class="me-3 d-inline-flex align-items-center">
									<i class="ti ti-gender-femme me-1 align-middle"></i>
									{{ $blotter->complaint->gender }}
								</span> 
								<span class="d-inline-flex align-items-center">
									<i class="ti ti-map-pin me-1 align-middle"></i>
									{{ $blotter->complaint->purok->name ?? '-' }}
								</span> 
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card custom-card overflow-hidden">
			<div class="card-header d-flex justify-content-end">
				<h4 class="card-title mb-0">Respondent</h4>
			</div>
			<div class="card-body border-bottom">
				<div class="d-sm-flex  main-profile-cover">
					<span class="avatar avatar-xxl me-3">
						<img src="{{ $blotter->respondent->avatar() }}" alt="Resident Avatar" class="avatar avatar-xxl" />
					</span>
					<div class="flex-fill main-profile-info my-auto">
						<h5 class="fw-semibold mb-1 ">{{ $blotter->respondent->fullname }}</h5>
						<div>
							<p class="mb-1 text-muted">
								{{ $blotter->respondent->address }}
							</p>
							<p class="fs-12 op-7 mb-0">  
								<span class="me-3 d-inline-flex align-items-center">
									<i class="ti ti-gender-femme me-1 align-middle"></i>
									{{ $blotter->respondent->gender }}
								</span> 
								<span class="d-inline-flex align-items-center">
									<i class="ti ti-map-pin me-1 align-middle"></i>
									{{ $blotter->respondent->purok->name ?? '-' }}
								</span> 
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="col-md-8">
		<div class="card custom-card">
			<div class="card-header">
				<h4 class="card-title mb-0">Blotter Summary</h4>
			</div>
			<div class="card-body">
				<h6>
					Involves: @if($blotter->involvesArray() > 0)
					@foreach ($blotter->involvesArray() as $involve)
						<span class="badge fs-12 bg-outline-secondary mb-1">{{ $involve }}</span>								
					@endforeach
					@else
						<span class="badge fs-12 bg-outline-secondary">None</span>
					@endif
				</h6>
				<h6>
					Date Hearing: <span class="fw-normal">{{ $blotter->date_hearing->format("F d, Y") ?? 'None' }}</span>
				</h6>
				<h6>
					Time Hearing: <span class="fw-normal">{{ $blotter->time_hearing ?? 'None' }}</span>
				</h6>
				<h6>
					Incident Location: <span class="fw-normal">{{ $blotter->incident_location }}</span>
				</h6>
				<h6>
					Incident Date: <span class="fw-normal">{{ $blotter->incident_date->format("F d, Y") }}</span>
				</h6>
				<h6>
					Results: <span class="fw-normal">{{ $blotter->results ?? 'None' }}</span>
				</h6>
				<h6>
					Status: <span class="badge fs-12 bg-{{ $blotter->color() }}">{{ $blotter->status }}</span>
				</h6>

			</div>
		</div>
	</div>
</div>

@endsection