@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Active Purok Leaders
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Active Purok Leaders</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route("purok-leaders.index") }}">Purok Leaders Lists</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Active</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-9">
		<div class="row justify-content-center">
			@forelse ($data["leaders"] as $item)
			<div class="col-xl-4 col-md-6">
				<div class="card custom-card">
					<div class="card-body team-card">
						<div class="text-center">
							<span class="avatar avatar-xxl avatar-rounded team-avatar">
								<img src="{{ $item->resident->avatar() }}" alt="Resident Avatar" class="rounded-circle" />
							</span>
						</div>
						<div class="d-flex text-center justify-content-between mt-1 mb-1">
							<div class="flex-fill">
								<p class="mb-1 fw-semibold fs-16 max-w-150 mx-auto">
									<a href="{{ route("residents.show", $item->resident_id) }}">{{ $item->resident->fullname }}</a>
								</p>
								<p class="mb-1 fs-12 text-muted max-w-150 mx-auto">
									<span class="text-dark">
										<b>Gender:</b> 
										<span>
											{{ $item->resident->gender }}
										</span>
									</span>
									<span class="text-dark ms-2">
										<b>Age:</b> 
										<span>
											{{ $item->resident->age }}
										</span>
									</span>
								</p>
								<p class="mb-0 fs-13 text-dark max-w-150 mx-auto">{{ $item->resident->phone_number }}</p>
							</div>
						</div>
						<div class="text-center">
							<span class="badge bg-primary fs-12">{{ $item->purok->name ?? '-' }}</span>
						</div>
					</div>
					<div class="card-footer border-block-start-dashed text-center p-0">
						<div class="d-flex align-items-center justify-content-center">
								<div class="d-flex p-3 w-100 justify-content-center border-end">
										<div class="text-center ">
											<p class="fw-semibold mb-0">Term From</p>
											<span class="text-muted fs-12">{{ $item->term_from->format("F d, Y") }}</span>
										</div>
								</div>
								<div class="d-flex p-3 w-100 justify-content-center">
										<div class="text-center">
											<p class="fw-semibold mb-0">Term To</p>
											<span class="text-muted fs-12">{{ $item->term_to->format("F d, Y") }}</span>
										</div>
								</div>
						</div>
					</div>
				</div>
			</div>
			@empty
				<div class="col-lg-5 mx-auto">
					<div class="card custom-card">
						<div class="card-body text-center">
							<div class="avatar avatar-xxl avatar-rounded">
								<img src="{{ asset("assets/images/avatar/administrator.png") }}" alt="Avatar" />
							</div>
							<h5 class="text-default mb-0 mt-2">No Current Active Purok Leaders Available</h5>
						</div>
					</div>
				</div>
			@endforelse
		</div>
	</div>

	<div class="col-lg-3">
		<div class="card custom-card">
			<div class="card-body">
				<form action="{{ route("purok-leaders.active") }}" method="GET">
					<div class="mb-3">
						<label class="form-label fs-14 text-dark">Year</label>
						<select name="year" class="select2-icon form-control" data-select-placeholder="Select a year" required>
							@foreach (yearPurokLeader() as $item)
									<option value="{{ $item->year }}" data-icon="ti ti-calendar">{{ $item->year }}</option>
							@endforeach
						</select>
					</div>
					<button type="submit" class="btn btn-sm btn-primary btn-wave waves-light">Apply Year</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
@endsection